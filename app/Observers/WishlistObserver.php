<?php

namespace App\Observers;

use App\Models\Wishlist;
use Illuminate\Support\Str;

class WishlistObserver
{
    public function creating(Wishlist $wishlist)
    {
        $wishlist->uuid = Str::uuid();
    }
}
