@layout('side-nav-content')

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('heading')
<h1>{{$intake}}</h1>
@endsection

@section('main')
<ul class="disc">
    @foreach($students as $student)
    <li><a href="{{URL::current().'/'.$student->id}}">{{$student->get_full_name()}}</a></li>
    @endforeach
</ul>
@endsection
