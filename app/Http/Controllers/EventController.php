<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('image', 'translations')->get(); // Load translations for all locales

        $events = $events->map(function ($event) {
            // Get English and Arabic translations
            $nameEn = optional($event->translate('en'))->name;
            $nameAr = optional($event->translate('ar'))->name;
            $descriptionEn = optional($event->translate('en'))->description;
            $descriptionAr = optional($event->translate('ar'))->description;
            $date = $event->date;
            $division = Division::with('translations')->where('id', $event->division_id)->first();
            $division_name = optional($division->translate('en'))->name;

            return [
                'id' => $event->id,
                'name_en' => $nameEn,
                'name_ar' => $nameAr,
                'description_en' => $descriptionEn,
                'description_ar' => $descriptionAr,
                'date' => $date,
                'division_name' => $division_name,
                'photo' => $event->image !== null ? $event->image->photo : null,
            ];
        });
        return view('dachboard.Pages.Events.index', compact('events'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisions = Division::with( 'translations')->get(); // Load translations for all locales

        $divisions = $divisions->map(function ($division) {
            // Get English and Arabic translations
            $nameEn = optional($division->translate('en'))->name;
            return [
                'id' => $division->id,
                'name' => $nameEn,
            ];
        });
        return view('dachboard.Pages.Events.create', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $photo =$this->UploadImage($request, 'Event');
        $event = new Event;
        $event->translateOrNew('en')->name = $request->name_en;
        $event->translateOrNew('ar')->name = $request->name_ar;
        $event->translateOrNew('en')->description = $request->description_en;
        $event->translateOrNew('ar')->description = $request->description_ar;
        $event->date = $request->date;
        $event->division_id = $request->division_id;
        $event->save();
        $event->image()->create(['photo' => $photo == null ? null :config('app.photo_url') . $photo]) ;
        $event['photo'] = config('app.photo_url') . $photo;

        return redirect()->route('events.index')->with('success', 'Event Created successfully');
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
        $event = Event::with('image', 'translations')->findOrFail($id);

        // Get English and Arabic translations
        $nameEn = optional($event->translate('en'))->name;
        $nameAr = optional($event->translate('ar'))->name;
        $descriptionEn = optional($event->translate('en'))->description;
        $descriptionAr = optional($event->translate('ar'))->description;
        $date = $event->date;
        $division_id = $event->division_id;
        $divisions = Division::with( 'translations')->get(); // Load translations for all locales
        $divisions = $divisions->map(function ($division) {
            // Get English and Arabic translations
            $nameEn = optional($division->translate('en'))->name;
            return [
                'id' => $division->id,
                'name' => $nameEn,
            ];
        });
        // Prepare data for the view
        $event = [
            'id' => $event->id,
            'name_en' => $nameEn,
            'name_ar' => $nameAr,
            'description_en' => $descriptionEn,
            'description_ar' => $descriptionAr,
            'date' => $date,
            'division_id' => $division_id,
            'photo' => $event->image !== null ? $event->image->photo : null,
        ];

        return view('dachboard.Pages.Events.edit', compact('event','divisions'));
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Event not found');
    }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        try{
        $event = Event::findOrFail($id);
        $newImageName = $this->handleModelImage($request, 'Event', $event);

        $event->translateOrNew('en')->name = $request->name_en !==null ?$request->name_en:$event->translateOrNew('en')->name;
        $event->translateOrNew('ar')->name = $request->name_ar !==null ?$request->name_ar:$event->translateOrNew('ar')->name;
        $event->translateOrNew('en')->description = $request->description_en !==null ?$request->description_en:$event->translateOrNew('en')->description;
        $event->translateOrNew('ar')->description = $request->description_ar !==null ?$request->description_ar:$event->translateOrNew('ar')->description;
        $event->date = $request->date;
        $event->division_id = $request->division_id;
        $event->save();

        if ($newImageName) {
            $this->updateOrCreateImage($event, $newImageName);
        }
        return redirect()->route('events.index')->with('success', 'Event Updated successfully');
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Event not found');
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
        $event = Event::findOrFail($id);

        if (File::exists(str_replace(config('app.photo_url'), "", $event->image->photo))) {
            File::delete(str_replace(config('app.photo_url'), "", $event->image->photo));
        }
        $event->image()->delete();
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully');
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Event not found');
    }
    }
}
