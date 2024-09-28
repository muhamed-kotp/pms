<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::with('image', 'translations')->get(); // Load translations for all locales

        $partners = $partners->map(function ($partner) {
            // Get English and Arabic translations
            $nameEn = optional($partner->translate('en'))->name;
            $nameAr = optional($partner->translate('ar'))->name;
            $descriptionEn = optional($partner->translate('en'))->description;
            $descriptionAr = optional($partner->translate('ar'))->description;

            return [
                'id' => $partner->id,
                'name_en' => $nameEn,
                'name_ar' => $nameAr,
                'description_en' => $descriptionEn,
                'description_ar' => $descriptionAr,
                'photo' => $partner->image !== null ? $partner->image->photo : null,
            ];
        });
        return view('dachboard.Pages.Partners.index', compact('partners'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dachboard.Pages.Partners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $photo =$this->UploadImage($request, 'Partner');
        $partner = new Partner;
        $partner->translateOrNew('en')->name = $request->name_en;
        $partner->translateOrNew('ar')->name = $request->name_ar;
        $partner->translateOrNew('en')->description = $request->description_en;
        $partner->translateOrNew('ar')->description = $request->description_ar;
        $partner->save();
        $partner->image()->create(['photo' => $photo == null ? null :config('app.photo_url') . $photo]) ;
        $partner['photo'] = config('app.photo_url') . $photo;

        return redirect()->route('partners.index')->with('success', 'Partner Created successfully');
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
        $partner = Partner::with('image', 'translations')->findOrFail($id);

        // Get English and Arabic translations
        $nameEn = optional($partner->translate('en'))->name;
        $nameAr = optional($partner->translate('ar'))->name;
        $descriptionEn = optional($partner->translate('en'))->description;
        $descriptionAr = optional($partner->translate('ar'))->description;

        // Prepare data for the view
        $partner = [
            'id' => $partner->id,
            'name_en' => $nameEn,
            'name_ar' => $nameAr,
            'description_en' => $descriptionEn,
            'description_ar' => $descriptionAr,
            'photo' => $partner->image !== null ? $partner->image->photo : null,
        ];

        return view('dachboard.Pages.Partners.edit', compact('partner'));
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Partner not found');
    }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
        $partner = Partner::findOrFail($id);
        $newImageName = $this->handleModelImage($request, 'Partner', $partner);

        $partner->translateOrNew('en')->name = $request->name_en !==null ?$request->name_en:$partner->translateOrNew('en')->name;
        $partner->translateOrNew('ar')->name = $request->name_ar !==null ?$request->name_ar:$partner->translateOrNew('ar')->name;
        $partner->translateOrNew('en')->description = $request->description_en !==null ?$request->description_en:$partner->translateOrNew('en')->description;
        $partner->translateOrNew('ar')->description = $request->description_ar !==null ?$request->description_ar:$partner->translateOrNew('ar')->description;
        $partner->save();

        if ($newImageName) {
            $this->updateOrCreateImage($partner, $newImageName);
        }
        return redirect()->route('partners.index')->with('success', 'Partner Updated successfully');
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Partner not found');
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
        $partner = Partner::findOrFail($id);

        if (File::exists(str_replace(config('app.photo_url'), "", $partner->image->photo))) {
            File::delete(str_replace(config('app.photo_url'), "", $partner->image->photo));
        }
        $partner->image()->delete();
        $partner->delete();

        return redirect()->route('partners.index')->with('success', 'Partner deleted successfully');
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Partner not found');
    }
    }
}
