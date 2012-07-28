@layout('template')

@section('title')
Intakes for {{$campus}}
@endsection

@section('content')
<h1>Intakes for {{$campus}}</h1>
<ul class="disc">
@foreach($intakes as $intake)
<li><a href="{{URL::current().'/'.Str::lower($intake->name)}}">{{$intake->name}}</a></li>
@endforeach
</ul>
@endsection
