<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewContact;
use App\Mail\NewContactReceived;

class ContactController extends Controller
{
    public function store(request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $newContact = new Contact();
        $newContact->name = $data["name"];
        $newContact->email = $data["email"];
        $newContact->message = $data["message"];

        $newContact->save();

        $admins = ['ivanop92@gmail.com', 'pazigabriele@gmail.com', 'andrealinza@gmail.com'];
        //Mail da inviare come conferma mall'utente che ha compilato il form
        Mail::to($data['email'])->send(new NewContact($data));
        //Mail da inviare a noi stessi come avviso che l'utente ci ha scritti.
        Mail::to($admins)->send(new NewContactReceived($data));

        return response()->json([
            'message' => 'thank you for the message.'
        ], 201);
    }
}
