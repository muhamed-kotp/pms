<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experts = Expert::get();
        return view('dachboard.Pages.Experts.index', compact('experts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dachboard.Pages.Experts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Expert::create($request->all());
        return redirect()->route('experts.index')->with('success', 'Expert created successfully.');
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
        $expert = Expert::findOrFail($id);
        return view('dachboard.Pages.Experts.edit', compact('expert'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $expert = Expert::findOrFail($id);
        $expert->update($request->all());
        return redirect()->route('experts.index')->with('success', 'Expert updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Expert::destroy($id);
        return redirect()->route('experts.index')->with('success', 'Expert deleted successfully.');

    }
}
