<title>Goedeles First Laravel App</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../resources/coolTheme/css/main.css">

<script>
   function addLike(id) {
      var base_url = {!! json_encode(url('/')) !!}
      $.ajax({
         type:'POST',
         url: base_url + "/addlike/" + id, 
         data:{
          _token : $('meta[name="csrf-token"]').attr('content') ,
         },
         dataType: 'json',
         success:function(data) {
            $("#likes"+id).html(data.likes);
         },
         error: function (data, textStatus, errorThrown) {
              console.log(data);
          },
      });
   }
</script>

@stack('styles')
@stack('scripts')