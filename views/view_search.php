<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    *{
      margin: 0; padding: 0; box-sizing: border-box;
    }
    form{
      width: 100%;
      padding: 1rem;
    }
    input{
      width: 100%;
    }
    #search_results{
      width: 100%;
      max-height: 50vh;
      border: 1px solid black;
      overflow-y: scroll;
    }
  </style>
</head>
<body>
  
  <form onsubmit="return false">
    <input name="search_for" type="text" oninput="search()">
    <div id="search_results">
      <div class="search_result">
        AAA
      </div>
      <div class="search_result">
        BBB
      </div>
    </div>
  </form>

  <script>
    // People prof. exp. use this approach
    var search_timer // used to stop the search_timer
    function search(){
      if(search_timer){ clearTimeout(search_timer) }
      if(event.target.value.length >= 2){
        search_timer = setTimeout( function(){
        console.log("searching...")
        }, 500 )
      }
    }

    function show_results(){
      // display search_results div
      // populate/render the individual results
    }

    function hide_results(){
      // hide search_results div
    }

  </script>


</body>
</html>