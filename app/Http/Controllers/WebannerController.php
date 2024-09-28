<?php

namespace App\Http\Controllers;

use App\Models\Webanner;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WebannerController extends Controller
{
    public function index()
    {
        $banners = Webanner::with('image', 'translations')->get(); // Load translations for all locales

        $banners = $banners->map(function ($banner) {
            // Get English and Arabic translations
            $nameEn = optional($banner->translate('en'))->name;
            $nameAr = optional($banner->translate('ar'))->name;
            $descriptionEn = optional($banner->translate('en'))->description;
            $descriptionAr = optional($banner->translate('ar'))->description;

            return [
                'id' => $banner->id,
                'name_en' => $nameEn,
                'name_ar' => $nameAr,
                'description_en' => $descriptionEn,
                'description_ar' => $descriptionAr,
                'photo' => $banner->image !== null ? $banner->image->photo : null,
            ];
        });
        return view('dachboard.Pages.Webanners.index', compact('banners'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('dachboard.Pages.Banners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $banner = Webanner::with('image', 'translations')->findOrFail($id);

        // Get English and Arabic translations
        $nameEn = optional($banner->translate('en'))->name;
        $nameAr = optional($banner->translate('ar'))->name;
        $descriptionEn = optional($banner->translate('en'))->description;
        $descriptionAr = optional($banner->translate('ar'))->description;

        // Prepare data for the view
        $banner = [
            'id' => $banner->id,
            'name_en' => $nameEn,
            'name_ar' => $nameAr,
            'description_en' => $descriptionEn,
            'description_ar' => $descriptionAr,
            'photo' => $banner->image !== null ? $banner->image->photo : null,
        ];

        return view('dachboard.Pages.Webanners.edit', compact('banner'));
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Banner not found');
    }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
        $banner = Webanner::findOrFail($id);
        $newImageName = $this->handleModelImage($request, 'Banner', $banner);

        $banner->translateOrNew('en')->name = $request->name_en !==null ?$request->name_en:$banner->translateOrNew('en')->name;
        $banner->translateOrNew('ar')->name = $request->name_ar !==null ?$request->name_ar:$banner->translateOrNew('ar')->name;
        $banner->translateOrNew('en')->description = $request->description_en !==null ?$request->description_en:$banner->translateOrNew('en')->description;
        $banner->translateOrNew('ar')->description = $request->description_ar !==null ?$request->description_ar:$banner->translateOrNew('ar')->description;
        $banner->save();

        if ($newImageName) {
            $this->updateOrCreateImage($banner, $newImageName);
        }
        return redirect()->route('webanners.index')->with('success', 'Banner Updated successfully');
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Banner not found');
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
