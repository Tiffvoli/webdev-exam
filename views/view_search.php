<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    form {
      width: 100%;
      padding: 1rem;
    }

    input {
      width: 100%;
    }

    #search_results {
      display: none;
      width: 100%;
      max-height: 50vh;
      border: 1px solid black;
      overflow-y: scroll;
    }
  </style>
</head>

<body>

  <form onsubmit="return false">
    <input name="search_for" type="text" oninput="search()" onfocus="show_results()" onblur="hide_results()">
    <div id="search_results"></div>
  </form>
  <script>
    // People prof. exp. use this approach
    var search_timer // used to stop the search_timer
    function search() {
      if (search_timer) {
        clearTimeout(search_timer)
      }
      if (event.target.value.length >= 2) {
        search_timer = setTimeout(async function() {
          let conn = await fetch('/search', {
            method: "POST",
            body: new FormData(document.querySelector("form"))
          })
          if (!conn.ok) {
            alert('uppps....')
          }
          let users = await conn.json()
          console.log(users)
          // populate the results
          document.querySelector("#search_results").innerHTML = ""
          users.forEach(user => {
            let user_div = `
          <div class="search_result">
            ${user.user_name} ${user.user_last_name}
          </div>`
            document.querySelector("#search_results").insertAdjacentHTML('beforeend', user_div)
          })
          show_results()
        }, 500)
      } else {
        hide_results()
      }
    }

    function show_results() {
      document.querySelector("#search_results").style.display = "grid"
      // display search_results div
      // populate/render the individual results
    }

    function hide_results() {
      // hide search_results div
      document.querySelector("#search_results").style.display = "none"
    }
  </script>
</body>

</html>