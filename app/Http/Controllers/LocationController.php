<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function country_list()
    {
        $data['getRecord'] = Country::getAllRecord();
        return view('admin.country.list', $data);
    }

    public function country_add()
    {
        return view('admin.country.add');
    }

    public function country_store(Request $request)
    {
        $validate = $request->validate([
            'country_name' => 'required|string|max:255|unique:countries,country_name',
        ]);

        $save = new Country();
        $save->country_name = trim($validate['country_name']);
        $save->save();

        return redirect('admin/countries')->with('success', 'Country created successfully!');
    }

    public function country_edit($id)
    {
        $data['getRecord'] = Country::findOrFail($id);
        return view('admin.country.edit', $data);
    }

    public function country_update(Request $request, $id)
    {
        $validate = $request->validate([
            'country_name' => 'required|string|max:255',
        ]);

        $save = Country::findOrFail($id);
        $save->country_name = trim($validate['country_name']);
        $save->save();

        return redirect('admin/countries')->with('success', 'Country updated successfully!');
    }

    public function country_delete($id)
    {
        $data = Country::findOrFail($id);
        $data->delete();

        return redirect('admin/countries')->with('success', 'Country deleted successfully!');
    }

    public function state_list()
    {
        $data['getRecord'] = State::with('country')->get();
        return view('admin.state.list', $data);
    }

    public function state_add()
    {
        $data['getCountry'] = Country::get();
        return view('admin.state.add', $data);
    }

    public function state_store(Request $request)
    {
        $validated = $request->validate([
            'countries_id' => 'required',
            'state_name' => 'required|string|max:255|unique:states,state_name',
        ]);

        $country = Country::findOrFail($validated['countries_id']);
        $state = new State();
        $state->countries_id =  $country->id;
        $state->state_name =  trim($validated['state_name']);
        $state->save();

        return redirect('admin/state')->with('success', 'State updated successfully!');
    }
}
