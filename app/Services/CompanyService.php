<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Company;
use Illuminate\Http\UploadedFile;

class CompanyService
{
    public function getCompaniesWithStats(): array
    {
        $companies = Company::with('logo')->get();

        return [
            'companies' => $companies,
            'companiesCount' => $companies->count(),
            'activeCount' => Company::active()->count(),
            'inActiveCount' => Company::inActive()->count(),
        ];
    }

    public function createCompany(array $data, ?UploadedFile $logo = null): Company
    {
        $company = new Company();
        $company->fill([
            'name' => $data['name'],
            'domain' => $data['domain'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => $data['password'],
            'start_date' => $data['start_date'],
            'expire_date' => $data['expire_date'],
        ]);
        $company->save();

        if ($logo) {
            $path = $logo->store('logos', 'public');

            Image::create([
                'company_id' => $company->id,
                'type' => 4,
                'path' => $path,
            ]);
        }

        return $company;
    }
}
