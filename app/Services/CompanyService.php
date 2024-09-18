<?php

namespace App\Services;

use App\Models\Company;
use App\Repositories\Shared\CompanyRepository;

class CompanyService
{
    protected CompanyRepository $companyRepository;


    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    /*
     * Get all companies
     */
    public function getAllCompanies($perPage)
    {
        return $this->companyRepository->getAllCompanies($perPage);
    }

    /**
     * Get company by ID
     *
     * @param int $id
     * @return Company|null
     */
    public function getCompanyById($id)
    {

        return $this->companyRepository->findCompanyById($id);
    }

    /**
     * Create a new company
     *
     * @param array $data
     * @return Company
     */
    public function createCompany(array $data)
    {
        return $this->companyRepository->createCompany($data);
    }

    /**
     * Update an existing company
     *
     * @param int $id
     * @param array $data
     * @return Company|null
     */
    public function updateCompany($id, array $data)
    {
        return $this->companyRepository->updateCompany($id, $data);
    }

    /**
     * Delete a company
     *
     * @param int $id
     * @return bool
     */
    public function deleteCompany($id)
    {
        return $this->companyRepository->deleteCompany($id);
    }
}
