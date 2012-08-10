@layout('side-nav-content')

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('heading')
<h1>{{$student->get_full_name()}} ({{$student->id}})</h1>
@endsection
