<?php
namespace App\Services\Order;

use App\Models\Shared\User;
use App\Models\Client\Client;
use App\Models\Order\Order;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class service that contains logic to perform various tasks related to the orders
 */

class OrderService
{

   /**
    * Gets clients orders
    * 
    * @return LengthAwarePaginator Returns array of orders of the logged customer paginated 
    */
   function getClientOrders(): LengthAwarePaginator
   {
      return Order::where('client_id', auth()->user()->id)->paginate(10);
   }

   /**
    * Search clients orders by id or status
    *
    * @param $search Contains the search query
    * @return LengthAwarePaginator Returns array of searched orders of the logged customer paginated 
    */
    function searchClientOrders(string $search): LengthAwarePaginator
    {
       return Order::where('client_id', auth()->user()->id)
       ->where('id', $search)
       ->orWhere('status', $search)
       ->paginate(10);
    }

   /**
    * Cancels an order
    *
    * @param $id Id of the order
    * @return int
    */
   function cancelOrderById($id): int
   {
      return Order::where('id', $id)->update(['status' => 'canceled']);
   }

    /**
     * Resets an order
     * 
     * @param $id Id of the order
     * @return int
     */
   function resetOrderById($id): int
   {
       return Order::where('id', $id)->update(['status' => 'pending']);
   }

   /**
    * Gets an order by the id
    *
    * @param $id Id of the order
    * @return Order|null
   */
   function getOrderById($id): Order|null
   {
      return Order::find($id);
   }

   /**
    * Checks if given order exists
    *  
    * @param int $id Id of the order
    * @return bool
    */
   function orderExists(int $id): bool
   {      
      if (Order::find($id)) {
         return true;
      }

      return false;
   }
}