<?php

namespace App\Http\Controllers;

use App\Models\Cinemas;
use App\Models\Session_Times;
use Illuminate\Http\Request;

class CinemasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Cinemas::latest()->paginate(5);

        return view('cinemas.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cinemas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'geo_lat_long' => 'required',
            'seating_capacity' => 'required',
        ]);

        Cinemas::create($request->all());

        return redirect()->route('cinemas.index')->with('success','Cinema created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cinemas  $cinema
     * @return \Illuminate\Http\Response
     */
    public function show(Cinemas $cinema)
    {
        $movies = Session_Times::getMovies($cinema->id);
        return view('cinemas.show',compact('movies', 'cinema'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cinemas  $cinema
     * @return \Illuminate\Http\Response
     */
    public function edit(Cinemas $cinema)
    {
        return view('cinemas.edit',compact('cinema'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cinemas  $cinema
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cinemas $cinema)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'geo_lat_long' => 'required',
            'seating_capacity' => 'required',
        ]);

        $cinema->update($request->all());

        return redirect()->route('cinemas.index')
                        ->with('success','Cinema updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cinemas  $cinema
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cinemas $cinema)
    {
        $cinema->delete();

        return redirect()->route('cinemas.index')
                        ->with('success','Cinema deleted successfully!');
    }
}
