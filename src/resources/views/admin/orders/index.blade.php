@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Nalozi</h1>
        <table class="table mt-3">
            <thead>
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Adresa</th>
                <th>Ukupni troškovi</th>
                <th>Data</th>
                <th>Akcije</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->email }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->totalPrice }} RSD</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-info">Pregled</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <!-- Отображение пагинации -->
        <div>
            {{ $orders->links() }}
        </div>
    </div>
@endsection

