@layout('template')

@section('content')
@yield('heading')
<div class="row">
    <div class="two columns">
        @yield('side-nav')
    </div>
    <div class="ten columns">
        @yield('main')
    </div>
</div>
@endsection
