<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\EmergencyResource;
use App\Models\Emergency;
use App\Services\UserEmergencyService;
use App\Http\Requests\User\Emergencies\{StoreEmergencyRequest,UpdateEmergencyRequest};
use App\Traits\{TranslatableTrait,ApiResponse};
use Illuminate\Http\JsonResponse;

class UserEmergencyController extends Controller
{
    use ApiResponse;
    use TranslatableTrait;
    protected UserEmergencyService $userEmergencyService;
    protected Emergency $emergency;

    public function __construct(UserEmergencyService $userEmergencyService , Emergency $follower)
    {
        $this->userEmergencyService = $userEmergencyService;
        $this->emergency = $emergency;
    }

    /**
     * Show emergencies based on userId
     *
     * @param int $userId
     * @return JsonResponse
     */
    public function show($userId): JsonResponse
    {
        // Define the number of items per page
        $perPage = request()->get('per_page', 10); // Default value is 10

        // Retrieve emergencies with pagination
        $emergencies = $this->userEmergencyService->getAllEmergencies($userId,$perPage);

        return $this->successResponse(EmergencyResource::collection($emergencies), 'Emergencies retrieved successfully');
    }

    /**
     * Create a new emergency
     *
     * @param StoreEmergencyRequest $request
     * @return JsonResponse
     */
    public function store(StoreEmergencyRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Handle Translatable Data
        $data['first_name'] = $this->handleTranslatableData($data, 'first_name');
        $data['middle_name'] = $this->handleTranslatableData($data, 'middle_name');
        $data['last_name'] = $this->handleTranslatableData($data, 'last_name');

        // Create a new emergency
        $emergency = $this->userEmergencyService->createEmergency($data);

        // Return success response with the created emergency
        return $this->successResponse(new EmergencyResource($emergency), 'Emergency created successfully', 200);
    }

    /**
     * Update an existing emergency
     *
     * @param UpdateEmergencyRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateEmergencyRequest $request, $id): JsonResponse
    {
        $data = $request->validated();

        // Handle Translatable Data
        $data['first_name'] = $this->handleTranslatableData($data, 'first_name');
        $data['middle_name'] = $this->handleTranslatableData($data, 'middle_name');
        $data['last_name'] = $this->handleTranslatableData($data, 'last_name');
        // Update the emergency based on id
        $emergency = $this->userEmergencyService->updateEmergency($id, $data);

        // Check if the emergency is not found
        if (!$emergency) {
            return $this->errorResponse('Emergency not found', 404);
        }

        // Return success response with the updated emergency
        return $this->successResponse(new EmergencyResource($emergency), 'Emergency updated successfully');
    }

    /**
     * Delete an emergency
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        // Attempt to delete the emergency by id
        $deleted = $this->userEmergencyService->deleteEmergency($id);

        // Check if the emergency is not found or could not be deleted
        if (!$deleted) {
            return $this->errorResponse('Emergency not found', 404); // Return error if not found
        }

        // Return success response
        return $this->successResponse(null, 'emergency deleted successfully', 200);
    }
}
