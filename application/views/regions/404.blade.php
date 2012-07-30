@layout('template')

@section('title')
Region not found
@endsection

@section('content')
<h1>Region '{{$name}}' cannot be found</h1>
<p>Oh noes! The region you are looking for can&apos;t be found on the system.</p>
<p>Try looking through the <a href="{{URL::to('regions')}}">list of regions</a> on the system to see if you can find it in there.</p>
@endsection
