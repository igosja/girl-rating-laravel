<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class SignupController
 * @package App\Http\Controllers
 */
class SignupController extends AbstractController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function signup(): View|Factory|Application
    {
        return view('signup.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processSignup(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'name' => ['required'],
            'password' => ['required'],
        ]);

        $user = new User();
        $user->fill(
            array_merge(
                $credentials,
                ['password' => Hash::make($request->get('password'))]
            )
        );

        if (!$user->save()) {
            return back();
        }

        return redirect()->intended('home');
    }
}
