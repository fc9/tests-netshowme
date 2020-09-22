<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class ContactRepository
{
    /**
     * Registering a new contact.
     *
     * @param Request $request
     * @return Contact|mixed
     */
    public static function register(Request $request)
    {
        $path = self::uploadAttachment($request->file('attachment'));

        DB::beginTransaction();
        try {
            $contact = new Contact;
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->message = $request->message;
            $contact->attachment = $path;
            $contact->ip = $request->ip();
            $contact->save();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

        return $contact;
    }

    /**
     * Upload attachment
     *
     * @param UploadedFile $file
     * @return false|string path
     */
    public static function uploadAttachment(UploadedFile $file)
    {
        $config = config('contact');
        return $file->store($config['path'], $config['options']);
    }
}
