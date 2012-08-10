@layout('template')

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('content')
<h1>{{$campus_name}}</h1>
<div class="row">
    <div class="two columns">
        @yield('side-nav')
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
