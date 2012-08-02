@layout('template')

@section('title')
Campuses
@endsection

@section('breadcrumbs')
    @section('crumbs')
    <li><a href="{{URL::to('/')}}">Home</a></li>
    @endsection
    @include('partials.breadcrumbs')
@endsection

@section('content')
<h1>Campuses</h1>
<div class="row">
    <div class="two columns">
        <ul class="side-nav">
            <li class="active"><a href="{{URL::to('campuses')}}">Campuses</a></li>
            <li><a href="{{URL::to('regions')}}">Regions</a></li>
        </ul>
    </div>
    <div class="ten columns">
        <h3>Select a campus</h3>
        <ul class="disc">
            @foreach($campuses as $campus)
            <li><a href="{{URL::to('campuses/'.Str::lower($campus->name))}}">{{$campus->name}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
