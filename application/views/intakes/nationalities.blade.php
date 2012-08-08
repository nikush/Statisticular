@layout('template')

@section('title')
Nationalities of {{$intake->name}}
@endsection

@section('breadcrumbs')
    @include('partials.breadcrumbs')
@endsection

@section('content')
<h1>Nationalites of {{$intake->name}}</h1><div class="row">
    <div class="two columns">
        <ul class="side-nav">
            <li><a href="{{dirname(URL::current())}}">Students</a></li>
            <li><a href="{{dirname(URL::current())}}/assignments">Assignments</a></li>
            <li class="divider"></li>
            <li class="active"><a href="{{URL::current()}}">Nationalities</a></li>
        </ul>
    </div>
    <div class="ten columns">
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
    </div>
</div>

@endsection
