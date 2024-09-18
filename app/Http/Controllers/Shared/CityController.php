<?php

namespace App\Http\Controllers\Shared;

use App\Helpers\HandleUpload;
use App\Http\Controllers\Controller;
use App\Http\Resources\City\CityResource;
use App\Services\CityService;
use App\Http\Requests\City\{StoreCityRequest,UpdateCityRequest};
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class CityController extends Controller
{
    use ApiResponse;

    protected CityService $cityService;

    public function __construct(CityService $cityService)
    {
        // Inject the service responsible for handling business logic
        $this->cityService = $cityService;
    }

    /*
     * Get all cities
     */
    public function index(): JsonResponse
    {
        // Define the number of items per page
        $perPage = request()->get('per_page', 10); // Default value is 10

        // Retrieve cities with pagination
        $cities = $this->cityService->getAllCities($perPage);

        return $this->successResponse(CityResource::collection($cities), 'Cities retrieved successfully');
    }

    /**
     * Show city based on ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        // Get city by id
        $city = $this->cityService->getCityById($id);

        // Check if city is not found
        if (!$city) {
            return $this->errorResponse('City not found', 404);
        }

        // Return success response with city data
        return $this->successResponse(new CityResource($city), 'City retrieved successfully');
    }

    /**
     * Create a new city
     *
     * @param StoreCityRequest $request
     * @return JsonResponse
     */
    public function store(StoreCityRequest $request): JsonResponse
    {
        // Get validated data from the request
        $data = $request->validated();

        $data['title'] = ['en' => $data['title_en'], 'ar' => $data['title_ar']];

        // Create a new city
        $city = $this->cityService->createCity($data);

        // Return success response with the created city
        return $this->successResponse(new CityResource($city), 'City created successfully', 200);
    }

    /**
     * Update an existing city
     *
     * @param UpdateCityRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateCityRequest $request, $id): JsonResponse
    {
        $data = $request->validated();

        $data['title'] = ['en' => $data['title_en'], 'ar' => $data['title_ar']];

        // Update the city based on ID
        $city = $this->cityService->updateCity($id, $data);

        // Check if the city is not found
        if (!$city) {
            return $this->errorResponse('City not found', 404);
        }

        // Return success response with the updated city
        return $this->successResponse(new CityResource($city), 'City updated successfully');
    }

    /**
     * Delete a city
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        // Attempt to delete the city by ID
        $deleted = $this->cityService->deleteCity($id);

        // Check if the city is not found or could not be deleted
        if (!$deleted) {
            return $this->errorResponse('City not found', 404); // Return error if not found
        }

        // Return success response
        return $this->successResponse(null, 'City deleted successfully', 200);
    }
}
