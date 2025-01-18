<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendOrderEmail;
use App\Mail\OrderCreated;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('products')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('products');
        return view('admin.orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $items = $request->input('items');

        $order = new Order();
        $order->fill([
            'email'      => $request->input('email'),
            'phone'      => $request->input('phone'),
            'address'    => $request->input('address'),
            'comment'    => $request->input('comment'),
            'totalPrice' => array_sum(array_column($items, 'price')),
        ]);

        $order->save();

        foreach ($items as $item) {
            OrderProduct::create([
                'order_id'   => $order->id,
                'product_id' => $item['pizza_id'],
                'size'       => $item['size'],
                'quantity'   => 1,
                'price'      => $item['price'],
            ]);
        }

        $order->save();

        $adminEmail = User::query()->value('email');

        dispatch(new SendOrderEmail($order, $items, $request->input('email')));

        if ($adminEmail) {
            dispatch(new SendOrderEmail($order, $items, $adminEmail));
        }

        return response()->json([
            'message' => 'Vaša porudžbina je uspešno poslata!',
            'orderId' => $order->id,
        ]);
    }
}
