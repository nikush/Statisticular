@layout('template')

@section('title')
Regions
@endsection

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('content')
<h1>Regions</h1>
<div class="row">
    <div class="two columns">
        @yield('side-nav')
    </div>
    <div class="ten columns">
        <ul class="disc">
            @foreach($regions as $region)
            <li><a href="{{URL::to('regions/'.$region->slug)}}">{{$region->name}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
