<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class CustomerController extends Controller
{

    public function showCustomer()
    {
        return view('customer/customer');
    }

    public function singleCustomer(string $id)
    {
        $customer = DB::table('customers')->where('id', $id)->get();
        abort_if(!isset($id), 404);
        // return $customer;
    }

    public function addCustomer(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'mobile' => 'required|size:10|unique:customers,mobile',
            'email' => 'required|email|unique:customers,email',
            'city' => 'required'
        ]);

        if ($data) {
            $customer = new Customer;

            $customer->name = $request->name;
            $customer->gender = $request->gender;
            $customer->mobile = $request->mobile;
            $customer->email = $request->email;
            $customer->city = $request->city;

            if ($customer->save()) {
                // session()->flash('add-update', 'Customer has been added');
                return response()->json(['message' => 'Customer has been added']);
            } else {
                return response()->json(['message' => 'Failed to add Customer']);
            }
        }

        // $customer = DB::table('customers')->insert($data);
    }

    public function updateCustomerpage(string $id)
    {
        $customer = DB::table('customers')->find($id);
        abort_if(!isset($id), 404);
        // return $customer;
        return view('customer/customer', ['data' => $customer]);
    }

    public function updateCustomer(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'mobile' => 'required|size:10',
            'email' => 'required|email',
            'city' => 'required'
        ]);

        $customer = DB::table('customers')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'city' => $request->city
            ]);

        if ($customer) {
            return response()->json(['message' => 'Customer update successfully']);
        } else {
            return response()->json(['message' => 'Failed to update customer']);
        }
    }

    public function deleteCustomer(string $id)
    {
        $customer = DB::table('customers')
            ->where('id', $id)
            ->delete();

        if ($customer) {
            return redirect()->route('customer');
        }
    }

    public function Customereport(Request $request)
    {
        $perPage = $request->input('lenght', 10);
        $start = $request->input('start', 0);
        $search = $request->input('search.value', '');

        $value = function ($a) use ($search) {
            $a->where('name', 'like', '%' . $search . '%')
                ->orWhere('gender', 'like', '%' . $search . '%')
                ->orWhere('mobile', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('city', 'like', '%' . $search . '%');
        };

        $filterdRecord = Customer::query()
            ->where($value)
            ->count();

        $query = Customer::query()
            ->where($value)
            ->take($perPage)
            ->skip($start)
            ->get();

        $data = [];

        foreach ($query as $key => $value) {
            $data[] = [
                "id" => $value->id,
                "name" => $value->name,
                "total" => $value->Expense->sum('amount'),
                "gender" => $value->gender,
                "mobile" => $value->mobile,
                "email" => $value->email,
                "city" => $value->city,
                "action" => "<a href='/invoice/" . $value->id . "'><button class='btn btn-success text-light'>invoice</button></a>
                             <a href='/customer/" . $value->id . "'><button class='btn btn-warning text-light'><i class='fa-solid fa-eye'></i></button></a>
                             <button type='button' class='btn btn-primary update_customer' data-toggle='modal' data-target='#modal-lg' data-id='$value->id' data-name='$value->name' data-mobile='" . $value->mobile . "' data-email='$value->email' data-city='$value->city' data-gender='$value->gender'><i class='fa-solid fa-pen-to-square text-white'></i></button>
                             <a id='delete' href='/deletecustomer/" . $value->id . "' data-id=" . $value->id . "'><button class='btn btn-danger' data-confirm-delete='true'><i class='fa-solid fa-trash text-white'></i></button></a>"

            ];
        }

        $response = [
            "draw" => (int) $request->input('draw', ''),
            "recordsTotal" => Customer::count(),
            "recordsFiltered" => $filterdRecord,
            "data" => $data
        ];
        // dd($response);
        return response()->json($response);

    }

}
