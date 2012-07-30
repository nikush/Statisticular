@layout('template')

@section('title')
Campuses
@endsection

@section('breadcrumbs')
    @section('crumbs')
    <li><a href="{{URL::to('/')}}">Home</a></li>
    @endsection
    @include('partials.breadcrumbs')
@endsection

@section('content')
<h1>Campuses</h1>
<ul class="disc">
@foreach($campuses as $campus)
<li><a href="{{URL::to('campuses/'.Str::lower($campus->name))}}">{{$campus->name}}</a></li>
@endforeach
</ul>
@endsection
