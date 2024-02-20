<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Services\Client\ClientService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * 
 * This class is for client's authentication
 */

class ClientAuthenticationController
{

    /**
     * Shows login page
     * 
     * @param Request $request Laravel request Class
     * @return View|RedirectResponse
     */
    function loginPage(Request $request): View|RedirectResponse
    {  
        // If customer is already loggedd, redirects to dashboard
        if (auth()->check()) {
            return redirect('/dashboard');
        }
        return view('client.login');
    }

    /**
     * Shows create account page
     * 
     * @param Request $request Laravel request Class
     * @return View
     */
    function createAccountPage(Request $request): View
    {  
        return view('client.create-account');
    }

    /**
     * Creates user account
     * 
     * @param Request $request Laravel request Class
     * @param ClientService $clientService Client Service that is injected intothe controller so we can use methods of that class
     * @return View
     */
    function createAccount(Request $request, ClientService $clientService): RedirectResponse
    {  
        $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
            'name' => ['required'],
            'address' => ['required'],
            'phone' => ['required'],
        ]);

       $create = $clientService->create($request->email, $request->password,  $request->name, $request->address,$request->phone);

        if ($create) {
            $request->session()->flash('alert', 'success');
            $request->session()->flash('message', 'Account succesfully created. Please log in');
            Auth::logout();
            return redirect('login');
        }

        $request->session()->flash('alert', 'danger');
        $request->session()->flash('message', 'An error occurred when creating your account. Please try again.');
        return redirect('create-account');
    }

    /**
     * Logs a user in
     * 
     * @param Request $request Laravel request Class
     * @param ClientService $clientService Client Service that is injected intothe controller so we can use methods of that class
     * @return View
     */
    function logIn(Request $request, ClientService $clientService): View|RedirectResponse
    { 
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect('/dashboard');
        }
   
        $request->session()->flash('alert', 'danger');
        $request->session()->flash('message', 'Email or password invalid');
        return view('client.login');
    }

    /**
     * Logs a user out
     * 
     * @param Request $request Laravel request Class
     * @return View
     */
    function logOut(Request $request): View
    {  
        Auth::logout();
        return view('client.login');
    }

}
