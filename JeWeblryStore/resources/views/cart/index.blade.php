@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $viewData['subtitle'] }}</h5>
                        <a href="{{ route('cart.removeAll') }}"
                            class="btn btn-sm btn-danger">{{ __('cart.remove_all') }}</a>
                    </div>
                    <div class="card-body p-4">
                        @if(count($viewData['jewels']) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th>{{ __('cart.jewel') }}</th>
                                            <th>{{ __('cart.price') }}</th>
                                            <th class="text-center">{{ __('cart.quantity') }}</th>
                                            <th class="text-end">{{ __('cart.subtotal') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($viewData['jewels'] as $jewel)
                                            @php
                                                $quantity = $viewData['cartSession'][$jewel->getId()];
                                                $subtotal = $jewel->getPrice() * $quantity;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <strong>{{ $jewel->getName() }}</strong>
                                                </td>
                                                <td>${{ number_format($jewel->getPrice(), 2) }}</td>
                                                <td class="text-center">
                                                    <span class="badge bg-secondary fs-6 px-3 py-2">
                                                        {{ $quantity }}
                                                    </span>
                                                </td>
                                                <td class="text-end fw-bold">
                                                    ${{ number_format($subtotal, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-end fs-5">{{ __('cart.total') }}:</th>
                                            <th class="text-end fs-5 text-success">
                                                ${{ number_format($viewData['total'], 2) }}
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <form method="POST" action="{{ route('cart.purchase') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-lg px-5">
                                        {{ __('cart.purchase_btn') }}
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <h4 class="text-muted">{{ __('cart.empty') }}</h4>
                                <a href="{{ route('home.index') }}" class="btn btn-outline-primary mt-3">
                                    {{ __('cart.back_to_shop') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection