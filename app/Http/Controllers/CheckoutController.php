<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jackiedo\Cart\Facades\Cart;
use App\Models\Order;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartItems = Cart::name('shopping')->getDetails();
        return view('checkout.index', compact('cartItems'));
    }

    public function setPayment(Request $request)
    {
        Stripe::setApiKey('sk_test_51OsKzECIXOl0WhuFvOmDY3BSHrNlT4tHBsbAVz4BztZrx0xIQNiMcKPMGlJOwIDZ2rVfXoSKpqUtzy0yRd3GVXQa00W5IpaeAi');
        $amountToInt = round(Cart::name('shopping')->getDetails()->total * 100, 0, PHP_ROUND_HALF_UP); 
        $intent = null;
        $json_str = file_get_contents('php://input');
        $json_obj = json_decode($json_str);
        try {
            if (isset($json_obj->payment_method_id)) {
                # Create the PaymentIntent
                $customer = \Stripe\Customer::create([
                    'email' => auth()->user()->email,
                    'description' => 'New customer',
                    'metadata' => [
                        'name' => auth()->user()->name,
                    ],
                ]);
                $intent = \Stripe\PaymentIntent::create([
                    'payment_method' => $json_obj->payment_method_id,
                    'amount' => $amountToInt,
                    'currency' => 'eur',
                    'confirmation_method' => 'manual',
                    'confirm' => true,
                    //'statement_descripton' => env('APP_NAME'),
                    'customer'=> $customer->id,
                    'description' => 'Payment made by '. auth()->user()->email,
                    'return_url' => url('/payment/success')
                ]);
            }
            if (isset($json_obj->payment_intent_id)) {
                $intent = \Stripe\PaymentIntent::retrieve(
                    $json_obj->payment_intent_id
                );
                $intent->confirm();
            }
            $this->generateResponse($intent, $request);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            # Display error on client
            echo json_encode([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function generateResponse($intent, Request $request)
    {
        if ($intent->status == 'requires_action' &&
            $intent->next_action->type == 'redirect_to_url') {
            # Tell the client to handle the action
            echo json_encode([
                'requires_action' => true,
                'payment_intent_client_secret' => $intent->client_secret
            ]);
        } else if ($intent->status == 'succeeded') {
            $cartItems = Cart::name('shopping')->getDetails()->items;
            $productNames = '';
            foreach($cartItems as $cartItem)
            {
                $productNames .= $cartItem->title . ',';
            }
            Order::create([
                'user_id' => auth()->user()->id,
                'product_name' => $productNames,
                'total_price' => Cart::name('shopping')->getDetails()->total,
                'quantity' => Cart::name('shopping')->getDetails()->quantities_sum,
                'adress' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'status' => 'Paid'
            ]);
            Cart::name('shopping')->clearItems();
            echo json_encode([
                'success' => true
            ]);
        } 
        else {
            # Invalid status
            http_response_code(500);
            echo json_encode(['error' => 'Invalid PaymentIntent status']);
        }

    }

    public function successPayment()
    {
        return view('checkout.success');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
