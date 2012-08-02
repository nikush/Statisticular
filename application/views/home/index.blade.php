@layout('template')

@section('title')
Statisticular
@endsection

@section('content')
<h1>Welcome!</h1>
<div class="row">
    <div class="two columns">
        <ul class="side-nav">
            <li><a href="{{URL::to('campuses')}}">Campuses</a></li>
            <li><a href="{{URL::to('regions')}}">Regions</a></li>
        </ul>
    </div>
    <div class="ten columns">
        <p>Statisticular is awesome like!</p>
    </div>
</div>
@endsection
