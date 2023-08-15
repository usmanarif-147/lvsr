<?php

namespace App\Http\Controllers;

use App\Models\User;
use JeroenDesloovere\VCard\VCard;

class VCardController extends Controller
{

    public function addContact($id)
    {

        $user = User::where('id', $id)->first();
        $vcard = new VCard();


        $vcard->addName('', $user->name);
        $vcard->addEmail($user->email);
        $vcard->addPhoneNumber($user->phone, 'WORK');
        $vcard->addCompany($user->company);
        $vcard->addJobtitle($user->job_title);



        return response()->make(
            $vcard->getOutput(),
            200,
            $vcard->getHeaders(true)
        );
    }
}
