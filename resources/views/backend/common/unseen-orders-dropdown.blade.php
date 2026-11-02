<div class="header-dropdown-list cart-menu ps4 overflow-hidden">
    @forelse($unseenOrders as $order)
        <a href="#" class="dropdown-item d-flex p-4 order-link"
           data-id="{{ $order->id }}"
           data-url="{{ route('admin.view-order', $order->id) }}">
            <div class="cart-desc mt-1">
                <p class="fs-13 mb-0 lh-1 text-dark fw-500">
                    {{ $order->plan->service->serviceName ?? 'No Service' }} - {{ $order->plan->planName ?? '' }} Plan
                </p>
                <p class="fs-12 mb-0 lh-1 text-secondary">
                    Ordered by: {{ $order->user->name ?? 'Unknown' }}
                </p>
                <p class="fs-12 fw-300 lh-1 mb-0">
                    Status: <span class="text-green">New </span>
                </p>
                <p class="fs-12 fw-300 lh-1 mb-0">
                    <span>{{ $order->created_at->timezone('Asia/Dhaka')->diffForHumans() }}</span>
                </p>
            </div>
            <div class="ms-auto text-end d-flex fs-16">
                <span class="fs-16 text-dark d-none d-sm-block fw-semibold">
                    ${{ $order->plan->planPrice }}
                </span>
            </div>
        </a>
    @empty
        <div class="text-center p-4">
            <p class="text-muted">No new orders</p>
        </div>
    @endforelse
</div>
