<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Validator;
use App\User;

class AuthenticationController extends Controller
{
    public function index()
    {
        return Inertia::render('auth/Login');
    }

    // validate user input
    protected function validator(Request $request)
    {
        return $request->validate([
            'email' => 'unique:users,email,'.$request->email,
            'password' => 'required|string|min:6',
        ]);
    }

    //check login details and password if pwned
    public function login(Request $request)
    {
        $password = strtoupper($request->password);
        $email = $request->email;

        $user = User::where('email', '=', $email)
            ->where('password', sha1($password))
            ->first();

        if ($user !== null) {
            return Inertia::render('shared/Dashboard', [
                'user' => $user,
            ]);
        }
        else{
            return redirect()->back()->with('breach',"Email or password is not correct.");
        }
    }

    // register after checking if the password is not pwned
    public function register(Request $request)
    {
        $PwnedConnection = new PwnedConnectionController();

        $this->validator($request);

        $password = strtoupper($request->password);
        $email = $request->email;

        $sha = sha1($password);

        $prefix = substr($sha, 0, 5);
        $suffix = substr($sha, 5);

        $count = $PwnedConnection->connectToPwnedApi($prefix,$suffix);

        if($count !== null && $count > 0){
            return redirect()->back()->with('breach',"The password has been breached
                                            $count times, create another password.");
        }

        User::create([
           'email' => $email,
           'password' => $sha,
        ]);

        return redirect()->back()->with('success',"You have successfully registered, please Login");
    }

    public function logout()
    {
        Auth::logout();
    }
}
