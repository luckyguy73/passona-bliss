<?php

namespace App\Http\Controllers\Listing;

use App\{Area, Listing};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListingPaymentController extends Controller
{
    public function __construct() 
    {
        $this->middleware(['auth']);
    }
    
    public function show(Area $area, Listing $listing) 
    {
        $this->authorize('touch', $listing);
        
        if ($listing->live()) {
            return back();
        }
        
        return view('listings.payment.show', compact('listing'));
    }
    
    /**
     * 
     * @param Request $request
     * @param Area $area
     * @param Listing $listing
     * @return void
     */
    
    public function store(Request $request, Area $area, Listing $listing) 
    {
        $this->authorize('touch', $listing);
        
        if ($listing->live() || $listing->cost() === 0) {
            return back();
        }
        
        if (($nonce = $request->payment_method_nonce) === null) {
            return back();
        }
        
        $result = \Braintree_Transaction::sale([
            'amount' => $listing->cost(),
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        
        if ($result->success === false) {
            return back()->withError('Something went wrong while processing the payment');
        }
        
        $listing->live = true;
        $listing->created_at = \Carbon\Carbon::now();
        $listing->save();
        
        return redirect()
            ->route('listings.show', [$area, $listing])
            ->withSuccess('Payment processed successfully and your listing is now live');
    }
    
    public function update(Request $request, Area $area, Listing $listing) 
    {
        $this->authorize('touch', $listing);
        
        if ($listing->cost() > 0) {
            return back()->withError('This listing requires payment');
        }
        
        $listing->live = true;
        $listing->created_at = \Carbon\Carbon::now();
        $listing->save();
        
        return redirect()
            ->route('listings.show', [$area, $listing])
            ->withSuccess('Your Listing is now live');
        
    }
}