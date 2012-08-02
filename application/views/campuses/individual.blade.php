@layout('template')

@section('breadcrumbs')
    @section('crumbs')
    <li><a href="{{URL::to('/')}}">Home</a></li>
    <li><a href="{{URL::to('campuses')}}">Campuses</a></li>
    @endsection
    @include('partials.breadcrumbs')
@endsection

@section('content')
<h1>{{$campus_name}}</h1>
<div class="row">
    <div class="two columns">
        <ul class="side-nav">
            <li class="active"><a href="{{URL::current().'/intakes'}}">Intakes</a></li>
            <li class="divider"></li>
            <li>Stats for this campus</li>
        </ul>
    </div>
    <div class="ten columns">
        <ul class="disc">
            @foreach($intakes as $intake)
            <li><a href="{{URL::current().'/'.$intake->slug}}">{{$intake->name}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
