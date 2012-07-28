@layout('template')

@section('title')
Campuses
@endsection

@section('content')
<h1>Campuses</h1>
<ul class="disc">
@foreach($campuses as $campus)
<li><a href="{{URL::to('campuses/'.Str::lower($campus->name))}}">{{$campus->name}}</a></li>
@endforeach
</ul>
@endsection
