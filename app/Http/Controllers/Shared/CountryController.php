<?php

namespace App\Http\Controllers\Shared;

use App\Helpers\HandleUpload;
use App\Http\Controllers\Controller;
use App\Http\Resources\Country\CountryResource;
use App\Services\CountryService;
use App\Http\Requests\Country\{StoreCountryRequest,UpdateCountryRequest};
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class CountryController extends Controller
{
    use ApiResponse;

    protected CountryService $countryService;

    public function __construct(CountryService $countryService)
    {
        // Inject the service responsible for handling business logic
        $this->countryService = $countryService;
    }

    /*
     * Get all countries
     */
    public function index(): JsonResponse
    {
        // Define the number of items per page
        $perPage = request()->get('per_page', 10); // Default value is 10

        // Retrieve countries with pagination
        $countries = $this->countryService->getAllCountries($perPage);

        return $this->successResponse(CountryResource::collection($countries), 'Countries retrieved successfully');
    }

    /**
     * Show country based on ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        // Get country by id
        $country = $this->countryService->getCountryById($id);

        // Check if country is not found
        if (!$country) {
            return $this->errorResponse('Country not found', 404);
        }

        // Return success response with country data
        return $this->successResponse(new CountryResource($country), 'Country retrieved successfully');
    }

    /**
     * Create a new country
     *
     * @param StoreCountryRequest $request
     * @return JsonResponse
     */
    public function store(StoreCountryRequest $request): JsonResponse
    {
        // Get validated data from the request
        $data = $request->validated();

        // Check if there is a file in the request and upload it
        $data['image'] = $request->hasFile('image') ? HandleUpload::uploadFile($request->image , 'countries') : NULL;

        $data['title'] = ['en' => $data['title_en'], 'ar' => $data['title_ar']];

        // Create a new country
        $country = $this->countryService->createCountry($data);

        // Return success response with the created country
        return $this->successResponse(new CountryResource($country), 'Country created successfully', 200);
    }

    /**
     * Update an existing country
     *
     * @param UpdateCountryRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateCountryRequest $request, $id): JsonResponse
    {
        $data = $request->validated();

        // Get the existing country to get the old file path
        $existingCountry = $this->countryService->getCountryById($id);

        if (!$existingCountry) {
            return $this->errorResponse('Country not found', 404); // Return error if not found
        }


        // Check if there is a file in the request and upload it
        $data['image'] = $request->hasFile('image') ? HandleUpload::uploadFile($request->image , 'countries') : $existingCountry->image;

        $data['title'] = ['en' => $data['title_en'], 'ar' => $data['title_ar']];

        // Update the country based on ID
        $country = $this->countryService->updateCountry($id, $data);

        // Check if the country is not found
        if (!$country) {
            return $this->errorResponse('Country not found', 404);
        }

        // Return success response with the updated country
        return $this->successResponse(new CountryResource($country), 'Country updated successfully');
    }

    /**
     * Delete a country
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        // Attempt to delete the country by ID
        $deleted = $this->countryService->deleteCountry($id);

        // Check if the country is not found or could not be deleted
        if (!$deleted) {
            return $this->errorResponse('Country not found', 404); // Return error if not found
        }

        // Return success response
        return $this->successResponse(null, 'Country deleted successfully', 200);
    }
}
