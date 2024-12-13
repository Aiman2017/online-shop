<?php

namespace App\Jobs;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $data)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        sleep(10);
        Category::query()->create($this->data);
//        Product::query()->create(
//            [
//                'name' => 'Product 1',
//                'description' => 'Product 1 description',
//                'price' => 100,
//                'code' => 'Product 1 code',
//                'category_id' => 1,
//                'old_price' => 100,
//                'status' => 1,
//                'additional_info' => 'Additional info 1',
//                'brand_id' => 1,
//                'slug' => 'Product 1 slug',
//            ]
//        );
    }
}
