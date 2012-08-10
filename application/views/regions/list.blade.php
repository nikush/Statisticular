@layout('side-nav-content')

@section('title')
Regions
@endsection

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('heading')
<h1>Regions</h1>
@endsection

@section('main')
<ul class="disc">
    @foreach($regions as $region)
    <li><a href="{{URL::to('regions/'.$region->slug)}}">{{$region->name}}</a></li>
    @endforeach
</ul>
@endsection
