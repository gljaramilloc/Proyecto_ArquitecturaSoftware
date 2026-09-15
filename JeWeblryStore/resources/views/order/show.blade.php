@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ $viewData['subtitle'] }}</h4>
                        <span class="badge bg-secondary fs-6">
                            {{ $viewData['order']->getStatus() ? $viewData['order']->getStatus()->getName() : 'N/A' }}
                        </span>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-4">{{ __('order.items') }}</h5>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('order.jewel') }}</th>
                                        <th>{{ __('order.price') }}</th>
                                        <th>{{ __('order.quantity') }}</th>
                                        <th class="text-end">{{ __('order.subtotal') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($viewData['order']->getItems() as $item)
                                        <tr>
                                            <td>
                                                @if($item->getJewel())
                                                    {{ $item->getJewel()->getName() }}
                                                @else
                                                    {{ __('order.unknown_jewel') }}
                                                @endif
                                            </td>
                                            <td>${{ number_format($item->getPrice(), 2) }}</td>
                                            <td>{{ $item->getQuantity() }}</td>
                                            <td class="text-end">
                                                ${{ number_format($item->getPrice() * $item->getQuantity(), 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-end">{{ __('order.total') }}</th>
                                        <th class="text-end fs-5">${{ number_format($viewData['order']->getTotal(), 2) }}
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="mt-4 text-end">
                            <a href="{{ route('orders.index') }}" class="btn btn-outline-primary">
                                {{ __('order.back_to_orders') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection