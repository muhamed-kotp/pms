<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::with( 'translations')->get(); // Load translations for all locales

        $contacts = $contacts->map(function ($contact) {
            // Get English and Arabic translations
            $addressEn = optional($contact->translate('en'))->address;
            $addressAr = optional($contact->translate('ar'))->address;
            $hoursEn = optional($contact->translate('en'))->hours;
            $hoursnAr = optional($contact->translate('ar'))->hours;
            $locationEn = optional($contact->translate('en'))->location;
            $locationAr = optional($contact->translate('ar'))->location;
            $email = $contact-> email;
            $phone = $contact-> phone;


            return [
                'id' => $contact->id,
                'address_en' => $addressEn,
                'address_ar' => $addressAr,
                'hours_en' => $hoursEn,
                'hours_ar' => $hoursnAr,
                'location_en' => $locationEn,
                'location_ar' => $locationAr,
                'email' => $email,
                'phone' => $phone,

            ];
        });
        return view('dachboard.Pages.Contact.index', compact('contacts'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('dachboard.Pages.Contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        // return redirect()->route('divisions.index')->with('success', 'Division Created successfully');
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
        $contact = Contact::with('translations')->findOrFail($id);

        // Get English and Arabic translations
            $addressEn = optional($contact->translate('en'))->address;
            $addressAr = optional($contact->translate('ar'))->address;
            $hoursEn = optional($contact->translate('en'))->hours;
            $hoursnAr = optional($contact->translate('ar'))->hours;
            $locationEn = optional($contact->translate('en'))->location;
            $locationAr = optional($contact->translate('ar'))->location;
            $email = $contact-> email;
            $phone = $contact-> phone;

        // Prepare data for the view
        $contact = [
                'id' => $contact->id,
                'address_en' => $addressEn,
                'address_ar' => $addressAr,
                'hours_en' => $hoursEn,
                'hours_ar' => $hoursnAr,
                'location_en' => $locationEn,
                'location_ar' => $locationAr,
                'email' => $email,
                'phone' => $phone,
        ];

        return view('dachboard.Pages.Contact.edit', compact('contact'));
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Contact not found');
    }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $contact = Contact::with('translations')->findOrFail($id);

            // Update the translations
            $contact->translateOrNew('en')->address = $request->address_en;
            $contact->translateOrNew('en')->hours = $request->hours_en;
            $contact->translateOrNew('en')->location = $request->location_en;

            $contact->translateOrNew('ar')->address = $request->address_ar;
            $contact->translateOrNew('ar')->hours = $request->hours_ar;
            $contact->translateOrNew('ar')->location = $request->location_ar;
            $contact->email = $request->email;
            $contact->phone = $request->phone;

            $contact->save();
        return redirect()->route('contacts.index')->with('success', 'Contact Updated successfully');
    }catch(ModelNotFoundException $e){
        return redirect()->back()->with('error', 'Contact not found');
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
