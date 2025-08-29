<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $data['getRecord'] = State::getAllRecord(['country']);
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

        return redirect('admin/state')->with('success', 'State store successfully!');
    }

    public function state_edit($id)
    {
        $data['getState'] = State::findOrFail($id);
        $data['getRecord'] = Country::get();
        return view('admin.state.edit', $data);
    }

    public function state_update(Request $request, $id)
    {
        $validated = $request->validate([
            'countries_id' => 'required',
            'state_name' => 'required|string|max:255',
        ]);

        $getState = State::findOrFail($id);
        $getState->countries_id = trim($validated['countries_id']);
        $getState->state_name = trim($validated['state_name']);
        $getState->save();

        return redirect('admin/state')->with('success', 'State updated successfully!');
    }

    public function state_delete($id)
    {
        $getState = State::findOrFail($id);
        $getState->delete();

        return redirect('admin/state')->with('success', 'State deleted successfully!');
    }

    public function city_list(Request $request)
    {
        $search = $request->get('search');
        $data['getCity'] = City::getAllRecord(['state', 'country'], $search);
        return view('admin.city.list', $data);
    }

    public function city_add()
    {
        $stateCountryID = State::pluck('countries_id');
        $data['getCountries'] = Country::whereIn('id', $stateCountryID)->get();
        return view('admin.city.add', $data);
    }

    public function get_state_name($countryId, Request $request)
    {
        
        $states = State::where('countries_id', $countryId)->get();
        return response()->json($states);
    }

    public function city_store(Request $request)
    {
        $validated = $request->validate([
            'countries_id' => 'required',
            'state_id' => 'required',
            'city_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('cities', 'city_name')->whereNull('deleted_at')
            ],
        ]);

        $city = new City();
        $city->countries_id = trim($validated['countries_id']);
        $city->state_id     = trim($validated['state_id']);
        $city->city_name    = trim($validated['city_name']);
        $city->save();

        return redirect('admin/city')->with('success', 'City created successfully!');
    }

    public function city_edit($id)
    {
        $data['getCity'] = City::with(['state.country'])->findOrFail($id);
        $stateCountryID = State::pluck('countries_id');
        $data['getCountries'] = Country::whereIn('id', $stateCountryID)->get();
        $data['getStates'] = State::where('countries_id', $data['getCity']->state->countries_id)->get();
        return view('admin.city.edit', $data);
    }

    public function city_update(Request $request, $id)
    {
        $validated = $request->validate([
            'countries_id' => 'required',
            'state_id' => 'required',
            'city_name' => 'required|string|max:255',
        ]);

        $city = City::findOrFail($id);
        $city->countries_id = trim($validated['countries_id']);
        $city->state_id     = trim($validated['state_id']);
        $city->city_name    = trim($validated['city_name']);
        $city->save();

        return redirect('admin/city')->with('success', 'City updated successfully!');
    }

    public function city_delete($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return redirect('admin/city')->with('success', 'City deleted successfully!');
    }

}
