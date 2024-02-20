<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Services\Client\ClientService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * 
 * This class is basically a CRUD for the user/client itself
 */

class ClientController
{

    /**
     * Gets client's dashboard
     * 
     * @param Request $request Laravel request Class
     * @param ClientService $clientService Client Service that is injected intothe controller so we can use methods of that class
     * @return View
     */
    function dashboard(Request $request, ClientService $clientService): View
    { 
        $data = $clientService->getDashboardData();
        return view('client.dashboard', [
            'ordersTotal' => $data['ordersTotal'], 
            'pendingOrdersTotal' => $data["pendingOrdersTotal"],
            'canceledOrdersTotal' => $data['canceledOrdersTotal'],
            'finishedOrdersTotal' => $data['finishedOrdersTotal'],
        ]);         
    }

    /**
     * Gets the client's profile
     * 
     * @param Request $request Laravel request Class
     * @param ClientService $clientService Client Service that is injected intothe controller so we can use methods of that class
     * @return View
     */
    function profile(Request $request, ClientService $clientService): View
    { 
        if ($clientService->getLoggedUser()) {
            return view('client.profile', ['user' => $clientService->getLoggedUser()]);
        }
   
        $request->session()->flash('alert', 'danger');
        $request->session()->flash('message', 'An error occurred trying to retrieve your profile');
        return view('client.profile');
    }

    /**
     * Updates customer's information
     * 
     * @param Request $request Laravel request Class
     * @param ClientService $clientService Client Service that is injected intothe controller so we can use methods of that class
     * @return View
     */
    function update(Request $request, ClientService $clientService): RedirectResponse
    { 
        $request->validate([
            'name' => ['required'],
            'address' => ['required'],
            'phone' => ['required']
        ]);

        $saveClient = $clientService->save($request->name, $request->address, $request->phone);

        // if returns 1, it means the details were successfully updated
        if ($saveClient === 1) {
            $request->session()->flash('alert', 'success');
            $request->session()->flash('message', 'Profile successfully updated');
        } else {
            $request->session()->flash('alert', 'danger');
            $request->session()->flash('message', 'An error occurred trying to update your profile');    
        }

        return redirect('profile');  
    }

    /**
     * Changes email/password of the customer
     * 
     * @param Request $request Laravel request Class
     * @param ClientService $clientService Client Service that is injected intothe controller so we can use methods of that class
     * @return RedirectResponse
     */
    function saveLoginDetails(Request $request, ClientService $clientService): RedirectResponse
    { 
        $request->validate([
            'email' => ['required', 'email', 'unique:users,email,'.auth()->user()->id],
            'password' => ['required', 'min:8']
        ]);

        $saveLoginDetails = $clientService->saveLoginDetails($request->email, $request->password);

        // if returns 1, it means the login details were successfully updated
        if ($saveLoginDetails === 1) {
            $request->session()->flash('alert', 'success');
            $request->session()->flash('message', 'Login details successfully changed');
        } else {
            $request->session()->flash('alert', 'danger');
            $request->session()->flash('message', 'An error occurred trying to update your login details');    
        }

        return redirect('profile');         
    }


    /**
     * Creates a new user client
     * 
     * @param Request $request Laravel request Class
     * @param ClientService $clientService Client Service that is injected into the controller so we can use methods of that class
     */
    function create(Request $request, ClientService $clientService): View
    {                 
        if ($clientService->create()) {
            $request->session()->put('alert', 'success');
            $request->session()->put('message', 'Client successfully saved');
            return $clientService->redirect('users/user/1');
        }
   
        $request->session()->put('alert', 'danger');
        $request->session()->put('message', 'An error occurred trying to save client');
        return view('users/user/1');       
    }
}
