@layout('template')

@section('breadcrumbs')
    @section('crumbs')
    <li><a href="{{URL::to('/')}}">Home</a></li>
    <li><a href="{{URL::to('campuses')}}">Campuses</a></li>
    <li><a href="{{URL::to('campuses/'.$campus->slug)}}">{{$campus->name}}</a></li>
    @endsection
    @include('partials.breadcrumbs')
@endsection

@section('content')
<h1>{{$intake}}</h1>
<div class="row">
    <div class="two columns">
        <ul class="side-nav">
            <li class="active"><a href="{{URL::current()}}">Students</a></li>
            <li><a href="{{URL::current()}}/assignments">Assignments</a></li>
            <li class="divider"></li>
            <li><a href="{{URL::current()}}/nationalities">Nationalities</a></li>
        </ul>
    </div>
    <div class="ten columns">
        <ul class="disc">
            @foreach($students as $student)
            <li><a href="{{URL::current().'/'.$student->id}}">{{$student->get_full_name()}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
