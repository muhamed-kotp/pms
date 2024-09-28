<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::with('image', 'translations')->get(); // Load translations for all locales

        $abouts = $abouts->map(function ($about) {
            // Get English and Arabic translations
            $nameEn = optional($about->translate('en'))->name;
            $nameAr = optional($about->translate('ar'))->name;
            $descriptionEn = optional($about->translate('en'))->description;
            $descriptionAr = optional($about->translate('ar'))->description;

            return [
                'id' => $about->id,
                'name_en' => $nameEn,
                'name_ar' => $nameAr,
                'description_en' => $descriptionEn,
                'description_ar' => $descriptionAr,
                'photo' => $about->image !== null ? $about->image->photo : null,
            ];
        });
        return view('dachboard.Pages.About.index', compact('abouts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('dachboard.Pages.About.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // // dd($request->all());
        // $photo =$this->UploadImage($request, 'About');
        // $about = new About;
        // $about->translateOrNew('en')->name = $request->name_en;
        // $about->translateOrNew('ar')->name = $request->name_ar;
        // $about->translateOrNew('en')->description = $request->description_en;
        // $about->translateOrNew('ar')->description = $request->description_ar;
        // $about->save();
        // $about->image()->create(['photo' => $photo == null ? null :config('app.photo_url') . $photo]) ;
        // $about['photo'] = config('app.photo_url') . $photo;

        // return redirect()->route('abouts.index')->with('success', 'About Created successfully');
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
        $about = About::with('image', 'translations')->findOrFail($id);

        // Get English and Arabic translations
        $nameEn = optional($about->translate('en'))->name;
        $nameAr = optional($about->translate('ar'))->name;
        $descriptionEn = optional($about->translate('en'))->description;
        $descriptionAr = optional($about->translate('ar'))->description;

        // Prepare data for the view
        $about = [
            'id' => $about->id,
            'name_en' => $nameEn,
            'name_ar' => $nameAr,
            'description_en' => $descriptionEn,
            'description_ar' => $descriptionAr,
            'photo' => $about->image !== null ? $about->image->photo : null,
        ];

        return view('dachboard.Pages.About.edit', compact('about'));
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'About not found');
    }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
        $about = About::findOrFail($id);
        $newImageName = $this->handleModelImage($request, 'About', $about);

        $about->translateOrNew('en')->name = $request->name_en !==null ?$request->name_en:$about->translateOrNew('en')->name;
        $about->translateOrNew('ar')->name = $request->name_ar !==null ?$request->name_ar:$about->translateOrNew('ar')->name;
        $about->translateOrNew('en')->description = $request->description_en !==null ?$request->description_en:$about->translateOrNew('en')->description;
        $about->translateOrNew('ar')->description = $request->description_ar !==null ?$request->description_ar:$about->translateOrNew('ar')->description;
        $about->save();

        if ($newImageName) {
            $this->updateOrCreateImage($about, $newImageName);
        }
        return redirect()->route('abouts.index')->with('success', 'About Updated successfully');
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'About not found');
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    //     try{
    //     $about = About::findOrFail($id);

    //     if (File::exists(str_replace(config('app.photo_url'), "", $about->image->photo))) {
    //         File::delete(str_replace(config('app.photo_url'), "", $about->image->photo));
    //     }
    //     $about->image()->delete();
    //     $about->delete();

    //     return redirect()->route('abouts.index')->with('success', 'About deleted successfully');
    // }catch(ModelNotFoundException $e){
    //     return redirect()->back()->with('error', 'About not found');
    // }
    }
}
