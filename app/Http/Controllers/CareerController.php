<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CareerController extends Controller
{
    public function index()
    {
        $careers = Career::with( 'translations')->get(); // Load translations for all locales

        $careers = $careers->map(function ($career) {
            // Get English and Arabic translations
            $nameEn = optional($career->translate('en'))->name;
            $nameAr = optional($career->translate('ar'))->name;
            $descriptionEn = optional($career->translate('en'))->description;
            $descriptionAr = optional($career->translate('ar'))->description;

            return [
                'id' => $career->id,
                'name_en' => $nameEn,
                'name_ar' => $nameAr,
                'description_en' => $descriptionEn,
                'description_ar' => $descriptionAr,
            ];
        });
        return view('dachboard.Pages.Careers.index', compact('careers'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dachboard.Pages.Careers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $career = new Career;
        $career->translateOrNew('en')->name = $request->name_en;
        $career->translateOrNew('ar')->name = $request->name_ar;
        $career->translateOrNew('en')->description = $request->description_en;
        $career->translateOrNew('ar')->description = $request->description_ar;
        $career->save();

        return redirect()->route('careers.index')->with('success', 'Career Created successfully');
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
        try{
        $career = Career::with( 'translations')->findOrFail($id);

        // Get English and Arabic translations
        $nameEn = optional($career->translate('en'))->name;
        $nameAr = optional($career->translate('ar'))->name;
        $descriptionEn = optional($career->translate('en'))->description;
        $descriptionAr = optional($career->translate('ar'))->description;

        // Prepare data for the view
        $career = [
            'id' => $career->id,
            'name_en' => $nameEn,
            'name_ar' => $nameAr,
            'description_en' => $descriptionEn,
            'description_ar' => $descriptionAr,
        ];

        return view('dachboard.Pages.Careers.edit', compact('career'));
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Career not found');
    }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
        $career = Career::findOrFail($id);

        $career->translateOrNew('en')->name = $request->name_en !==null ?$request->name_en:$career->translateOrNew('en')->name;
        $career->translateOrNew('ar')->name = $request->name_ar !==null ?$request->name_ar:$career->translateOrNew('ar')->name;
        $career->translateOrNew('en')->description = $request->description_en !==null ?$request->description_en:$career->translateOrNew('en')->description;
        $career->translateOrNew('ar')->description = $request->description_ar !==null ?$request->description_ar:$career->translateOrNew('ar')->description;
        $career->save();


        return redirect()->route('careers.index')->with('success', 'Career Updated successfully');
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Career not found');
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
        $career = Career::findOrFail($id);
        $career->delete();

        return redirect()->route('careers.index')->with('success', 'Career deleted successfully');
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Career not found');
    }
    }
}
