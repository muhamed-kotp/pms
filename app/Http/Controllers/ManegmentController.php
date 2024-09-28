<?php

namespace App\Http\Controllers;

use App\Models\Manegment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ManegmentController extends Controller
{

   public function index()
    {
        $manegments = Manegment::with('image', 'translations')->get(); // Load translations for all locales

        $manegments = $manegments->map(function ($manegment) {
            // Get English and Arabic translations
            $nameEn = optional($manegment->translate('en'))->name;
            $nameAr = optional($manegment->translate('ar'))->name;
            $descriptionEn = optional($manegment->translate('en'))->description;
            $descriptionAr = optional($manegment->translate('ar'))->description;
            $titleEn = optional($manegment->translate('en'))->title;
            $titleAr = optional($manegment->translate('ar'))->title;


            return [
                'id' => $manegment->id,
                'name_en' => $nameEn,
                'name_ar' => $nameAr,
                'description_en' => $descriptionEn,
                'description_ar' => $descriptionAr,
                'title_en' => $titleEn,
                'title_ar' => $titleAr,
                'photo' => $manegment->image !== null ? $manegment->image->photo : null,
            ];
        });
        return view('dachboard.Pages.Manegments.index', compact('manegments'));
    }



    public function create()
    {
        return view('dachboard.Pages.Manegments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $photo =$this->UploadImage($request, 'Manegment');
        $manegment = new Manegment;
        $manegment->translateOrNew('en')->name = $request->name_en;
        $manegment->translateOrNew('ar')->name = $request->name_ar;
        $manegment->translateOrNew('en')->description = $request->description_en;
        $manegment->translateOrNew('ar')->description = $request->description_ar;
        $manegment->translateOrNew('en')->title = $request->title_en;
        $manegment->translateOrNew('ar')->title = $request->title_ar;
        $manegment->save();
        $manegment->image()->create(['photo' => $photo == null ? null :config('app.photo_url') . $photo]) ;
        $manegment['photo'] = config('app.photo_url') . $photo;

        return redirect()->route('manegments.index')->with('success', 'Manegment Created successfully');
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
        $manegment = Manegment::with('image', 'translations')->findOrFail($id);

        // Get English and Arabic translations
        $nameEn = optional($manegment->translate('en'))->name;
        $nameAr = optional($manegment->translate('ar'))->name;
        $descriptionEn = optional($manegment->translate('en'))->description;
        $descriptionAr = optional($manegment->translate('ar'))->description;
        $titleEn = optional($manegment->translate('en'))->title;
        $titleAr = optional($manegment->translate('ar'))->title;

        // Prepare data for the view
        $manegment = [
            'id' => $manegment->id,
            'name_en' => $nameEn,
            'name_ar' => $nameAr,
            'description_en' => $descriptionEn,
            'description_ar' => $descriptionAr,
            'title_en' => $titleEn,
            'title_ar' => $titleAr,
            'photo' => $manegment->image !== null ? $manegment->image->photo : null,
        ];

        return view('dachboard.Pages.Manegments.edit', compact('manegment'));
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Manegment not found');
    }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
        $manegment = Manegment::findOrFail($id);
        $newImageName = $this->handleModelImage($request, 'Manegment', $manegment);

        $manegment->translateOrNew('en')->name = $request->name_en !==null ?$request->name_en:$manegment->translateOrNew('en')->name;
        $manegment->translateOrNew('ar')->name = $request->name_ar !==null ?$request->name_ar:$manegment->translateOrNew('ar')->name;
        $manegment->translateOrNew('en')->description = $request->description_en !==null ?$request->description_en:$manegment->translateOrNew('en')->description;
        $manegment->translateOrNew('ar')->description = $request->description_ar !==null ?$request->description_ar:$manegment->translateOrNew('ar')->description;
        $manegment->translateOrNew('en')->title = $request->title_en !==null ?$request->title_en:$manegment->translateOrNew('en')->title;
        $manegment->translateOrNew('ar')->title = $request->title_ar !==null ?$request->title_ar:$manegment->translateOrNew('ar')->title;
        $manegment->save();

        if ($newImageName) {
            $this->updateOrCreateImage($manegment, $newImageName);
        }
        return redirect()->route('manegments.index')->with('success', 'Manegment Updated successfully');
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Manegment not found');
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
        $manegment = Manegment::findOrFail($id);

        if (File::exists(str_replace(config('app.photo_url'), "", $manegment->image->photo))) {
            File::delete(str_replace(config('app.photo_url'), "", $manegment->image->photo));
        }
        $manegment->image()->delete();
        $manegment->delete();

        return redirect()->route('manegments.index')->with('success', 'Manegment deleted successfully');
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Manegment not found');
    }
    }
}
