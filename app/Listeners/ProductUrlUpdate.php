<?php

namespace App\Listeners;

use App\Category;
use App\Product;
use App\Events\CategoryUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProductUrlUpdate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CategoryUpdated  $event
     * @return void
     */
    public function handle(CategoryUpdated $event)
    {
        $category = $event->category;
        Product::where('category_id',$category->id)->chunk(50, function($products) use($category) {
            foreach ($products as $key => $product) {
                $data = Product::find($product->id);
                $data->url = $category->url.'/'.$product->title;
                $data->save();
            }
        });
      
    }
}
