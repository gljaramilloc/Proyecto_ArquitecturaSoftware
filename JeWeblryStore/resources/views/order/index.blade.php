@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="mb-4">{{ $viewData['subtitle'] }}</h2>

                @if($viewData['orders']->isEmpty())
                    <div class="alert alert-info">
                        {{ __('order.no_orders') }}
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ __('order.order_id') }}</th>
                                    <th>{{ __('order.date') }}</th>
                                    <th>{{ __('order.total') }}</th>
                                    <th>{{ __('order.status') }}</th>
                                    <th>{{ __('order.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($viewData['orders'] as $order)
                                    <tr>
                                        <td>{{ $order->getId() }}</td>
                                        <td>{{ $order->getCreatedAt() }}</td>
                                        <td>${{ number_format($order->getTotal(), 2) }}</td>
                                        <td>{{ $order->getStatus() ? $order->getStatus()->getName() : 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('orders.show', $order->getId()) }}" class="btn btn-sm btn-primary">
                                                {{ __('order.view_details') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection