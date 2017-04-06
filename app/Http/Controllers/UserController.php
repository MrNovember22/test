<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
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
        $attempt = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
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
        $conf_token = md5(time(). random_int(1, 100000));

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
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
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->back();
    }

    public function postChangePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        $user->password = bcrypt($request->password);
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
