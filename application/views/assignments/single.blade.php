@layout('template')

@section('breadcrumbs')
    @section('crumbs')
    <li><a href="{{URL::to('/')}}">Home</a></li>
    <li><a href="{{URL::to('campuses')}}">Campuses</a></li>
    <li><a href="{{URL::to('campuses/'.$campus->slug)}}">{{$campus->name}}</a></li>
    <li><a href="{{URL::to('campuses/'.$campus->slug)}}/{{$intake->slug}}">{{$intake->name}}</a></li>
    <li><a href="{{URL::to('campuses/'.$campus->slug)}}/{{$intake->slug}}/assignments">Assignments</a></li>
    @endsection
    @include('partials.breadcrumbs')
@endsection

@section('content')
<h1>{{$assignment->name}} ({{$assignment->code}})</h1>
@endsection
