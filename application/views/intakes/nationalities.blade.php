@layout('side-nav-content')

@section('title')
Nationalities of {{$intake->name}}
@endsection

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('heading')
<h1>Nationalites of {{$intake->name}}</h1>
@endsection

@section('main')
