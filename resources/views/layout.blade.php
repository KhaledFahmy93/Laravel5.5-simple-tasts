<!DOCTYPE html>

<html>
<head>
	<title>Laravel CRUD</title>
	<!-- <script src="{{asset('js/jquery-3.2.1.min.js.css')}}" ></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script> -->
	    <!-- Latest compiled and minified CSS -->
	
	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{!!asset('js/jquery-3.2.1.min.js')!!}"></script>

</head>

<body>


<div class="container">

    @yield('content')

</div>




</body>
</html>