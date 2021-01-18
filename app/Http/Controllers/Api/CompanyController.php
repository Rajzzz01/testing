<?php

namespace App\Http\Controllers\Api;
use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function getAllCompany() {
        $company = Company::get()->toJson(JSON_PRETTY_PRINT);
        return response($company, 200);
    }

    public function getCompany($id) {
        if (Company::where('id', $id)->exists()) {
            $company = Company::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($company, 200);
        } else {
            return response()->json([
                "message" => "Company not found"
            ], 404);
        }
    }

    public function createCompany(Request $request) {
        $data = $request->all();
        $company = Company::create($data);
        $this->storeImage($company);

        return response()->json([
            "message" => "Company record created"
        ], 201);
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

    public function updateCompany(Request $request, $id) {
        if (Company::where('id', $id)->exists()) {
            $company = Company::find($id);
    
            $company->update($company);
            $this->storeImage($company);
    
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Book not found"
            ], 404);
        }
    }

    public function deleteCompany ($id) {
        if(Company::where('id', $id)->exists()) {
            $company = Company::find($id);
            $this->deleteImage($company->logo);
            $company->delete();
            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Book not found"
            ], 404);
        }
    }
}
