<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StateController extends Controller
{
    public function ShowState()
    {
        return view('master/state');
    }

    public function addState(Request $request)
    {
        $data = $request->validate([
            'country_id' => 'required',
            'name' => 'required'
        ]);

        if ($data) {
            $state = new State();

            $state->country_id = $request->country_id;
            $state->name = $request->name;

            if ($state->save()) {
                return response()->json(['message' => 'State has been added']);
            } else {
                return response()->json(['message' => 'Failed to add State']);
            }
        }
    }

    public function updateState(Request $request)
    {
        $data = $request->validate([
            'country_id' => 'required',
            'name' => 'required'
        ]);

        $state = DB::table('countrys')
            ->where('id', $request->id)
            ->update([
                'country_id' =>$request->country_id,
                'name' => $request->name
            ]);

        if ($state) {
            return response()->json(['message' => 'Country update successfully']);
        } else {
            return response()->json(['message' => 'Failed to update Country']);
        }
    }

    public function deleteState(string $id)
    {
        $state = DB::table('states')
            ->where('id', $id)
            ->delete();

        if ($state) {
            return redirect()->route('state');
        }
    }

    public function Statereport(Request $request)
    {
        $perPage = $request->input('lenght', 10);
        $start = $request->input('start', 0);
        $search = $request->input('search.value', '');

        $value = function ($a) use ($search) {
            $a->where('name', 'like', '%' . $search . '%');
        };

        $filterdRecord = State::query()
            ->where($value)
            ->count();

        $query = State::query()
            ->where($value)
            ->take($perPage)
            ->skip($start)
            ->get();

        $data = [];

        foreach ($query as $key => $value) {
            $data[] = [
                "id" => $value->id,
                "country_id" => $value->country_id,
                "name" => $value->name,
                "action" => "<a href='/state/" . $value->id . "'><button class='btn btn-warning text-light'><i class='fa-solid fa-eye'></i></button></a>
                             <button type='button' class='btn btn-primary update_state' data-toggle='modal' data-target='#modal' data-id='$value->id' data-country_id='$value->country_id' data-name='$value->name'><i class='fa-solid fa-pen-to-square text-white'></i></button>
                             <a id='delete' href='/deletestate/" . $value->id . "' data-id=" . $value->id . "'><button class='btn btn-danger' data-confirm-delete='true'><i class='fa-solid fa-trash text-white'></i></button></a>"

            ];
        }

        $response = [
            "draw" => (int) $request->input('draw', ''),
            "recordsTotal" => State::count(),
            "recordsFiltered" => $filterdRecord,
            "data" => $data
        ];
        // dd($response);
        return response()->json($response);

    }

    public function selectcountry(Request $request)
    {
        $payment['results'] = Country::select(['id', 'name as text'])
            ->where(function ($q) use ($request) {
                if (!empty($request->q)) {
                    $q->where('name', 'like', '%' . $request->q . '%');
                }
            })->get();

        return response()->json($payment);
    }
}
