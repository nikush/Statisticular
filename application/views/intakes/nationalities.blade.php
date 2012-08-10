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
        @yield('side-nav')
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
