<div class="header-dropdown-list cart-menu ps4 overflow-hidden">
    @forelse($unseenMessages as $message)
        <a class="dropdown-item d-flex message-link" href="#"
           data-id="{{ $message->id }}"
           data-url="{{ route('admin.view-message', $message->id) }}">
            <span class="avatar avatar-md brround me-3 align-self-center cover-image"
                  data-bs-image-src="{{ asset('assets/images/users/default.jpg') }}"></span>
            <div class="wd-90p">
                <div class="d-flex">
                    <h5 class="mb-1">{{ $message->senderName ?? 'Unknown' }}</h5>
                    <small class="text-muted ms-auto text-end">{{ $message->created_at->diffForHumans() }}</small>
                </div>
                <span class="fs-12 text-muted">{{ Str::limit($message->senderMessage, 40) }}</span>
            </div>
        </a>
    @empty
        <div class="text-center p-4">
            <p class="text-muted">No new messages</p>
        </div>
    @endforelse
</div>
