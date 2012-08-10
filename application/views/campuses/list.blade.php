@layout('template')

@section('title')
Campuses
@endsection

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('content')
<h1>Campuses</h1>
<div class="row">
    <div class="two columns">
        @yield('side-nav')
    </div>
    <div class="ten columns">
        <h3>Select a campus</h3>
        <ul class="disc">
            @foreach($campuses as $campus)
            <li><a href="{{URL::to('campuses/'.$campus->slug)}}">{{$campus->name}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
