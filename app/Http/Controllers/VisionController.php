<?php

namespace App\Http\Controllers;

use App\Models\Vision;
use Illuminate\Http\Request;

class VisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visions = Vision::get();
        return view('dachboard.Pages.Visions.index', compact('visions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dachboard.Pages.Visions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Vision::create($request->all());
        return redirect()->route('visions.index')->with('success', 'Vision created successfully.');
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
        $vision = Vision::findOrFail($id);
        return view('dachboard.Pages.Visions.edit', compact('vision'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vision = Vision::findOrFail($id);
        $vision->update($request->all());
        return redirect()->route('visions.index')->with('success', 'Vision updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Vision::destroy($id);
        return redirect()->route('visions.index')->with('success', 'Vision deleted successfully.');

    }
}
