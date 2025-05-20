<?php

namespace App\Service;

use App\Mail\User\PasswordMail;
use App\Models\Post;
use App\Models\User;
use Bitrix\Main\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;


class Service
{
    /**
     * @param $request
     * @param $file
     * @return mixed
     */
    public function create($request, $file){

       return
           Post::firstOrCreate([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $file,
            'category_id' => 1
        ]);

    }

    public function create_profile($request){

        $password = Str::random(10);
        $hashpassword = Hash::make($password);

        $user = User::firstOrCreate(
            [
            'email' => $request->email,
            ],
            [
                'name' => $request->name,
                'password' => $hashpassword
            ]
//                'password' => Hash::make($request->password)
        );

        $data = ['message' => 'This is a test!'];
        Mail::to($user->email)->send(new TestEmail($data));


        //return view('mail.user.password-mail', compact('user','password'));
    }
}
