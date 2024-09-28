<?php

namespace App\Http\Controllers;

use App\Models\Human;
use Illuminate\Http\Request;

class HumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $humans = Human::get();
        return view('dachboard.Pages.Humans.index', compact('humans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dachboard.Pages.Humans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Human::create($request->all());
        return redirect()->route('humans.index')->with('success', 'Human created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $human = Human::findOrFail($id);
        return view('dachboard.Pages.Humans.edit', compact('human'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $human = Human::findOrFail($id);
        $human->update($request->all());
        return redirect()->route('humans.index')->with('success', 'Human updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Human::destroy($id);
        return redirect()->route('humans.index')->with('success', 'Human deleted successfully.');

    }
}
