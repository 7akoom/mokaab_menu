<?php

namespace App\Http\Controllers\Admin;

use App\Models\{Company, Image};
use App\Services\CompanyService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;

class AdminCompanyController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index()
    {
        $data = $this->companyService->getCompaniesWithStats();

        return view('admin.companies.index', $data);
    }

    public function create()
    {
        return view('admin.companies.create');
    }

    public function store(StoreCompanyRequest $request)
    {
        $data = $request->validated();
        $logo = $request->file('logo');

        $this->companyService->createCompany($data, $logo);

        return redirect()->route('companies.index')->with('success', 'تمت إضافة الشركة بنجاح');
    }

    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    public function update(UpdateCompanyRequest $request, $id)
    {
        $company = Company::findOrFail($id);

        $data = $request->validated();

        $company->name = $data['name'];
        $company->domain = $data['domain'];
        $company->email = $data['email'];
        $company->phone = $data['phone'];
        $company->start_date = $data['start_date'];
        $company->expire_date = $data['expire_date'];

        if (!empty($data['password'])) {
            $company->password = $data['password'];
        }

        if (isset($data['status'])) {
            $company->status = $data['status'];
        }

        $company->save();

        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo->path);
                $company->logo->delete();
            }

            $path = $request->file('logo')->store('logos', 'public');

            Image::create([
                'company_id' => $company->id,
                'type' => 4,
                'path' => $path,
            ]);
        }

        return redirect()->route('companies.index')->with('success', 'تم تعديل الشركة بنجاح');
    }


    public function destroy(Company $company)
    {
        if ($company->logo && $company->logo->path) {
            Storage::disk('public')->delete($company->logo->path);
            $company->logo->delete();
        }

        $company->delete();

        return redirect()->route('companies.index')->with('success', 'تم حذف الشركة بنجاح');
    }
}
