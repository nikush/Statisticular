@layout('template')

@section('breadcrumbs')
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
