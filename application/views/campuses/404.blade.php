@layout('template')

@section('title')
Campus not found
@endsection

@section('content')
<h1>Campus '{{$name}}' cannot be found</h1>
<p>Oh noes! The campus you are looking for can&apos;t be found on the system.</p>
<p>Try looking through the <a href="{{URL::to('campuses')}}">list of campuses</a> on the system to see if you can find it in there.</p>
@endsection
