<?php

use App\Http\Controllers\EmailController;
use App\Http\Controllers\master\CountryController;
use App\Http\Controllers\master\StateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceController;
use App\Models\Customer;
use App\Http\Middleware\ValidUser;

// Login page
Route::get('/', function () {
    return view('/login');
});

// login, Register, User, Logout
Route::controller(loginController::class)->group(function () {
    // new Register
    Route::view('registers', 'register')->name('register');
    Route::post('registerSave', 'register')->name('registerSave');

    // Login
    Route::view('login', 'login')->name('login');
    Route::post('loginMatch', 'login')->name('loginMatch');
    Route::get('/otp/{id}', 'otpPage')->name('otp'); // Otp
    Route::post('/otpMatch', 'otpMatch')->name('otpMatch'); // OTP Match

    // Logout
    Route::get('logout', 'logout')->name('logout');
});

Route::get('dashboard', [loginController::class, 'dashboardPage'])->name('dashboard');

Route::middleware(['IsValid:admin'])->group(function () {
    Route::controller(loginController::class)->group(function () {
        // redirect after successfully login
        Route::get('user', 'showUsers')->name('user');

        Route::get('/user/{id}', 'singleUser')->name('view.user');

        Route::view('newuser', 'user/adduser')->name('newuser');
        Route::post('/add', 'addUser')->name('add_user');

        Route::post('/updateUser', 'updateUser')->name('update_user'); // using on submit form 
        Route::get('/updatepage', 'updateUserpage')->name('update.userpage');

        Route::get('/delete/{id}', 'deleteUser')->name('delete.user');

        Route::post('/usereport', 'usereport')->name('userReport');
    });
});

Route::middleware(['IsValid:admin,reader'])->group(function () {
    // Customer
    Route::controller(CustomerController::class)->group(function () {

        Route::get('customer', 'showCustomer')->name('customer');

        Route::get('/customer/{id}', 'singleCustomer')->name('view.customer');

        // Route::view('newcustomer', 'customer/customer');
        Route::post('/addCustomer', 'addCustomer')->name('addCustomer');

        // Route::get('/updateCustomerpage/{id}', 'updateCustomerpage')->name('update.customerpage');
        Route::post('/updateCustomer', 'updateCustomer')->name('update_customer'); // using on submit form 

        Route::get('/deletecustomer/{id}', 'deleteCustomer')->name('delete.customer');

        Route::post('/customerreport', 'Customereport')->name('customerReport');
    });

    // Expense
    Route::controller(ExpenseController::class)->group(function () {

        Route::get('expense', 'showExpense')->name('expense');

        Route::get('/expense/{id}', 'singleExpense')->name('view.expense');

        // Route::view('newexpense', 'expense/add_expense');
        Route::get('newexpense', 'customer');
        Route::post('/addExpense', 'addExpense')->name('addExpense');

        Route::post('/update', 'updateExpense')->name('update_expense'); // using on submit form 
        // Route::get('update/{id}', 'customer');
        // Route::get('/updateExpensepage/{id}', 'updateExpensepage')->name('update.expensepage');

        Route::any('/deleteexpense/{id}', 'deleteExpense')->name('delete.expense');

        Route::any('expensereport', 'report')->name('expenseReport');
        Route::get('selectname', 'selectreport')->name('selectName');

    });

    Route::controller(InvoiceController::class)->group(function () {

        Route::get('invoice/{id}', 'invoice')->name('invoice');

    });

     Route::controller(CountryController::class)->group(function () {

        Route::get('country','ShowCountry')->name('country');
        Route::post('/addCountry', 'addCountry')->name('addCountry');
        Route::post('/updateCountry', 'updateCountry')->name('update_country');
        Route::get('/deletecountry/{id}', 'deleteCountry')->name('delete.country');
        Route::post('/countryreport', 'Countryreport')->name('countryReport');
    });

    Route::controller(StateController::class)->group(function () {

        Route::get('state','ShowState')->name('state');
        Route::post('/addState', 'addState')->name('addState');
        Route::post('/updateState', 'updateState')->name('update_state');
        Route::get('/deleteState/{id}', 'deleteState')->name('delete.state');
        Route::post('/statereport', 'Statereport')->name('stateReport');
        Route::get('selectcountry', 'selectcountry')->name('selectcountry');
    });
});


Route::get('send-email', [EmailController::class, 'sendEmail']);
Route::get('/invoice ', function () {
    return view('invoice');
})->name('invoice');

Route::fallback(function () {
    return view('404');
})->name('404');
