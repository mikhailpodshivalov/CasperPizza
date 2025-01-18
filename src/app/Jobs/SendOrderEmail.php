<?php

namespace App\Jobs;

use App\Mail\OrderCreated;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendOrderEmail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $order;
    protected $items;
    protected $to;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order, $items, $to)
    {
        $this->order = $order;
        $this->items = $items;
        $this->to    = $to;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->to)->send(new OrderCreated($this->order, $this->items));
    }
}
