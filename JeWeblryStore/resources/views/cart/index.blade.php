@extends('layouts.app')

@section('title', __('cart.title'))

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                    <div>
                        <p class="text-brand-gold text-uppercase fw-bold small mb-1">{{ __('cart.title') }}</p>
                        <h1 class="h2 font-display text-dark mb-0">{{ $viewData['subtitle'] }}</h1>
                    </div>

                    @if (count($viewData['jewels']) > 0)
                        <a href="{{ route('cart.removeAll') }}"
                            onclick="return confirm(@js(__('cart.confirm_remove_all')));"
                            class="btn btn-sm btn-outline-danger px-3 py-2">
                            <i class="bi bi-trash me-1" aria-hidden="true"></i>{{ __('cart.remove_all') }}
                        </a>
                    @endif
                </div>

                <div class="card border shadow-sm bg-white rounded-0">
                    <div class="card-body p-4">
                        @if (count($viewData['jewels']) > 0)
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr class="text-uppercase small text-muted">
                                            <th scope="col">{{ __('cart.jewel') }}</th>
                                            <th scope="col">{{ __('cart.price') }}</th>
                                            <th scope="col" class="text-center">{{ __('cart.quantity') }}</th>
                                            <th scope="col" class="text-end">{{ __('cart.subtotal') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($viewData['jewels'] as $jewel)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('jewels.show', $jewel->getId()) }}" class="fw-bold text-dark text-decoration-none">
                                                        {{ $jewel->getName() }}
                                                    </a>
                                                </td>
                                                <td>${{ number_format($jewel->getPrice(), 2) }}</td>
                                                <td class="text-center">
                                                    <span class="badge bg-secondary px-3 py-2">
                                                        {{ $viewData['cartSession'][$jewel->getId()] }}
                                                    </span>
                                                </td>
                                                <td class="text-end fw-bold text-brand-gold">
                                                    ${{ number_format($jewel->getPrice() * $viewData['cartSession'][$jewel->getId()], 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-end fs-5 pt-3">{{ __('cart.total') }}:</th>
                                            <th class="text-end fs-5 text-brand-gold pt-3">
                                                ${{ number_format($viewData['total'], 2) }}
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-4 pt-2">
                                <a href="{{ route('jewels.index') }}" class="btn btn-brand-outline px-4 py-2">
                                    <i class="bi bi-arrow-left me-1"></i>{{ __('cart.continue_shopping') }}
                                </a>

                                <form method="POST" action="{{ route('cart.purchase') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-brand px-5 py-2">
                                        <i class="bi bi-bag-check me-1"></i>{{ __('cart.purchase_btn') }}
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="bi bi-cart-x display-4 text-muted d-block mb-3"></i>
                                <h4 class="font-display text-dark mb-3">{{ __('cart.empty') }}</h4>
                                <a href="{{ route('jewels.index') }}" class="btn btn-brand px-4 py-2">
                                    {{ __('cart.continue_shopping') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
