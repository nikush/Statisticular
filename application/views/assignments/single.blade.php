@layout('side-nav-content')

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('heading')
<h1>{{$assignment->name()}} ({{$assignment->code()}})</h1>
@endsection

@section('main')
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Grade</th>
        </tr>
    </thead>
    <tbody>
        @foreach($assignment->grades() as $student)
        <tr>
            <td>{{$student->id}}</td>
            <td>{{$student->name}}</td>
            <td>{{$student->grade}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection