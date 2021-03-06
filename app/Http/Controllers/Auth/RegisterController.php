<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /**
     * RegisterController constructor.
     */
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed'
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        auth()->attempt($request->only('email', 'password'));
        return redirect()->route('dashboard');
    }
}
