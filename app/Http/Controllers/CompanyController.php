<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBY('id','desc')->paginate(10);
        return view('backcompanies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company    = new Company();
        return view('backcompanies.create',compact('company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $method = "Store";
        $company = Company::create($this->validateRequest($method));
        $this->storeImage($company);
        $notification = array(
            'message'       => 'Company Created Successfully',
            'alert-type'    => 'success'
        );
        
        return redirect('company')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('backcompanies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $method = "Update";
        $company->update($this->validateRequest($method));
        $this->storeImage($company);
        $notification = array(
                'message'    => 'Company Record Updated Sucessfully',
                'alert-type' => 'info'
            );
        return redirect('company')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $this->deleteImage($company->logo);
        $company->delete();
        $notification = array(
            'message'    => 'Company Deleted Sucessfully',
            'alert-type' => 'error'
        );

        return redirect('company')->with($notification);
    }
    
    private function validateRequest($method){
        if($method === 'Store'){
            return tap( request()->validate([
                'name'          => 'required',
                'email'         => 'required|unique:App\Company,email',
                'website'       => 'required',

            ]), function(){

                if( request()->hasFile('logo')){
                    request()->validate([
                        'logo'       => 'file|image|max:6000',
                    ]);
                }

            });
        }else{
            return tap( request()->validate([
                'name'          => 'required',
                'email'         => 'required',
                'website'       => 'required',

            ]), function(){

                if( request()->hasFile('logo')){
                    request()->validate([
                        'logo'       => 'file|image|max:6000',
                    ]);
                }

            });

        }    

    }
    
    private function storeImage($company){

        if( request()->hasFile('logo')){
            $this->deleteImage($company->logo);
            $company->update([
                'logo'     => request()->logo->store('Company-logo', 'public'),
            ]);

            $image = Image::make(public_path('storage/'. $company->logo));
            $image->save();

        }
    }

    private function deleteImage($filedelete){
        $filename = public_path().'/storage/'.$filedelete;
        \File::delete($filename);
        return true;
    }
}
