<?php

namespace App\Http\Controllers\Shared;

use App\Helpers\HandleUpload;
use App\Http\Controllers\Controller;
use App\Http\Resources\Company\CompanyResource;
use App\Services\CompanyService;
use App\Http\Requests\Company\{StoreCompanyRequest,UpdateCompanyRequest};
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;

class CompanyController extends Controller
{
    use ApiResponse;

    protected CompanyService $companyService;

    public function __construct(CompanyService $companyService)
    {
        // Inject the service responsible for handling business logic
        $this->companyService = $companyService;
    }

    /*
     * Get all companies
     */
    public function index(): JsonResponse
    {
        // Define the number of items per page
        $perPage = request()->get('per_page', 10); // Default value is 10

        // Retrieve companies with pagination
        $companies = $this->companyService->getAllCompanies($perPage);

        return $this->successResponse(CompanyResource::collection($companies), 'Companies retrieved successfully');
    }

    /**
     * Show company based on ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        // Get company by id
        $company = $this->companyService->getCompanyById($id);

        // Check if company is not found
        if (!$company) {
            return $this->errorResponse('Company not found', 404);
        }

        // Return success response with company data
        return $this->successResponse(new CompanyResource($company), 'Company retrieved successfully');
    }

    /**
     * Create a new company
     *
     * @param StoreCompanyRequest $request
     * @return JsonResponse
     */
    public function store(StoreCompanyRequest $request): JsonResponse
    {
        // Get validated data from the request
        $data = $request->validated();

        // Check if there is a file in the request and upload it
        $data['logo'] = $request->hasFile('logo') ? HandleUpload::uploadFile($request->logo , 'companies') : NULL;

        $data['name'] = ['en' => $data['name_en'], 'ar' => $data['name_ar']];

        // Create a new company
        $company = $this->companyService->createCompany($data);

        // Return success response with the created company
        return $this->successResponse(new CompanyResource($company), 'Company created successfully', 200);
    }

    /**
     * Update an existing company
     *
     * @param UpdateCompanyRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateCompanyRequest $request, $id): JsonResponse
    {
        $data = $request->validated();

        // Get the existing company to get the old file path
        $existingCompany = $this->companyService->getCompanyById($id);

        if (!$existingCompany) {
            return $this->errorResponse('Company not found', 404); // Return error if not found
        }

        // Check if there is a file in the request and upload it
        $data['logo'] = $request->hasFile('logo') ? HandleUpload::uploadFile($request->logo , 'companies') : $existingCompany->logo;

        $data['name'] = ['en' => $data['name_en'], 'ar' => $data['name_ar']];

        // Update the company based on ID
        $company = $this->companyService->updateCompany($id, $data);

        // Check if the company is not found
        if (!$company) {
            return $this->errorResponse('Company not found', 404);
        }

        // Return success response with the updated company
        return $this->successResponse(new CompanyResource($company), 'Company updated successfully');
    }

    /**
     * Delete a company
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        // Attempt to delete the company by ID
        $deleted = $this->companyService->deleteCompany($id);

        // Check if the company is not found or could not be deleted
        if (!$deleted) {
            return $this->errorResponse('Company not found', 404); // Return error if not found
        }

        // Return success response
        return $this->successResponse(null, 'Company deleted successfully', 200);
    }
}
