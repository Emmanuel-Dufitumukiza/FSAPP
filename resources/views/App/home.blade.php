<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    body{
        /* overflow: hi */
    }
    </style>
</head>
<body>
   {{-- @extends("App.upload") --}}
   @extends("App.navbar")

   <script>
   function sendReq(){
    var str = "Emmy"
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          alert(this.responseText)
      }
    };
    xmlhttp.open("GET", "{{ route('upload') }}?q=" + str, true);
    xmlhttp.send();
   }
   </script>
</body>
</html>
