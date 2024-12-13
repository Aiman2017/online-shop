<?php

namespace App\Listeners;

use App\Events\CacheEvents;
use Illuminate\Support\Facades\Cache;

class ClearCache
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CacheEvents $event): void
    {
        if ($event->type) {
            Cache::forget($event->type);
        }
//        switch ($event->type) {
//            case 'banners':
//                Cache::forget('banners');
//                Cache::forget('features');
//                break;
//            case 'category':
//                Cache::forget('category');
//                Cache::forget('categories');
//                break;
//            case 'product':
//                Cache::forget('product');
//                break;
//            case 'brands':
//                Cache::forget('brands');
//                break;
//            case 'all';
//                Cache::flush();
//                break;
//            default:
//                break;
//        }
    }
}
