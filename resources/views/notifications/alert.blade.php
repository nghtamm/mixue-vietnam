{{-- <div class="alert alert-danger" id="alert" role="alert" style="{{ Session::has('error') ? '' : 'display: none;' }}">
    {{ Session::get('error') }}
</div> --}}

<div id="alert"></div>
<script src="{{ asset('frontend\js\alert.js') }}"></script>
