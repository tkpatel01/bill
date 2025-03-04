<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function invoice($id)
    {

        $data = Customer::find($id);
        $expense = Expense::where('customer_id', $id)->get();
        // echo $expense; exit;

        return view('invoice', compact('data', 'expense'));

    }
}
