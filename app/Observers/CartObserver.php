<?php

namespace App\Observers;

use App\Models\Cart;
use Illuminate\Support\Str;

class CartObserver
{
    /**
     * Handle the Cart "creating" event.
     */
    public function creating(Cart $cart): void
    {
        $cart->uuid = Str::uuid();
    }

}
