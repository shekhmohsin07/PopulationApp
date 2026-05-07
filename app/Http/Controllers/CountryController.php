<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Number;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home(Request $request)
    {
        $sort = $request->get('sort');

        if ($sort === 'population') {
            $countries = Country::orderByDesc('population')
                                ->orderBy('country', 'asc')
                                ->paginate(5);
        } elseif ($sort === 'alphabet') {
            $countries = Country::orderBy('country', 'asc')->paginate(5);
        } else {
            $countries = Country::orderBy('id')->paginate(5);
        }

        return view('frontend.countries.index', compact('countries'));
    }



    public function index(Request $request)
    {
        $sort = $request->get('sort');

        if ($sort === 'population') {
            $countries = Country::orderByDesc('population')
                                ->orderBy('country', 'asc')
                                ->paginate(5);
        } elseif ($sort === 'alphabet') {
            $countries = Country::orderBy('country', 'asc')->paginate(5);
        } else {
            $countries = Country::orderBy('id')->paginate(5);
        }

        return view('backend.countries.index', compact('countries'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'country' => 'required|string|max:255',
            'population' => 'required|integer|min:0'
        ]);

        Country::create($request->only(['country', 'population']));
        return redirect()->route('countries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        return view('backend.countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        $request->validate([
            'country' => 'required|string|max:255',
            'population' => 'required|integer|min:0'
        ]);

        $country->update($request->only(['country', 'population']));
        return redirect()->route('countries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $name = $country->country;
        $country->delete();

        return redirect()->route('countries.index')->with('success', "$name has been deleted successfully.");
    }

    public function editThirdCountry()
    {
        $country = Country::orderByDesc('population')
                        ->orderBy('country', 'asc')
                        ->skip(2)
                        ->first();

        if (!$country) {
            return redirect()->route('countries.index')->with('error', '3rd country not found.');
        }

        return view('backend.countries.third', compact('country'));
    }


    public function updateThirdCountry(Request $request)
    {
        $request->validate([
            'population' => 'required|numeric|min:1',
        ]);

        $country = Country::orderByDesc('population')
                        ->orderBy('country', 'asc')
                        ->skip(2)
                        ->first();

        if ($country) {
            $old = $country->population;
            $country->population = ceil($request->population / 1000000) * 1000000;
            $country->save();

            return redirect()->route('countries.index')
                ->with('success', 'Updated ' . $country->country . ' from ' .
                    $old . ' to ' .
                    \Illuminate\Support\Number::forHumans($country->population));
        }

        return redirect()->route('countries.index')->with('error', '3rd country not found.');
    }



}
