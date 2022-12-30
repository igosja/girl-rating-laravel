<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class LoginController
 * @package App\Http\Controllers
 */
class LoginController extends AbstractController
{
    /**
     * @return Application|Factory|View
     */
    public function login(): View|Factory|Application
    {
        return view('login.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function processLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, true)) {
            $request->session()->regenerate();

            return redirect()->intended('home');
        }

        return back();
    }
}
