@layout('template')

@section('title')
Intakes for {{$campus}}
@endsection

@section('breadcrumbs')
    @section('crumbs')
    <li><a href="{{URL::to('/')}}">Home</a></li>
    <li><a href="{{URL::to('campuses')}}">Campuses</a></li>
    <li><a href="{{URL::to('campuses/'.$campus)}}">{{$campus}}</a></li>
    @endsection
    @include('partials.breadcrumbs')
@endsection

@section('content')
<h1>Intakes for {{$campus}}</h1>
<ul class="disc">
@foreach($intakes as $intake)
<li><a href="{{URL::current().'/'.Str::lower($intake->name)}}">{{$intake->name}}</a></li>
@endforeach
</ul>
@endsection
