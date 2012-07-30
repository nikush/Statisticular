@layout('template')

@section('title')
Regions
@endsection

@section('content')
<h1>Regions</h1>
<ul class="disc">
@foreach($regions as $region)
<li><a href="{{URL::to('regions/'.Str::lower($region->name))}}">{{$region->name}}</a></li>
@endforeach
</ul>
@endsection
