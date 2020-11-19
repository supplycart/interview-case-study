<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\OrderDetail;

class OrderDetails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //declaring variables
    protected $req, $user_id, $order_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($req, $user_id, $order_id)
    {
        $this->req = $req;
        $this->user_id = $user_id;
        $this->order_id = $order_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $inserted = []; $not_inserted = [];
        $data = json_decode($this->req);

        //forloop to store each dataset of product purchased
        foreach($data as $d){

            $order = new OrderDetail();
            $order->order_id = $this->order_id;
            $order->item_name = $d->name;
            $order->item_id = $d->id;
            $order->item_quantity = $d->count;
            $order->price_per_item = $d->price;
            $order->total_price = (int)($d->price) * (int)($d->count);
            $saved = $order->save();

            if($saved)
            {
                $inserted[] = $order->item_id;
            }
            else
            {
                $not_inserted[] = $order->item_id;
            }
        }

        info('inserted : ' . json_encode($inserted));
        info('not inserted : ' . json_encode($not_inserted));

    }
}
