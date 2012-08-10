@layout('template')

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('content')
<h1>{{$intake->name}}</h1>
<div class="row">
    <div class="two columns">
        @yield('side-nav')
    </div>
    <div class="ten columns">
        <ul class="disc">
            @foreach($assignments as $assignment)
            <li><a href="{{URL::current()}}/{{Str::lower($assignment->code)}}">{{$assignment->name}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
