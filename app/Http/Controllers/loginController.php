<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\users;
use App\Models\Customer;
use App\Models\Expense;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;


class loginController extends Controller
{
    public function index()
    {
        if (Auth::check() && (Auth::user()->otp != null) && (Auth::user()->status == 'active')) {
            return view('dashboard');
        } else {
            return redirect()->route('login');
        }
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'role' => 'required',
            'name' => 'required',
            'mobile' => 'required|size:10|unique:users,mobile',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|confirmed',
        ]);
        // $user = DB::table('users')->insert($data);
        $user = user::create($data);

        // redirect after successfully register
        if ($user) {
            return redirect()->route('login');
        }
    }

    public function login(Request $request)
    {
        $login = $request->input('email');
        $admin = users::where('email', $login)->orWhere('mobile', $login)->first();

        if (!$admin) {
            return redirect()->back()->withErrors(['email' => 'Invalid Email or Mobile no']);
        }

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (
            Auth::attempt(['email' => $admin->email, 'password' => $request->password]) ||
            Auth::attempt(['mobile' => $admin->mobile, 'password' => $request->password])
        ) {
            $otp = $this->randomeOtp();
            $setOtp = users::where('id', $admin->id)->update(['otp' => $otp]);
            $userEmail = Auth::user()->email;
            Mail::to($userEmail)->send(new OtpMail($otp));
            // Auth::loginUsingId($admin->id);
            $user_id = $admin->id;
            Auth::loginUsingId($user_id);
            return redirect('/otp/' . $user_id);
        } else {
            return redirect()->back()->withErrors(['password' => 'Invalid password']);
        }
    }

    public function otpPage(string $id)
    {
        $user = $id;
        // if ((Auth::check()) && (Auth::user()->otp != null) && (Auth::user()->status == 'online')) {
        //     return redirect()->route('dashboard');
        // } else if ((Auth::check()) && (Auth::user()->otp != null) && (Auth::user()->status == 'offline')) {
        return view('otp', compact('user'));
        // } else {
        //     return redirect()->route('login');
        // }
    }

    private function randomeOtp()
    {
        return rand('1000', '9999');
    }
    
    public function otpMatch(Request $request)
    {
        $currendID = $request->id;
        $currendOTP = $request->otp;

        // dd(Auth::user()->id == $currendID);
        if (($currendID == Auth::user()->id) && (Auth::user()->otp == $currendOTP) && (Auth::user()->status == 'inactive')) {
            $setStatus = User::where('id', $currendID)->update(['status' => 'active']);
            if ($setStatus) {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('otp');
            }
        } else {
            return redirect('otp/' . $currendID);
        }
    }

    public function dashboardPage()
    {
        $customer = Customer::sum('id');
        $total_expnese = Expense::sum('amount');

        if ((Auth::check()) && (Auth::user()->otp != null) && (Auth::user()->status == 'active')) {
            return view('dashboard', compact('customer', 'total_expnese'));
        } else if ((Auth::check()) && (Auth::user()->otp != null) && (Auth::user()->status == 'inactive')) {
            $user = Auth::user()->id;
            return redirect('/otp/' . $user);
        } else {
            return redirect()->route('login');
        }
    }

    // user
    public function showUsers()
    {
        return view('user/user');
    }

    public function singleUser(string $id)
    {
        $users = db::table('users')->where('id', $id)->get();
        abort_if(!isset($id), 404);
        // return $users;
        return view('user/viewuser', ['data' => $users]);

    }

    public function addUser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'mobile' => 'required|size:10|unique:users,mobile',
            'role' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required'
        ]);

        // $user = DB::table('users')->insert($data);
        $user = users::create($data);
        if ($user) {
            return response()->json(['message' => 'User Added successfully']);
        } else {
            return response()->json(['message' => 'Failed to add User']);
        }
    }

    public function updateUserpage(string $id)
    {
        $users = db::table('users')->find($id);
        abort_if(!isset($id), 404);
        // return $users;
        return view('user/updateuser', ['data' => $users]);
    }

    public function updateUser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'mobile' => 'required|size:10|unique:users,mobile,' . $request->id,
            'email' => 'required|email|unique:users,email,' . $request->id,
            'role' => 'required',
        ]);

        $user = users::find($request->id)->update(
            [
                'name' => $request->name,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'role' => $request->role,
            ]
        );

        if ($user) {
            return response()->json(['message' => 'User update successfully']);
        } else {
            return response()->json(['message' => 'Failed to update User']);
        }
    }

    public function deleteUser(string $id)
    {
        // $user = DB::table('users')->where('id', $id)->delete();
        $user = User::find($id)->delete();
        if ($user) {
            return redirect()->route('user');
        }
    }

    public function usereport(Request $request)
    {
        $perPage = $request->input('lenght', 10);
        $start = $request->input('start', 0);
        $search = $request->input('search.value', '');

        $value = function ($a) use ($search) {
            $a->where('name', 'like', '%' . $search . '%')
                ->orWhere('mobile', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        };

        $filterdRecord = User::query()
            ->where($value)
            ->count();

        $query = User::query()
            ->where($value)
            ->take($perPage)
            ->skip($start)
            ->get();

        $data = [];

        foreach ($query as $key => $value) {
            $data[] = [
                "id" => $value->id,
                "role" => $value->role,
                "name" => $value->name,
                "mobile" => $value->mobile,
                "email" => $value->email,
                "action" => "<a href='/user/" . $value->id . "'><button class='btn btn-warning text-light'><i class='fa-solid fa-eye'></i></button></a>
                             <button class='btn btn-primary update_user' data-toggle='modal' data-target='#modal-lg' data-id='$value->id' data-role='$value->role' data-name='$value->name' data-mobile='$value->mobile' data-email='$value->email'><i class='fa-solid fa-pen-to-square text-white'></i></button>
                             <a id='delete' href='/delete/" . $value->id . "' data-id=" . $value->id . "'><button class='btn btn-danger' data-confirm-delete='true'><i class='fa-solid fa-trash text-white'></i></button></a>"

            ];
        }

        $response = [
            "draw" => (int) $request->input('draw', ''),
            "recordsTotal" => User::count(),
            "recordsFiltered" => $filterdRecord,
            "data" => $data
        ];
        // dd($response);
        return response()->json($response);

    }
    // user end

    public function logout()
    {
        $id = Auth::user()->id;
        $setStatus = User::where('id', $id)->update(['otp' => null, 'status' => 'inactive']);
        if ($setStatus) {
            Auth::logout();
            return redirect()->route('login');
        }
    }

}
