<?php

namespace App\Jobs;

use App\Models\Selectiondate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Clean implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    
    public function handle()
    {
        $selections=Selectiondate::where('end','<', now())->get();

        if($selections->count()){
            foreach ($selections as $selection) {
                $selection->delete();
            }
        }
        
    }
}
