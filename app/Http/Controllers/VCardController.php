<?php

namespace App\Http\Controllers;

use App\Models\User;
use JeroenDesloovere\VCard\VCard;

class VCardController extends Controller
{


    // $profile=Profile::where('id',$id)->first();
    // 	if(!$profile)
    // 	    die("Profile Not Found");
    //      $userPlatforms=$this->getUserPlatforms($profile->id);

    // 	$vcard = new VCard();
    // 	$vcard->addName('',$profile->name);
    // 	if($profile->email)
    // 	   $vcard->addEmail($profile->email);
    // 	if($profile->phone)
    // 	   $vcard->addPhoneNumber($profile->phone);

    // 	$vcard->addURL('https://api.tikl.se/'.$profile->id);

    // 	if($userPlatforms)
    // 	{
    //         foreach($userPlatforms as $platform){

    // 			if($platform->title=='WhatsApp'){
    // 				$vcard->addPhoneNumber($platform->path, 'PREF;CELL');
    // 			}
    //             else if(!is_null($platform->path) && !is_null($platform->baseURL)){
    //               $vcard->addURL($platform->baseURL.$platform->path,$platform->title);
    //             }
    //     	}
    // 	}
    // 			if($profile->photo){
    // 			  $vcard->addPhoto('https://api.tikl.se/public/storage/'.$profile->photo);
    // 			//   $vcard->addPhoto('http://127.0.0.1:8000/storage/'.$profile->photo);
    // 			}
    // 	// $vcard->addNote('Hard press on the profile picture above to save this contact to your phone!');

    //     if($profile->company){
    //       $vcard->addCompany($profile->company);
    // 	}

    //     if($profile->job_title){
    //       $vcard->addJobtitle($profile->job_title);
    // 	}

    //     if($profile->dob){
    // 		$dob=Carbon::parse($profile->dob)->toDateTimeString();
    // 		$vcard->addBirthday($dob);
    // 	}
    //     if($profile->address){
    //       $vcard->addAddress($profile->address);
    // 	}

    // 	return $vcard->download();
    // }

    public function addContact($id)
    {

        $user = User::where('id', $id)->first();
        $vcard = new VCard();


        $user->name ? $vcard->addName('', $user->name) : $vcard->addName('', $user->username);
        $user->email ? $vcard->addEmail($user->email) : $vcard->addEmail('N/A');
        $user->phone ? $vcard->addPhoneNumber($user->phone, 'WORK') : $vcard->addPhoneNumber($user->phone, 'N/A');
        $user->company ? $vcard->addCompany($user->company) : $vcard->addCompany('N/A');
        $user->job_title ? $vcard->addJobtitle($user->job_title) : $vcard->addJobtitle('N/A');
        $user->photo ? $vcard->addPhoto('https://lvsr.tikl.se/public/storage/' . $user->photo) : '';

        return response()->make(
            $vcard->getOutput(),
            200,
            $vcard->getHeaders(true)
        );
    }
}
