@layout('side-nav-content')

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('heading')
<h1>{{$campus_name}}</h1>
@endsection

@section('main')
<ul class="disc">
    @foreach($intakes as $intake)
    <li><a href="{{URL::current().'/'.$intake->slug}}">{{$intake->name}}</a></li>
    @endforeach
</ul>
@endsection
