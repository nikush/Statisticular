@layout('template')

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('content')
<h1>{{$intake}}</h1>
<div class="row">
    <div class="two columns">
        @yield('side-nav')
    </div>
    <div class="ten columns">
        <ul class="disc">
            @foreach($students as $student)
            <li><a href="{{URL::current().'/'.$student->id}}">{{$student->get_full_name()}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
