@layout('side-nav-content')

@section('title')
Campuses
@endsection

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('heading')
<h1>Campuses</h1>
@endsection

@section('main')
<h3>Select a campus</h3>
<ul class="disc">
    @foreach($campuses as $campus)
    <li><a href="{{URL::to('campuses/'.$campus->slug)}}">{{$campus->name}}</a></li>
    @endforeach
</ul>
@endsection
