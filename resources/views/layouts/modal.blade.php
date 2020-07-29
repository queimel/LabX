<div class="modal-dialog modal-dialog-centered @yield('size')" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">@yield('title')</h5>
        </div>
        <div class="modal-body">@yield('content')</div>
        <div class="modal-footer">@yield('footer')</div>
    </div>
</div>

@stack('modal-scripts')

@stack('styles')