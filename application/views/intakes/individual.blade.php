@layout('template')

@section('breadcrumbs')
    @section('crumbs')
    <li><a href="{{URL::to('/')}}">Home</a></li>
    <li><a href="{{URL::to('campuses')}}">Campuses</a></li>
    <li><a href="{{URL::to('campuses/'.$campus)}}">{{$campus}}</a></li>
    <li><a href="{{URL::to('campuses/'.$campus.'/intakes')}}">Intakes</a></li>
    @endsection
    @include('partials.breadcrumbs')
@endsection

@section('content')
<h1>{{$intake}}</h1>
@endsection
