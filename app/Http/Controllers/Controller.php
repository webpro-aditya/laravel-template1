<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


use App\Models\User;

use Stripe;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Get Stripe Creadentials
     *
     * @return Array
     */
    public function getStripeKeys()
    {
        $stripe_keys_arr = [];

        #True if Test Mode ON
        $paypal_mode = config('constants.stripe_test_mode');

        #Test Mode Keys
        $stripe_key = config('constants.stripe_test_key');
        $stripe_secret = config('constants.stripe_test_secret');

        #Live Mode Keys
        if (!$paypal_mode) {
            $stripe_key = config('constants.stripe_key');
            $stripe_secret = config('constants.stripe_secret');
        }

        $stripe_keys_arr['stripe_key'] = $stripe_key;
        $stripe_keys_arr['stripe_secret'] = $stripe_secret;

        return $stripe_keys_arr;
    }

    /**
     * Create Stripe Customer
     * 
     * @return Array $customer
     */
    public function createStripeCustomer($email)
    {
        #Stipe Keys Array
        $stripe_keys_arr = $this->getStripeKeys();
        #Extracting Stripe Key
        $stripe_secret = $stripe_keys_arr['stripe_secret'];

        $stripe = new \Stripe\StripeClient($stripe_secret);
        $customer = $stripe->customers->create([
            'email' => $email
        ]);
        return $customer;
    }


    public function getFieldValueUser($field_arr = [], $user_id = '')
    {
        $user_data = User::select($field_arr)->where('userId', $user_id)->first();
        return $user_data;
    }
}
