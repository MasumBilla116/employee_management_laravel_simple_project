<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//auth route
Route::get('/login', function () {
    return redirect('/');
});

Route::get('/', [AuthController::class, 'index'])->name('auth.index');
Route::post("/users/login", [AuthController::class, "userLogin"])->name("users.login");
Route::get("/auth/error", [AuthController::class, "authError"])->name("auth.error");
Route::get("/logout", [AuthController::class, "logout"])->name("auth.logout");


Route::middleware(['admin_middleware'])->group(function () {

    // dashboard
    Route::get('/home', [AdminController::class, 'index'])->name('admin.index');

    //show employee
    Route::get('/employees', [AdminController::class, 'employees'])->name('admin.employees');
    Route::get('/datatable', [AdminController::class, 'dataTableData'])->name('admin.datatable');

    // add ,Edit , Delete Employee
    Route::post("/store/employee", [AdminController::class, "storeEmployee"]);
    Route::get("/delete/employee/{user_id}", [AdminController::class, "deleteEmployee"]);
    Route::get('/edit/employee_info/{id}', [AdminController::class, 'editEmployeeInfo']);
    Route::post('/update/employee_info', [AdminController::class, 'updateEmployee']);

    // payment
    Route::get('/employees/payment', [AdminController::class, 'employeePaymentTable'])->name('admin.employees.payment');
    Route::get('/employees/payment/datatable', [AdminController::class, 'employeePaymentDataTableData'])->name('admin.employees.payment.datatable');
    Route::get('/salary/payment/success', [AdminController::class, 'paymentSuccess'])->name('admin.employees.payment.success');
    Route::get('/payment/paid/{id}', [AdminController::class, 'paymentPaid'])->name('admin.employees.payment.paid');

    // pdf

    Route::get('/employee/table/pdf', [AdminController::class, 'employeeTablePDF'])->name('employee.table.pdf');

    Route::get('/employee/payment/pdf', [AdminController::class, 'employeePayment'])->name('employee.payment.pdf');


    // email 
    Route::get('/contact/email', [EmailController::class, 'emailContact'])->name('contact.email');
    Route::post('/send/email', [EmailController::class, 'index'])->name('send.email');
}); 

/// route for eamployee
Route::middleware(['employee_middleware'])->group(function(){
    // dashboard
    Route::get('/employee/dashboard', [EmployeeController::class, 'index'])->name('employee.dashboard');
});
