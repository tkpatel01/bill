<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

class CountryController extends Controller
{
    public function ShowCountry()
    {
        return view('master/country');
    }

    public function addCountry(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        if ($data) {
            $country = new Country;

            $country->name = $request->name;

            if ($country->save()) {
                // session()->flash('add-update', 'Country has been added');
                return response()->json(['message' => 'Country has been added']);
            } else {
                return response()->json(['message' => 'Failed to add Country']);
            }
        }
    }

    public function updateCountry(Request $request)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        $country = DB::table('countrys')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name
            ]);

        if ($country) {
            return response()->json(['message' => 'Country update successfully']);
        } else {
            return response()->json(['message' => 'Failed to update Country']);
        }
    }

    public function deleteCountry(string $id)
    {
        $customer = DB::table('countrys')
            ->where('id', $id)
            ->delete();

        if ($customer) {
            return redirect()->route('country');
        }
    }

    public function Countryreport(Request $request)
    {
        $perPage = $request->input('lenght', 10);
        $start = $request->input('start', 0);
        $search = $request->input('search.value', '');

        $value = function ($a) use ($search) {
            $a->where('name', 'like', '%' . $search . '%');
        };

        $filterdRecord = Country::query()
            ->where($value)
            ->count();

        $query = Country::query()
            ->where($value)
            ->take($perPage)
            ->skip($start)
            ->get();

        $data = [];

        foreach ($query as $key => $value) {
            $data[] = [
                "id" => $value->id,
                "name" => $value->name,
                "action" => "<a href='/country/" . $value->id . "'><button class='btn btn-warning text-light'><i class='fa-solid fa-eye'></i></button></a>
                             <button type='button' class='btn btn-primary update_country' data-toggle='modal' data-target='#modal' data-id='$value->id' data-name='$value->name'><i class='fa-solid fa-pen-to-square text-white'></i></button>
                             <a id='delete' href='/deletecountry/" . $value->id . "' data-id=" . $value->id . "'><button class='btn btn-danger' data-confirm-delete='true'><i class='fa-solid fa-trash text-white'></i></button></a>"

            ];
        }

        $response = [
            "draw" => (int) $request->input('draw', ''),
            "recordsTotal" => Country::count(),
            "recordsFiltered" => $filterdRecord,
            "data" => $data
        ];
        // dd($response);
        return response()->json($response);

    }
}
