@layout('template')

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('content')
<h1>{{$student->get_full_name()}} ({{$student->id}})</h1>
<div class="row">
    <div class="two columns">
        @yield('side-nav')
    </div>
    <div class="ten columns">
    </div>
</div>
@endsection
