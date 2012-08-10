@layout('template')

@section('title')
Statisticular
@endsection

@section('content')
<h1>Welcome!</h1>
<div class="row">
    <div class="two columns">
        @yield('side-nav')
    </div>
    <div class="ten columns">
        <p>Statisticular is awesome like!</p>
    </div>
</div>
@endsection
