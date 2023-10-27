<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;





class LoginController extends Controller
{
    function index()
    {
        return view('login', [
            'title' => 'Login'
        ]);
    }
    public function authenticate(Request $request)
    {
        // Validasi ReCaptcha
        $recaptchaToken = $request->input('g-recaptcha-response');

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('NOCAPTCHA_SECRET'),
            'response' => $recaptchaToken,
        ]);

        if (!$response['success']) {
            // ReCaptcha validation failed
            throw ValidationException::withMessages(['g-recaptcha-response' => 'ReCaptcha verification failed.']);
        }

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',

        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login failed!!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
