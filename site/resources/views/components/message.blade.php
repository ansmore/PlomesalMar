@if (session('status'))
    <div id="success-message" class="custom-alert success">
        <p>{{ session('status') }}</p>
    </div>
@endif

@if (session('error'))
    <div id="error-message" class="custom-alert error" data-error="{{ session('error') }}">
        <p>{{ session('error') }}</p>
    </div>
@endif
