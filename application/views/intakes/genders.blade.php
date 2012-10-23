@layout('side-nav-content')

@section('title')
Genders of {{$intake->name}}
@endsection

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('heading')
<h1>Genders of {{$intake->name}}</h1>
@endsection

@section('main')
