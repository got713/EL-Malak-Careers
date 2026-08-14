<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query = Company::with(['user', 'jobs']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('industry', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('email', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $status = $request->status;
            if ($status === 'pending') {
                $query->where('is_verified', false);
            } elseif ($status === 'verified') {
                $query->where('is_verified', true);
            }
        }

        $companies = $query->latest()->paginate(15)->withQueryString();

        $totalCompaniesCount = Company::count();
        $pendingCompaniesCount = Company::where('is_verified', false)->count();
        $verifiedCompaniesCount = Company::where('is_verified', true)->count();

        return view('admin.companies.index', compact(
            'companies',
            'totalCompaniesCount',
            'pendingCompaniesCount',
            'verifiedCompaniesCount'
        ));
    }

    public function verify(Company $company)
    {
        $company->forceFill(['is_verified' => true])->save();

        return back()->with('success', __('Company account approved and verified successfully.'));
    }

    public function reject(Company $company)
    {
        $company->forceFill(['is_verified' => false])->save();

        return back()->with('success', __('Company account rejected and set to pending.'));
    }

    public function destroy(Company $company)
    {
        $user = $company->user;
        
        $company->delete();
        if ($user) {
            $user->delete();
        }

        return back()->with('success', __('Company account deleted successfully.'));
    }
}
