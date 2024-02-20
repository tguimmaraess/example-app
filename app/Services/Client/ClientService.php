<?php
namespace App\Services\Client;

use App\Models\Shared\User;
use App\Models\Client\Client;
use App\Models\Order\Order;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


/**
 * Class service that contains logic to perform various tasks related to the client
 */
class ClientService
{

    /**
     * Gets client dashboard data like overall information, stats and more
     * 
     * @return array Returns an array with various information to be rendered in the dashboard page
     */
    function getDashboardData(): array
    {
       $data = [];
       
       $data["ordersTotal"] = Order::where('client_id', auth()->user()->id)->count();
      
       $data["pendingOrdersTotal"] = Order::where('client_id', auth()->user()->id)->where('status', 'pending')->count();
        
       $data["canceledOrdersTotal"] = Order::where('client_id', auth()->user()->id)->where('status', 'canceled')->count();

       $data["finishedOrdersTotal"] = Order::where('client_id', auth()->user()->id)->where('status', 'finished')->count();

       return $data;
    }

    /**
     * Gets logged client
     * 
     * @return User Returns the user model containing all information related to the logged client
     */
    function getLoggedUser(): User
    {
        return User::find(auth()->user()->id);
    }

    /**
     * Updates a client and the user along with.
     * 
     * @param string $name
     * @param string $address
     * @param string $phone
     * @return int|null
     *
     */
    function save(string $name, string $address, string $phone): int|null
    {
        return DB::transaction(function() use ($name, $address, $phone) {
            $userId = auth()->user()['id'];
            
            User::where('id', auth()->user()->id)->update([
                'name' => $name,
            ]); 

           return Client::where('user_id', $userId)->update([
                'name' => $name,
                'address' => $address,
                'phone' => $phone
            ]); 
       }, 3);
    }

    /**
     * Updates the credentials of a user for login
     *  
     * @param string $email
     * @param string $email
     * @return int
     */
    function saveLoginDetails(string $email, string $password): int 
    {
        return User::where('id', auth()->user()->id)->update([
            'email' => $email,
            'password' => Hash::make($password)
        ]);  
    }

    /**
     * Creates the user and the client 
     *  
     * @param string $email
     * @param string $password
     * @param string $name
     * @param string $address
     * @param string $phone
     * @return Client|null
     */
    function create(string $email, string $password, string $name, string $address, string $phone): Client|null 
    {
        return DB::transaction(function() use ($email, $password, $name, $address, $phone) {
            $user = User::create([
                'name' => $name,
                'user_type' => 'client',
                'email' => $email,
                'password' => Hash::make($password)
            ]); 

            return Client::create([
                'name' => $name,
                'address' => $address,
                'user_id' => $user['id'],
                'phone' => $phone
            ]); 
       }, 3);
      
    }

     /**
     * Checks if client exists
     *  
     * @param int $id Id of the client
     * @return bool
     */
    function clientExists( int $id): bool
    {      
        if (Client()::find($id)) {
            return true;
         }

         return false;
    }
}