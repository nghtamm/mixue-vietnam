<div class="toast-container position-fixed bottom-0 start-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true"
        style="background-color:#198754; color:white">
        <div class="toast-header">
            {{-- <img src="..." class="rounded me-2" alt="..."> --}}
            <strong class="me-auto">Thông báo</strong>
            {{-- <small>11 mins ago</small> --}}
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            @if (Session::has('success'))
                {{ Session::get('success') }}
            @endif
            @if (Session::has('error'))
                {{ Session::get('error') }}
            @endif
        </div>
    </div>
</div>
