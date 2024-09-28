<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisions = Division::with('image', 'translations')->get(); // Load translations for all locales

        $divisions = $divisions->map(function ($division) {
            // Get English and Arabic translations
            $nameEn = optional($division->translate('en'))->name;
            $nameAr = optional($division->translate('ar'))->name;
            $descriptionEn = optional($division->translate('en'))->description;
            $descriptionAr = optional($division->translate('ar'))->description;
            $overviewEn = optional($division->translate('en'))->overview;
            $overviewAr = optional($division->translate('ar'))->overview;
            $approachEn = optional($division->translate('en'))->approach;
            $approachAr = optional($division->translate('ar'))->approach;

            return [
                'id' => $division->id,
                'name_en' => $nameEn,
                'name_ar' => $nameAr,
                'description_en' => $descriptionEn,
                'description_ar' => $descriptionAr,
                'overview_en' => $overviewEn,
                'overview_ar' => $overviewAr,
                'approach_en' => $approachEn,
                'approach_ar' => $approachAr,
                'photo' => $division->image !== null ? $division->image->photo : null,
            ];
        });
        return view('dachboard.Pages.Divisions.index', compact('divisions'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dachboard.Pages.Divisions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $photo =$this->UploadImage($request, 'Division');
        $division = new Division;
        $division->translateOrNew('en')->name = $request->name_en;
        $division->translateOrNew('ar')->name = $request->name_ar;
        $division->translateOrNew('en')->description = $request->description_en;
        $division->translateOrNew('ar')->description = $request->description_ar;
        $division->translateOrNew('en')->overview = $request->overview_en;
        $division->translateOrNew('ar')->overview = $request->overview_ar;
        $division->translateOrNew('en')->approach = $request->approach_en;
        $division->translateOrNew('ar')->approach = $request->approach_ar;
        $division->save();
        $division->image()->create(['photo' => $photo == null ? null :config('app.photo_url') . $photo]) ;
        $division['photo'] = config('app.photo_url') . $photo;

        return redirect()->route('divisions.index')->with('success', 'Division Created successfully');
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
        $division = Division::with('image', 'translations')->findOrFail($id);

        // Get English and Arabic translations
        $nameEn = optional($division->translate('en'))->name;
        $nameAr = optional($division->translate('ar'))->name;
        $descriptionEn = optional($division->translate('en'))->description;
        $descriptionAr = optional($division->translate('ar'))->description;
        $overviewEn = optional($division->translate('en'))->overview;
        $overviewAr = optional($division->translate('ar'))->overview;
        $approachEn = optional($division->translate('en'))->approach;
        $approachAr = optional($division->translate('ar'))->approach;

        // Prepare data for the view
        $division = [
            'id' => $division->id,
            'name_en' => $nameEn,
            'name_ar' => $nameAr,
            'description_en' => $descriptionEn,
            'description_ar' => $descriptionAr,
            'overview_en' => $overviewEn,
            'overview_ar' => $overviewAr,
            'approach_en' => $approachEn,
            'approach_ar' => $approachAr,
            'photo' => $division->image !== null ? $division->image->photo : null,
        ];

        return view('dachboard.Pages.Divisions.edit', compact('division'));
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Division not found');
    }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
        $division = Division::findOrFail($id);
        $newImageName = $this->handleModelImage($request, 'Division', $division);

        $division->translateOrNew('en')->name = $request->name_en !==null ?$request->name_en:$division->translateOrNew('en')->name;
        $division->translateOrNew('ar')->name = $request->name_ar !==null ?$request->name_ar:$division->translateOrNew('ar')->name;
        $division->translateOrNew('en')->description = $request->description_en !==null ?$request->description_en:$division->translateOrNew('en')->description;
        $division->translateOrNew('ar')->description = $request->description_ar !==null ?$request->description_ar:$division->translateOrNew('ar')->description;
        $division->translateOrNew('en')->overview = $request->overview_en !==null ?$request->overview_en:$division->translateOrNew('en')->overview;
        $division->translateOrNew('ar')->overview = $request->overview_ar !==null ?$request->overview_ar:$division->translateOrNew('ar')->overview;
        $division->translateOrNew('en')->approach = $request->approach_en !==null ?$request->approach_en:$division->translateOrNew('en')->approach;
        $division->translateOrNew('ar')->approach = $request->approach_ar !==null ?$request->approach_ar:$division->translateOrNew('ar')->approach;
        $division->save();

        if ($newImageName) {
            $this->updateOrCreateImage($division, $newImageName);
        }
        return redirect()->route('divisions.index')->with('success', 'Division Updated successfully');
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Division not found');
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
        $division = Division::findOrFail($id);

        if (File::exists(str_replace(config('app.photo_url'), "", $division->image->photo))) {
            File::delete(str_replace(config('app.photo_url'), "", $division->image->photo));
        }
        $division->image()->delete();
        $division->delete();

        return redirect()->route('divisions.index')->with('success', 'Division deleted successfully');
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Division not found');
    }
    }
}
