@props(['status' => null])

@if ($status !== null)
    @switch($status->getName())
        @case('Approved')
        @case('Active')
            <span class="badge bg-success">{{ __('status.'.$status->getName()) }}</span>
            @break

        @case('Pending')
            <span class="badge bg-warning text-dark">{{ __('status.'.$status->getName()) }}</span>
            @break

        @case('Rejected')
            <span class="badge bg-danger">{{ __('status.'.$status->getName()) }}</span>
            @break

        @default
            <span class="badge bg-secondary">{{ __('status.'.$status->getName()) }}</span>
    @endswitch
@else
    <span class="badge bg-secondary">{{ __('admin.not_available') }}</span>
@endif
