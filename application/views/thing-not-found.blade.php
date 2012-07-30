@layout('template')

@section('title')
{{Str::title($thing)}} not found
@endsection

@section('content')
<h1>{{Str::title($thing)}} '{{$name}}' cannot be found</h1>
<p>Oh noes! The {{$thing}} you are looking for can&apos;t be found on the system.</p>
<p>Try looking through the <a href="{{$url}}">list of {{Str::plural($thing)}}</a> on the system to see if you can find it in there.</p>
@endsection
