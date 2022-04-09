<div class="col-md-12 mt-3 mb-3">
    @push('title')
        {{ $_title }}
    @endpush
    <div class="breadcrumb-five d-none d-md-block d-lg-inline-block">
        <ul class="breadcrumb">
            <li class="mb-2"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            @if(route('admin.dashboard') !== url()->current())
                <li class="active mb-2"><a href="javascript:;">{{ $_title }}</a></li>
            @endif
{{--            --}}
{{--            <li class="mb-2"><a href="javascript:;">UI Kit</a></li>--}}
        </ul>
    </div>
</div>
