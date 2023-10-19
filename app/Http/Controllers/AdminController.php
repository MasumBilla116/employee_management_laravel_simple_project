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
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    //show dashboard

    public function index()
    {
        $total_salary = Employee::sum("salary");
        $total_emp = Employee::count("id");
        return view('admin.home', compact("total_salary", "total_emp"));
    }


    // show employee

    public function employees()
    {
        $department = Department::all();
        $designation = Designation::all();
        $employee_type = Employee_type::all(); 
        return view('admin.employees', compact("employee_type", "designation", "department"));
    }


    public function dataTableData(Request $request)
    {
        $users = User::join("employees", "users.id", "=", "employees.user_id")
        ->join("departments", "users.department_id", "=", "departments.dept_id")
        ->join("designations", "employees.designation_id", "=", "designations.designation_id")
        ->join("employee_types", "employees.emp_type_id", "=", "employee_types.emp_type_id")
        ->select("users.name", "users.id", "users.email", "users.status", "users.phone", "employees.designation_id", "employees.experience", "employees.address", "employees.religion", "employees.joining_date", 'employees.salary', "employee_types.employee_type", "departments.dept_name", "designations.designation")
        ->orderBy("users.id", "DESC");

        if($request->from_date != "")
        {
            $from_date = $request->from_date;
            $users = $users->whereDate("employees.updated_at",">=",$from_date);
        }

        if($request->to_date != "")
        {
            $to_date = $request->to_date; 
            $users = $users->whereDate("employees.updated_at","<=",$to_date);
        }
        

        if($request->designation != "")
        {
            $designation = $request->designation; 
            $users = $users->where("employees.designation_id",$designation);
        }

        if($request->salary != "")
        {
            $salary = $request->salary; 
            $users = $users->where("employees.salary",$salary);
        }
 
        return response()->json([
            "data"=> $users->get()
        ]);
    }



     // store employee

     public function storeEmployee(Request $request)
     {
         try {
             $check_exist_user = User::where("email", $request->email)->first();
             if ($check_exist_user) {
                 return response()->json([
                     "status" => "error",
                     "message" => "Email is already existed"
                 ]);
             }
 
             // Create new user
             $user = new User();
             $user->name = $request->name;
             $user->email = $request->email;
             $user->phone = $request->phone;
             $user->department_id = $request->department;
             $user->password = $request->password;
 
             // Create new employee
             $emp = new Employee();
             $emp->designation_id = $request->designation;
             $emp->emp_type_id = $request->emp_type;
             $emp->joining_date = $request->joining_date;
             $emp->DoB = $request->dob;
             $emp->gender = $request->gender;
             $emp->address = $request->address;
             $emp->salary = $request->salary;
             $emp->religion = $request->religion;
             $emp->experience = $request->experience;
 
             if ($user->save()) {
                 $user_id = User::where("email", $request->email)->first();
                 $emp->user_id =  $user_id->id;
                 $emp->save();
 
                 //  return JSON response
                 $targetTable = $request->input('target_table', 'default'); // 'default' is the default table
                 return response()->json([
                     "status" => "success",
                     "message" => "Employee added successfully",
                     "target_table" => $targetTable
                 ]);
             }
 
             return response()->json([
                 "status" => "error",
                 "message" => "Something is wrong"
             ]);
         } catch (Exception $error) {
             return response()->json([
                 "status" => "error",
                 "message" => "Something is wrong"
             ]);
         }
     }

     
    
    /**
     * 
     * update employee 
     * 
     * * */
    public function editEmployeeInfo($id)
    {
        try {

            $user =  User::join("employees", "users.id", "=", "employees.user_id")
            ->join("departments", "users.department_id", "=", "departments.dept_id")
            ->join("designations", "employees.designation_id", "=", "designations.designation_id")
            ->join("employee_types", "employees.emp_type_id", "=", "employee_types.emp_type_id") 
            ->where("users.id",$id)
            ->select("users.name", "users.id", "users.email", "users.status", "users.phone", "employees.experience", "employees.DoB" ,"employees.address", "employees.joining_date", 'employees.salary', "employees.gender","employees.religion","employees.payment_status", "employees.emp_type_id", "departments.dept_id as department_id", "designations.designation_id")
            ->first();

            return response()->json([
                'status' => 'success',
                "data" => $user
            ]);
        } catch (Exception $error) {
            return  response()->json([
                "status" => "error",
                "message" => "Something is worng"
            ]);
        }
    }


    // update employee 
    public function updateEmployee(Request $request)
    {

        try {

            // for new user
            $user = User::find($request->user_id);
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->department_id  = $request->department;

            // for new employee
            $emp = Employee::find($request->user_id);
            $emp->designation_id   = $request->designation;
            $emp->emp_type_id   = $request->emp_type;
            $emp->joining_date  = $request->joining_date;
            $emp->DoB  = $request->dob;
            $emp->gender  = $request->gender;
            $emp->address  = $request->address;
            $emp->salary  = $request->salary;
            $emp->religion  = $request->religion;
            $emp->experience  = $request->experience; 

            if ($user->update() && $emp->update()) {
                return response()->json([
                    "status" => "success",
                    "message" => "Employee updated successfully"
                ]);
            }

            return  response()->json([
                "status" => "error",
                "message" => "Something is worng"
            ]);
        } catch (Exception $error) {
            return  response()->json([
                "status" => "error",
                "message" => "Something is worng "
            ]);
        }
    }



     //delete employee
     public function deleteEmployee($user_id)
     {
         try {
             $employee = Employee::find($user_id);
             $user = User::find($user_id);
 
             if ($user) {
                 $employee->delete();
                 if ($user->delete()) {
                     return response()->json([
                         "status" => "success",
                         "message" => "Delete success"
                     ]);
                 }
                 return response()->json([
                     "status" => "error",
                     "message" => "Something is wrong"
                 ]);
             }
 
             return response()->json([
                 "status" => "error",
                 "message" => "Data is not found"
             ]);
         } catch (\Exception $error) {
             //return $error;
         }
     }
    
     
    public function paymentSuccess()
    { 
        return view('admin.payment_success');
    }

    // payment paid
    public function paymentPaid($id)
    {   
        $emp = Employee::find($id);
        $emp->payment_status = "paid";
        if($emp->update())
        {
            return response()->json([
                "success"=> true,
            ]);
        }
        else{
            return response()->json([
                "success"=> false,
            ]);
        } 

    }
 

    // payment success
    public function employeePaymentTable()
    {
        $department = Department::all();
        $designation = Designation::all();
        $employee_type = Employee_type::all(); 
        return view('admin.payment', compact("employee_type", "designation", "department"));
    } 

    public function employeePaymentDataTableData(Request $request)
    {
        $users = User::join("employees", "users.id", "=", "employees.user_id")
        ->join("departments", "users.department_id", "=", "departments.dept_id")
        ->join("designations", "employees.designation_id", "=", "designations.designation_id")
        ->join("employee_types", "employees.emp_type_id", "=", "employee_types.emp_type_id")
        ->select("users.name", "users.id", "users.email", "users.status", "users.phone", "employees.experience", "employees.address", "employees.religion", "employees.payment_status", 'employees.salary', "employee_types.employee_type", "departments.dept_name", "designations.designation")
        ->orderBy("users.id", "DESC");
        
 
        if($request->from_date != "")
        {
            $from_date = $request->from_date;
            $users = $users->whereDate("employees.updated_at",">=",$from_date);
        }

        if($request->to_date != "")
        {
            $to_date = $request->to_date; 
            $users = $users->whereDate("employees.updated_at","<=",$to_date);
        }
        

        if($request->designation != "")
        {
            $designation = $request->designation; 
            $users = $users->where("employees.designation_id",$designation);
        }

        if($request->salary != "")
        {
            $salary = $request->salary; 
            $users = $users->where("employees.salary",$salary);
        }
 
        return response()->json([
            "data"=> $users->get()
        ]);
    }


    /**
     * 
     * download employee pdf
     * 
     * * */

    public function employeeTablePDF(Request $request)
    { 
        $department = Department::all();
        $designation = Designation::all();
        $employee_type = Employee_type::all();
        $users = User::join("employees", "users.id", "=", "employees.user_id")
            ->join("departments", "users.department_id", "=", "departments.dept_id")
            ->join("designations", "employees.designation_id", "=", "designations.designation_id")
            ->join("employee_types", "employees.emp_type_id", "=", "employee_types.emp_type_id")
            ->select("users.name", "users.id", "users.email", "users.status", "users.phone", "employees.designation_id", "employees.experience", "employees.address", "employees.religion", "employees.joining_date", 'employees.salary', "employee_types.employee_type", "departments.dept_name", "designations.designation")
            ->orderBy("users.id", "DESC"); 

        if($request->from_date != "")
        {
            $from_date = $request->from_date;
            $users = $users->whereDate("employees.updated_at",">=",$from_date);
        }

        if($request->to_date != "")
        {
            $to_date = $request->to_date; 
            $users = $users->whereDate("employees.updated_at","<=",$to_date);
        }

        if($request->designation != "")
        {
            $designation = $request->designation; 
            $users = $users->where("employees.designation_id",$designation);
        }

        if($request->salary != "")
        {
            $salary = $request->salary; 
            $users = $users->where("employees.salary",$salary);
        }

        $users = $users->get();
        $pdf = PDF::loadView('pdf.total_employee', compact("employee_type", "designation", "department", "users"));
        return $pdf->stream();
    }

    /**
     * 
     * download employee payment pdf
     * 
     * * */
    public function employeePayment(request $request)
    {

        $department = Department::all();
        $designation = Designation::all();
        $employee_type = Employee_type::all();
        $users = User::join("employees", "users.id", "=", "employees.user_id")
        ->join("departments", "users.department_id", "=", "departments.dept_id")
        ->join("designations", "employees.designation_id", "=", "designations.designation_id")
        ->join("employee_types", "employees.emp_type_id", "=", "employee_types.emp_type_id")
        ->select("users.name", "users.id", "users.email", "users.status", "users.phone", "employees.experience", "employees.address", "employees.religion", "employees.joining_date", 'employees.salary',"employees.payment_status", "employee_types.employee_type", "departments.dept_name", "designations.designation")
        ->orderBy("users.id", "DESC");
        
        if($request->from_date != "")
        {
            $from_date = $request->from_date;
            $users = $users->whereDate("employees.updated_at",">=",$from_date);
        }

        if($request->to_date != "")
        {
            $to_date = $request->to_date; 
            $users = $users->whereDate("employees.updated_at","<=",$to_date);
        }

        if($request->designation != "")
        {
            $designation = $request->designation; 
            $users = $users->where("employees.designation_id",$designation);
        }

        if($request->salary != "")
        {
            $salary = $request->salary; 
            $users = $users->where("employees.salary",$salary);
        }

        $users = $users->get();
        $pdf = PDF::loadView('pdf.total_employee', compact("employee_type", "designation", "department", "users"));
        return $pdf->stream();
    }


  


    
}



