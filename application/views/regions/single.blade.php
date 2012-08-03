@layout('template')

@section('breadcrumbs')
    @section('crumbs')
    <li><a href="{{URL::to('/')}}">Home</a></li>
    <li><a href="{{URL::to('regions')}}">Regions</a></li>
    @endsection
    @include('partials.breadcrumbs')
@endsection

@section('content')
<h1>{{$region->name}}</h1>
@endsection
