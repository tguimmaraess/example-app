<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Services\Client\ClientService;
use App\Services\Order\OrderService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * 
 * Client orders controller performs various actions related to the customer's orders
 */

class ClientOrdersController
{

    /**
     * Gets client's orders
     * 
     * @param Request $request Laravel request Class
     * @param OrderService $ordertService Order Service that is injected intothe controller so we can use methods of that class
     * @return View
     */
    function index(Request $request, orderService $orderService): View
    { 
        $orders = $orderService->getClientOrders();

        return view('client.orders', ['orders' => $orders]);         
    }

    /**
     * Searchs client's orders
     * 
     * @param Request $request Laravel request Class
     * @param OrderService $ordertService Order Service that is injected intothe controller so we can use methods of that class
     * @return View
     */
    function search(Request $request, orderService $orderService): View
    { 
        if ($request->query('search') !== '' && $request->query('search') !== null) {
            $orders = $orderService->searchClientOrders($request->query('search'));
        } else {
            $orders = $orderService->getClientOrders();
        }

        return view('client.orders', ['orders' => $orders]);         
    }

    /**
     * Gets specific order
     * 
     * @param $orderId Id of the order
     * @param Request $request Laravel request Class
     * @param OrderService $ordertService Order Service that is injected intothe controller so we can use methods of that class
     * @return View
     */
    function show($orderId, Request $request, orderService $orderService): View|RedirectResponse
    { 
        $order = $orderService->getOrderById($orderId);
        if ($order !== null) {
            return view('client.order', ['order' => $order]);   
        }   
           
        return redirect('orders');   
    }
    
    /**
     * Cancels specific order
     * 
     * @param $orderId Id of the order
     * @param Request $request Laravel request Class
     * @param OrderService $ordertService Order Service that is injected intothe controller so we can use methods of that class
     * @return View
     */
    function cancel($orderId, Request $request, OrderService $orderService): RedirectResponse
    { 
        $order = $orderService->cancelOrderById($orderId);

        // if returns 1, it means the order was successfully canceled
        if ($order === 1) {
            $request->session()->flash('alert', 'success');
            $request->session()->flash('message', 'Order successfully canceled');
        } else {
            $request->session()->flash('alert', 'danger');
            $request->session()->flash('message', 'The order could not be canceled. Please, try again.');    
        }

        return redirect('orders');         
    }
     
    /**
     * Resets specific order to the pending status
     * 
     * @param $orderId Id of the order
     * @param Request $request Laravel request Class
     * @param OrderService $ordertService Order Service that is injected intothe controller so we can use methods of that class
     * @return View
     */
    function reset($orderId, Request $request, OrderService $orderService): RedirectResponse
    { 
        $order = $orderService->resetOrderById($orderId);

        // if returns 1, it means the order was successfully canceled
        if ($order === 1) {
            $request->session()->flash('alert', 'success');
            $request->session()->flash('message', 'Order successfully reset');
        } else {
            $request->session()->flash('alert', 'danger');
            $request->session()->flash('message', 'We could not reset the order. Please, try again.');    
        }

        return redirect('order/'.$orderId);         
    }
  
}
