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
<table>
    <tr>
        <th>Nationality</th>
        <th>Students</th>
    </tr>
    @foreach($nationalities as $nationality)
    <tr>
        <td>{{$nationality->nationality_name}}</td>
        <td>{{$nationality->students}}</td>
    </tr>
    @endforeach
</table>
@endsection
