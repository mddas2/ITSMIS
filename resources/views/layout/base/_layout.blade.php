<div class="d-flex flex-column flex-root" id="kt_blockui_card">
    <div class="d-flex flex-row flex-column-fluid page">
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            @include('layout.base._header-mobile')
            <x-header />
            <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                <div class="d-flex flex-column-fluid">
                    @include('layout.base._content')
                </div>
            </div>
            <x-footer />
        </div>
    </div>
</div>
@include('layout.partials.extras._quick_notifications')
@include('layout.partials.extras._quick_user')
@include('layout.partials.extras._quick_panel')
@include('layout.partials.extras._chatpanel')
@include('layout.partials.extras._scrolltop')