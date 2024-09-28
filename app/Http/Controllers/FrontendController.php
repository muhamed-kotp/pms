<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Event;
use App\Models\Human;
use App\Models\Skill;
use App\Models\Banner;
use App\Models\Career;
use App\Models\Expert;
use App\Models\Vision;
use App\Models\Contact;
use App\Models\Mission;
use App\Models\Partner;
use App\Models\Profile;
use App\Models\Quality;
use App\Models\Division;
use App\Models\Newsuser;
use App\Models\Webanner;
use App\Models\Manegment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FrontendController extends Controller
{
    public function events()
    {
        $locale = App::getLocale();
        $events = Event::with('image', 'translations')->get(); // Load translations for all locales

        $events = $events->map(function ($event) use ($locale) {
        $division = Division::with('translations')->where('id', $event->division_id)->first();
            return [
                'id' => $event->id,
                'name' => optional($event->translate($locale))->name,
                'description' => optional($event->translate($locale))->description,
                'date' => $event->date,
                'division_name' => optional($division->translate($locale))->name,
                'photo' => $event->image !== null ? $event->image->photo : null,
            ];
        });
        return view('front.pages.Events', compact('events'));
    }


    public function division(string $id)
    {
        try{
            $locale = App::getLocale();

            $division = Division::with('image', 'translations')->findOrFail($id);

            // Prepare data for the view
            $division = [
                'id' => $division->id,
                'name' => optional($division->translate($locale))->name,
                'description' => optional($division->translate($locale))->description,
                'overview' => optional($division->translate($locale))->overview,
                'approach' => optional($division->translate($locale))->approach,
                'photo' => $division->image !== null ? $division->image->photo : null,
            ];

            return view('front.pages.Division', compact('division'));
        }catch(ModelNotFoundException $e){
            return redirect()->back()->with('error', 'Division not found');
        }
    }
    public function showEvent(string $id)
    {
        try{
            $locale = App::getLocale();

            $event = Event::with('image', 'translations')->findOrFail($id);
            $division = Division::with('translations')->where('id', $event->division_id)->first();

            // Prepare data for the view
            $event = [
                'id' => $event->id,
                'name' => optional($event->translate($locale))->name,
                'description' => optional($event->translate($locale))->description,
                'date' => $event->date,
                'division_name' => optional($division->translate($locale))->name,
                'photo' => $event->image !== null ? $event->image->photo : null,
            ];

            return view('front.pages.event', compact('event'));
        }catch(ModelNotFoundException $e){
            return redirect()->back()->with('error', 'Event not found');
        }
    }

    public function partners()
    {
        $locale = App::getLocale();

        $partners = Partner::with('image', 'translations')->get(); // Load translations for all locales

        $partners = $partners->map(function ($partner) use ($locale) {

            return [
                'id' => $partner->id,
                'name' => optional($partner->translate($locale))->name,
                'description' => optional($partner->translate($locale))->description,
                'photo' => $partner->image !== null ? $partner->image->photo : null,
            ];
        });
        return view('front.pages.partner', compact('partners'));

    }
    public function careers()
    {
        $locale = App::getLocale();

        $careers = Career::with( relations: 'translations')->get(); // Load translations for all locales
        $careers = $careers->map(function ($career) use ($locale) {
            // Get English and Arabic translations
            return [
                'id' => $career->id,
                'name' =>optional($career->translate($locale))->name,
                'description' => optional($career->translate($locale))->description,
            ];

        });
        return view('front.pages.Careers', compact('careers'));
    }
    public function contact()
    {
        $locale = App::getLocale();

        $contact = Contact::with( relations: 'translations')->first();
            // Load translations for all locales

            $contact =  [
                'id' => $contact->id,
                'address' => optional($contact->translate($locale))->address,
                'hours' => optional($contact->translate($locale))->hours,
                'location' => optional($contact->translate($locale))->location,
                'email' =>  $contact-> email,
                'phone' => $contact-> phone,
            ];
        return view('front.pages.Contact', compact('contact'));

    }
    public function manegments()
    {
        $locale = App::getLocale();

        $manegments = Manegment::with('image', 'translations')->get(); // Load translations for all locales

        $manegments = $manegments->map(function ($manegment) use ($locale) {
            return [
                'id' => $manegment->id,
                'name' =>  optional($manegment->translate($locale))->name,
                'title' => optional($manegment->translate($locale))->title,
                'description' => optional($manegment->translate($locale))->description,
                'photo' => $manegment->image !== null ? $manegment->image->photo : null,
            ];
        });
        return view('front.pages.management', compact('manegments'));
    }
    public function profiles()
    {
        $locale = App::getLocale();
        $profiles = Profile::get();
        $about = About::with('image')->findOrFail(1);
        $about = [
            'id' => $about->id,
            'name' => optional($about->translate($locale))->name,
            'description' => optional($about->translate($locale))->description,
            'photo' => $about->image !== null ? $about->image->photo : null,
        ];
        // $photo = $about->image->photo ;
        return view('front.pages.profile', compact('profiles','about'));
    }
    public function values()
    {
        $missions = Mission::get();
        $visions = Vision::get();
        $skills = Skill::get();
        $experts = Expert::get();
        $humans = Human::get();
        $qualities = Quality::get();
        return view('front.pages.values',compact('missions','visions', 'skills','experts','humans','qualities'));
    }
    public function newsuser(Request $request)
    {
        $user = new Newsuser ;
        $user-> email = $request->email ;
        $user->save();
        return redirect()->back()->with('success', 'You Subscribed with us Successfully.');

    }
}
