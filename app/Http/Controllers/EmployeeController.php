<?php

namespace App\Http\Controllers; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee_type;
use App\Models\User;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class EmployeeController extends Controller
{
    
    //show dashboard

    public function index()
    { 
        return view('employee.dashboard');
    }

 

}
