@layout('template')

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('content')
<h1>{{$intake->name}}</h1>
<div class="row">
    <div class="two columns">
        <ul class="side-nav">
            <li><a href="{{URL::to('campuses/'.$campus->slug.'/'.$intake->slug)}}">Students</a></li>
            <li class="active"><a href="{{URL::current()}}">Assignments</a></li>
            <li class="divider"></li>
            <li>Stats for this intake</li>
        </ul>
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
