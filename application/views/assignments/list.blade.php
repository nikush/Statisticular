@layout('side-nav-content')

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('heading')
<h1>{{$intake->name}}</h1>
@endsection

@section('main')
<ul class="disc">
    @foreach($assignments as $assignment)
    <li><a href="{{URL::current()}}/{{Str::lower($assignment->code())}}">{{$assignment->name()}}</a></li>
    @endforeach
</ul>
@endsection
