<!doctype html>
<html>
<head>
   @include('includes.head')
</head>
<body class="bg-light">
<div class="container">
   <header class="row">
       @include('includes.header')
   </header>
   <div id="main" class="container mb-5">
           @yield('content')
   </div>
   <footer class="row">
       @include('includes.footer')
   </footer>
</div>
</body>
</html>