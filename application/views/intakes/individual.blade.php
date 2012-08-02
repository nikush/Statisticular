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
            <li><a href="#">Assignments</a></li>
            <li><a href="#">Students</a></li>
            <li class="divider"></li>
            <li>Stats for this intake</li>
        </ul>
    </div>
    <div class="ten columns">
    </div>
</div>
@endsection
