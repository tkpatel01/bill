<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Expense;


class ExpenseController extends Controller
{
    public function showExpense()
    {
        // $expense = Expense::with(['customer:id,name'])->get();

        return view('expense/expensereport');
    }

    public function singleExpense(string $id)
    {
        $expense = DB::table('expenses')
            ->where('customer_id', $id)
            ->join('customers', 'expenses.customer_id', '=', 'customers.id')
            ->get();
        abort_if(!isset($id), 404);
        // return $customer;
        return view('expense/view_expense', ['data' => $expense]);
    }

    public function addExpense(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required',
            'item' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'payment' => 'required'
        ]);

        $expense = DB::table('expenses')->insert($data);
        // dd($expense);    
        if ($expense) {
            session()->flash('add-update', 'Expense has been added');
            return response()->json(['message' => 'Expense Add successfully']);
        } else {
            return response()->json(['message' => 'Failed to add Expense ']);
        }
    }

    public function updateExpensepage(string $id)
    {
        if (Auth::check()) {
            $customer = DB::table('customers')->get();
            $expense = DB::table('expenses')
                // ->join('customers', 'expenses.customer_id', '=', 'customers.id')
                ->find($id);
            abort_if(!isset($id), 404);
            // return $expense;
            return view('expense/update_expense', ['data' => $expense, 'customer' => $customer]);
        } else {
            return redirect()->route('login');
        }
    }

    public function updateExpense(Request $request)
    {
        $data = $request->validate([
            'item' => 'required',
            'date' => 'required',
            'amount' => 'required'
        ]);

        $expense = DB::table('expenses')
            ->where('id', $request->id)
            ->update([
                'item' => $request->item,
                'date' => $request->date,
                'amount' => $request->amount
            ]);

        if ($expense) {
            return response()->json(['message' => 'Expense update Successfully']);
        } else {
            return response()->json(['message' => 'Failed to Update Expense']);
        }
    }

    public function deleteExpense(string $id)
    {
        $expense = Expense::find($id)->delete();

        // $expense = DB::table('expenses')
        //     ->where('id', $id)
        //     ->delete();

        if ($expense) {

            session()->flash('delete');
            return redirect()->route('expense');
        }
    }

    public function report(Request $request)
    {
        $perPage = $request->input('lenght', 10);
        $start = $request->input('start', 0);
        $search = $request->input('search.value', '');
        $payment = $request->input('payment');
        $columnIndex = $request->input('order.0.column');
        $columnName = $request->input('columns.' . $columnIndex . '.data');
        $sort = $request->input('order.0.dir', '');

        if (empty($payment)) {
            $value = function ($a) use ($search) {
                $a->where('customers.name', 'like', '%' . $search . '%')
                    ->orWhere('item', 'like', '%' . $search . '%')
                    ->orWhere('date', 'like', '%' . $search . '%')
                    ->orWhere('amount', 'like', '%' . $search . '%')
                    ->orWhere('status', 'like', '%' . $search . '%');
            };
        } else {
            $value = function ($a) use ($payment) {
                $a->where('payment', '=', $payment);
            };
        }

        $filterdRecord = DB::table('expenses')
            ->select('expenses.*,customers.name as cname')
            ->join('customers', 'customers.id', '=', 'expenses.customer_id')  // Assuming there's a customer_id field in expenses
            ->where($value)
            ->whereNull('expenses.deleted_at')
            ->count();

        $query = DB::table('expenses')
            ->select('expenses.*', 'customers.name as cname')
            ->join('customers', 'customers.id', '=', 'expenses.customer_id')  // Assuming there's a customer_id field in expenses
            ->where($value)
            ->whereNull('expenses.deleted_at')
            ->orderBy($columnName, $sort)
            ->take($perPage)
            ->skip($start)
            ->get();

        $data = [];

        foreach ($query as $key => $value) {
            $data[] = [
                "id" => $value->id,
                "customer_id" => $value->cname,
                "item" => $value->item,
                "date" => $value->date,
                "amount" => $value->amount,
                "payment" => $value->payment,
                "status" => "<span class='badge bg-warning'>$value->status</span>",
                "action" => "<a href='/expense/" . $value->customer_id . "'><button class='btn btn-warning text-light'><i class='fa-solid fa-eye'></i></button></a>
                             <button class='btn btn-primary update_expense' data-toggle='modal' data-target='#modal' data-id='$value->id' data-customer_id='$value->customer_id' data-item='" . $value->item . "' data-date='$value->date' data-amount='$value->amount' data-payment='$value->payment'><i class='fa-solid fa-pen-to-square text-white'></i></button>
                             <a id='delete' href='/deleteexpense/" . $value->id . "' data-id=" . $value->id . "'><button class='btn btn-danger' data-confirm-delete='true'><i class='fa-solid fa-trash text-white'></i></button></a>"
            ];
        }
        // $data = Expense::all();

        $response = [
            "draw" => (int) $request->input('draw', ''),
            "recordsTotal" => Expense::count(),
            "recordsFiltered" => $filterdRecord,
            "data" => $data
        ];
        // dd($response);
        return response()->json($response);

    }

    public function selectreport(Request $request)
    {
        $payment['results'] = Customer::select(['id', 'name as text'])
            ->where(function ($q) use ($request) {
                if (!empty($request->q)) {
                    $q->where('name', 'like', '%' . $request->q . '%');
                }
            })->get();

        return response()->json($payment);
    }

    // drop down
    public function customer()
    {
        $data['customer'] = Customer::get();
        return view('expense/add_expense', $data);
    }

}
