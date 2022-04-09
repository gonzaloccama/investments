@push('title'){{ $_title }}@endpush
<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
    <ol class="breadcrumb pt-0">
        <li class="breadcrumb-item">
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        {{--        <li class="breadcrumb-item">--}}
        {{--            <a href="#">{{ $title }}</a>--}}
        {{--        </li>--}}
        <li class="breadcrumb-item active" aria-current="page">{{ $_title }}</li>
    </ol>
</nav>
