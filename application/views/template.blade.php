<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width">

    <!-- Included CSS Files -->
    {{HTML::style('css/foundation.css')}}
    {{HTML::style('css/app.css')}}

    {{HTML::script('js/modernizr.foundation.js')}}
</head>
<body>
	<header>
	    <div class="row">
	        <div class="twelve columns">
		        <h1>Statisticular</h1>
		        <h4>Some spectacular statistics</h4>
		    </dev>
		</div>
	</header>
	
	@yield('breadcrumbs')

    <div role="main" class="main">
	    <div class="row">
	        <div class="twelve columns">
			    @yield('content')
		    </div>
		</div>
	</div>
	
	<footer>
	    <div class="row">
	        <div class="twelve columns">
        	    <p>Copyright &copy; 2012 Nikush Patel.</p>
        	</div>
	    </div>
	</footer>

	<!-- Included JS Files (Compressed) -->
    {{HTML::script('js/foundation.js')}}

    <!-- Initialize JS Plugins -->
    {{HTML::script('js/app.js')}}
</body>
</html>
