@layout('template')

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('content')
<h1>{{$assignment->name}} ({{$assignment->code}})</h1>
@endsection
