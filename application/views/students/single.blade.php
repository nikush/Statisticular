@layout('template')

@section('breadcrumbs')
    @section('crumbs')
    <li><a href="{{URL::to('/')}}">Home</a></li>
    <li><a href="{{URL::to('campuses')}}">Campuses</a></li>
    <li><a href="{{URL::to('campuses/'.$campus->slug)}}">{{$campus->name}}</a></li>
    <li><a href="{{URL::to('campuses/'.$campus->slug.'/'.$intake->slug)}}">{{$intake->name}}</a></li>
    @endsection
    @include('partials.breadcrumbs')
@endsection

@section('content')
<h1>{{$student->get_full_name()}} ({{$student->id}})</h1>
<div class="row">
    <div class="two columns">
        <ul class="side-nav">
            <li><a href="#">Assignments</a></li>
            <li><a href="#">Attendance</a></li>
            <li class="divider"></li>
            <li>Stats for this student</li>
        </ul>
    </div>
    <div class="ten columns">
    </div>
</div>
@endsection
