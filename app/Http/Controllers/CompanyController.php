<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Company;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the companies.
     * @author satiyaG <satiyaganes.sg@gmail.com>
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('company.admin.company_list', compact('companies'));
    }

    /**
     * Show the form for creating a new company.
     * @author satiyaG <satiyaganes.sg@gmail.com>
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('company.admin.add_edit_company');
    }

    /**
     * Store a newly created company in storage.
     * @author satiyaG <satiyaganes.sg@gmail.com>
     * @param CompanyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CompanyRequest $request)
    {
        try {
            $data = $request->validated(); // Use validated data
            
            if ($request->hasFile('logo')) {
                $path = $request->file('logo')->store('company-logos', 'public');
                $data['logo'] = $path;
            }

            $company = Company::create($data);
            
            if ($company) {
                LogHelper::successLog('Company Created', [['requested_by' => Auth::user()->email], 'company_id' => $company->id]);
                return redirect()->route('companies.index')->with('success', 'Company created successfully');
            }

            LogHelper::errorLog('Company Creation Failed', [['requested_by' => Auth::user()->email]]);
            return redirect()->back()->with('error', 'Failed to create company')->withInput();
        } catch (\Exception $e) {
            LogHelper::errorLog('Company Creation Exception', [['requested_by' => Auth::user()->email, 'error' => $e->getMessage()]]);
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified company.
     * @author satiyaG <satiyaganes.sg@gmail.com>
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        return view('company.admin.add_edit_company', compact('company'));
    }

    /** 
     * Update the specified company in storage.
     * @author satiyaG <satiyaganes.sg@gmail.com>
     * @param CompanyRequest $request
     * @param \App\Models\Company $company
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CompanyRequest $request, Company $company)
    {
        try {
            $data = $request->validated(); // Use validated data
            
            if ($request->hasFile('logo')) {
                // Delete old logo if it exists
                if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                    Storage::disk('public')->delete($company->logo);
                }
                
                $path = $request->file('logo')->store('company-logos', 'public');
                $data['logo'] = $path;
            }

            if ($company->update($data)) {
                LogHelper::successLog('Company Updated', [['requested_by' => Auth::user()->email], 'company_id' => $company->id]);
                return redirect()->route('companies.index')->with('success', 'Company updated successfully');
            }

            LogHelper::errorLog('Company Update Failed', [['requested_by' => Auth::user()->email], 'company_id' => $company->id]);
            return redirect()->back()->with('error', 'Failed to update company')->withInput();
        } catch (\Exception $e) {
            LogHelper::errorLog('Company Update Exception', [['requested_by' => Auth::user()->email, 'company_id' => $company->id, 'error' => $e->getMessage()]]);
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified company from storage.
     * @author satiyaG <satiyaganes.sg@gmail.com>
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);
        
        // Delete company logo if exists
        if ($company->logo && Storage::disk('public')->exists($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }

        $deleted = $company->delete();
        
        if ($deleted) {
            LogHelper::successLog('Company Deleted', [['requested_by' => Auth::user()->email], 'company_id' => $id]);
            return redirect()->route('companies.index')->with('success', 'Company deleted successfully');
        }

        LogHelper::errorLog('Company Deletion Failed', [['requested_by' => Auth::user()->email], 'company_id' => $id]);
        return redirect()->back()->with('error', 'Failed to delete company');
    }
}
