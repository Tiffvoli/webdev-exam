<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>

  <form onsubmit="return false">
    <input name="search_for" type="text" oninput="search()">
  </form>

  <script>
    var timer

    function search() {
      if (timer) {
        clearTimeout(timer)
      }
      timer = setTimeout(function() {
        console.log("searching...")
      }, 1000)

    }
  </script>


</body>

</html>