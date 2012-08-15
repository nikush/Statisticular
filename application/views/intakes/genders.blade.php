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
<table>
    <thead>
        <tr>
            <th>Gender</th>
            <th>Students</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($genders as $gender => $students)
        <tr>
            <td>{{ $gender }}</td>
            <td>{{ $students }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
