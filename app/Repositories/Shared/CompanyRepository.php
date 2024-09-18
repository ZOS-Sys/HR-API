<?php

namespace App\Repositories\Shared;

use App\Models\Company;

class CompanyRepository
{
    // Model instance for the company
    protected Company $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    // Get all companies
    public function getAllCompanies($perPage)
    {
        return $this->company->paginate($perPage);
    }

    /**
     * Find a company by the id.
     * This retrieves the company based on the id.
     *
     * @param int $id
     * @return Company|null
     */
    public function findCompanyById($id)
    {
        return $this->company->where('id', $id)->first();
    }

    /**
     * Create a new company in the database.
     *
     * @param array $data
     * @return Company
     */
    public function createCompany(array $data)
    {
        return $this->company->create($data);
    }

    /**
     * Update an existing company by ID.
     *
     * @param int $id
     * @param array $data
     * @return Company|null
     */
    public function updateCompany($id, array $data)
    {
        // Find the company by ID
        $company = $this->findCompanyById($id);
        if ($company) {
            // If the company exists, update it with the provided data
            $company->update($data);
        }
        // Return the updated company
        return $company;
    }

    /**
     * Delete a company by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteCompany($id)
    {
        // Find the company by ID
        $company = $this->findCompanyById($id);
        if ($company) {
            // If found, delete the company and return true
            return $company->delete();
        }

        return false;
    }
}