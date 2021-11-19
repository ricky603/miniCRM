<?php

namespace App\Http\Controllers\Admin\Companies;

use App\Mail\notificationMail;
use App\Models\Companies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\companies\StoreCompanyRequest;
use App\Http\Requests\companies\UpdateCompanyRequest;
use App\Http\Requests\companies\UpdateCompanyLogoRequest;
use Illuminate\Support\Facades\Mail;
use App\Jobs;
use Illuminate\Support\Facades\Http;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $company = companies::all();
        // if ($request->ajax()) {
        //     return datatables()->of($company)->make(true);
        // }

        // return view('admin.companies.index');
        return view('admin.companies.index', ['companies' => companies::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    public function createEmployee(Companies $company)
    {
        return view('admin.companies.employees', compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyRequest $request)
    {
        $company = Companies::create($request->only('name', 'email', 'website'));

        if ($request->hasFile('photo')) {
            $path = $request->photo->store('public/companies/logo/images');
            $company->update(['photo'=>$path]);
        }

        if ($request->has('email')) {
            $details = [
                'email' => $request->email,
                'title' => 'Mail From Mini-CRM',
                'body' => 'Congratulations your company has been addded to mini-CRM.'
            ];
            dispatch(new Jobs\SendMail($details));
        }

        return redirect()->route('admin.companies.show', $company->id)->with('success', 'succesfully Create a New Company');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $company)
    {
        return view('admin.companies.show', compact('company'));
    }

    public function showEmployees(Companies $company)
    {
        // dd($company);
        return view('admin.companies.showEmployees', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Companies $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Companies $company)
    {
        $company->update($request->validated());

        return back()->with('success', 'successfully updated company details!');
    }

    public function updateCompanyLogo(UpdateCompanyLogoRequest $request, Companies $company)
    {
        if ($company->photo) {
            Storage::delete($company->photo);
        }
        $path = $request->photo->store('public/companies/logo/images');
        $company->update(['photo'=>$path]);

        return back()->with('success', 'successfully updated company logo');
    }

    public function destroyCompanyLogo(Companies $company)
    {
        if ($company->photo) {
            Storage::delete($company->photo);

            $company->update(['photo' => null]);
        }

        return back()->with('success', 'Successfully deleted company logo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $company)
    {
        if ($company->photo) {
            Storage::delete($company->photo);
        }

        $company->delete();

        return redirect()->route('admin.companies.dashboard')->with('success', 'Successfully deleted company!');
    }
}
