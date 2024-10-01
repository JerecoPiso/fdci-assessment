<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $page = $request->input('page');
        // get only the contacts added by the current user
        $contacts = Contact::where('user_id', Auth::user()->id)
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('company', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%');
            })
            ->paginate(1);
        if ($request->ajax()) {
            return response()->json([
                'contacts' => $contacts,
                'links' => (string) $contacts->links()
            ]);
        }
        return view('contacts', compact('contacts', 'search'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('add_contacts');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'company' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);
        Contact::insert([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'company' => $request->company,
            'phone' => $request->phone,
            'email' => $request->email
        ]);
        return redirect()->route('contacts.index')->with('success', 'Contact inserted successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = Contact::findOrFail($id);
        return view('edit_contact', compact('contact'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $request->validate([
            'name' => 'required',
            'company' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ]);
        $contact = Contact::findOrFail($id);
        $contact->name = $request->name;
        $contact->company = $request->company;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->save();
        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            $contact->delete();
            return response()->json(['success' => 'Contact deleted successfully.']);
        } else {
            return response()->json(['error' => 'Contact not found.'], 404);
        }
    }
}
