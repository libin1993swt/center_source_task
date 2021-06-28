<?php

namespace App\Providers;

use App\Providers\CategoryUpdated;
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
        //
    }
}
