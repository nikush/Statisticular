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
<table>
    <tr>
        <th>Age</th>
        <th>Students</th>
    </tr>
    @foreach($ages as $group => $students)
    <tr>
        <td>{{ $group }}</td>
        <td>{{ $students }}</td>
    </tr>
    @endforeach
</table>
@endsection
