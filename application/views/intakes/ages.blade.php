@layout('side-nav-content')

@section('title')
Ages of {{$intake->name}}
@endsection

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('heading')
<h1>Ages of {{$intake->name}}</h1>
@endsection

@section('main')
