<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Company;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('company')->orderBY('id','desc')->paginate(10);
        return view('backemployees.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee    = new Employee();
        $companies   = Company::all();
        return view('backemployees.create',compact('employee','companies'));
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
        $employee = Employee::create($this->validateRequest($method));
        $notification = array(
            'message'       => 'Employee Created Successfully',
            'alert-type'    => 'success'
        );
        
        return redirect('employee')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $companies   = Company::all();
        return view('backemployees.edit',compact('employee','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $method = "Update";
        $employee->update($this->validateRequest($method));
        $notification = array(
                'message'    => 'Employee Record Updated Sucessfully',
                'alert-type' => 'info'
            );
        return redirect('employee')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        $notification = array(
            'message'    => 'employee Deleted Sucessfully',
            'alert-type' => 'error'
        );

        return redirect('employee')->with($notification);
    }

    private function validateRequest($method){
        if($method === 'Store'){
            return request()->validate([
                'company_id'        => 'required',
                'first_name'        => 'required',
                'last_name'         => 'required',
                'email'             => 'required|unique:App\Employee,email',
                'phone_number'      => 'required|unique:App\Employee,phone_number|digits:10'
            ]);
        }else{
            return request()->validate([
                'company_id'        => 'required',
                'first_name'        => 'required',
                'last_name'         => 'required',
                'email'             => 'required',
                'phone_number'      => 'required|digits:10'
            ]);
        }
        

    }
}
