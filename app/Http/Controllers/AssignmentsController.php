<?php

namespace App\Http\Controllers;

use App\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $assignments = \App\Assignment::all(); // je wilt nooit alle records van de database -> maar records van de huidige user
        $assignments = \App\Assignment::where('owner_id', auth()->id())->get();
        return view('assignments.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assignments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $assignment = new Assignment();
        $assignment->naam = request('naamInput');
        $assignment->beschrijving = request('beschrijvingTextArea');
        $assignment->owner_id = Auth::id();
        $assignment->save();

//        $attributes['owner_id'] = auth()->id();

//        Assignment::create($attributes + ['owner_id' => auth()->id()]);

        return redirect('/assignments');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
        $this->authorize('view', $assignment); // authorisatie
        return view('assignments.show', compact('assignment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit($assignment){
//        $assignment = \App\Assignment::find($assignment);
        $this->authorize('view', $assignment); // authorisatie
        return view('assignments.edit', compact('assignment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update($id){
        $assignments = Assignment::find($id);
        $assignments->naam = request('naamInput');
        $assignments->beschrijving = request('beschrijvingTextArea');
        $assignments->save();
        return redirect('/assignments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $id)
    {
        Assignment::findOrFail($id)->delete();
        return redirect('/assignments');
    }
}
