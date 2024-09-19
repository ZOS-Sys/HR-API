<?php

namespace App\Http\Controllers\Shared;
use App\Http\Controllers\Controller;
use App\Services\CurrencyService;
use App\Http\Requests\Currency\CurrencyStoreRequest;
use App\Http\Requests\Currency\CurrencyUpdateRequest;
use App\Http\Resources\Currency\CurrencyResource;
use Illuminate\Http\JsonResponse;
use App\Traits\TranslatableTrait;
use App\Traits\ApiResponse;

class CurrencyController extends Controller
{
    use ApiResponse, TranslatableTrait;

    protected CurrencyService $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        // Inject the service responsible for handling business logic
        $this->currencyService = $currencyService;
    }

    /**
     * Get all currencies with pagination
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // Define the number of items per page (default: 10)
        $perPage = request()->get('per_page', 10);

        // Retrieve currencies with pagination
        $currencies = $this->currencyService->getAllCurrencies($perPage);

        // Return the response with the paginated data
        return $this->successResponse(CurrencyResource::collection($currencies), 'Currencies retrieved successfully');
    }

    /**
     * Show a currency by ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        // Get currency by ID
        $currency = $this->currencyService->getCurrencyById($id);

        // Check if the currency is not found
        if (!$currency) {
            return $this->errorResponse('Currency not found', 404);
        }

        // Return success response with currency data using CurrencyResource
        return $this->successResponse(new CurrencyResource($currency), 'Currency retrieved successfully');
    }

    /**
     * Create a new currency.
     *
     * @param CurrencyStoreRequest $request
     * @return JsonResponse
     */
    public function store(CurrencyStoreRequest $request): JsonResponse
    {
        // Get validated data from the request
        $data = $request->all();

        // Handle translatable 'name' field
        $data['name'] = $this->handleTranslatableData($data, 'name');

        // Create a new currency
        $currency = $this->currencyService->createCurrency($data);

        // Return success response with the created currency
        return $this->successResponse(new CurrencyResource($currency), 'Currency created successfully', 201);
    }

    /**
     * Update an existing currency.
     *
     * @param CurrencyUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CurrencyUpdateRequest $request, $id): JsonResponse
    {
        // Get validated data from the request
        $data = $request->all();

        // Handle translatable 'name' field
        $data['name'] = $this->handleTranslatableData($data, 'name');

        // Update the currency based on ID
        $currency = $this->currencyService->updateCurrency($id, $data);

        // Check if the currency is not found
        if (!$currency) {
            return $this->errorResponse('Currency not found', 404);
        }

        // Return success response with the updated currency
        return $this->successResponse(new CurrencyResource($currency), 'Currency updated successfully');
    }

    /**
     * Delete a currency.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        // Attempt to delete the currency by ID
        $deleted = $this->currencyService->deleteCurrency($id);

        // Check if the currency is not found or could not be deleted
        if (!$deleted) {
            return $this->errorResponse('Currency not found', 404); // Return error if not found
        }

        // Return success response upon successful deletion
        return $this->successResponse(null, 'Currency deleted successfully', 200);
    }
}
