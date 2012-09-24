@layout('side-nav-content')

@section('title')
Attendance of {{$intake->name}}
@endsection

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('heading')
<h1>Attendance of {{$intake->name}}</h1>
@endsection

@section('main')
@endsection
