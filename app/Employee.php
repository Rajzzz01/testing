<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Company;

class Employee extends Model
{
    protected $guarded =[];
    
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');  
    }
}
