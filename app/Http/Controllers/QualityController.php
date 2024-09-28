<?php

namespace App\Http\Controllers;

use App\Models\Quality;
use Illuminate\Http\Request;

class QualityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $qualities = Quality::get();
        return view('dachboard.Pages.Qualities.index', compact('qualities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dachboard.Pages.Qualities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Quality::create($request->all());
        return redirect()->route('qualities.index')->with('success', 'Quality created successfully.');
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
        $quality = Quality::findOrFail($id);
        return view('dachboard.Pages.Qualities.edit', compact('quality'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $quality = Quality::findOrFail($id);
        $quality->update($request->all());
        return redirect()->route('qualities.index')->with('success', 'Quality updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Quality::destroy($id);
        return redirect()->route('qualities.index')->with('success', 'Quality deleted successfully.');

    }
}
