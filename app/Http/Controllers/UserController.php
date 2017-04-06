<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationMail;
use App\Mail\Test;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function getLogin()
    {
        return view('user.login');
    }

    public function postLogin(Request $request)
    {
        $input = $request->all();
        $attempt = Auth::attempt([
            'email' => $input['email'],
            'password' => $input['password'],
        ]);

        if ($attempt) {
            return redirect('/user/profile');
        } else {
            return redirect()->back();
        }
    }

    public function getRegister()
    {
        return view('user.register');
    }

    public function postRegister(Request $request)
    {
        $input = $request->all();
        $conf_token = md5(time(). random_int(1, 100000));

        $user = new User();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = bcrypt($input['password']);
        $user->status_id = 0;
        $user->confirmation_token = $conf_token;
        $user->save();

        if ($user) {
            Auth::login($user);
            Mail::to($request->user())->send(new ConfirmationMail($conf_token));
            return redirect('/user/profile');
        } else {
            return redirect()->back();
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/user/login');
    }

    public function getProfile()
    {
        return view('user.profile');
    }

    public function postEditProfile(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->save();
        return redirect()->back();
    }

    public function postChangePassword(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();
        $user->password = bcrypt($input['password']);
        $user->save();
        return redirect()->back();
    }

    public function getTestMail()
    {
        Mail::to('kastorniy.daniil@gmail.com')->send(new Test());
    }

    public function getConfirm()
    {
        return view('user.confirm');
    }

    public function getConfirmationAccount($confirmation_token)
    {
        $user = Auth::user();
        if ($confirmation_token === $user->confirmation_token) {
            $user->status_id = 1;
            $user->save();
        }

        return redirect('/user/profile');
    }


}
