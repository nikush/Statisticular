@layout('side-nav-content')

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('heading')
<h1>{{$assignment->name()}} ({{$assignment->code()}})</h1>
@endsection

@section('main')
@endsection
