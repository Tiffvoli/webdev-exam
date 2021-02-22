function validate(){
  // console.log(event.target)
  const frm = event.target

  // Clear errors
  all("[data-validate]").forEach(element=>{
    element.classList.remove("error")
  })

  let min
  let max

  all("[data-validate]").forEach( element => {
    
    switch(element.getAttribute("data-validate")){ // str | int

      case "str":
        min = element.getAttribute("data-min")
        max = element.getAttribute("data-max")
        let total_characters = element.value.length
        console.log(total_characters)
        if( total_characters < min ||  total_characters > max){
          element.classList.add("error")      
        }
      break
      case "int":
        console.log("validate phone")
        min = parseInt(element.getAttribute("data-min")) // number
        max = parseInt(element.getAttribute("data-max")) // number
        let phone = parseInt(element.value)
        if( ! phone || phone < min || phone > max ){
          element.classList.add("error")     
        }
      break
      case "email":
        const re = /^[a-z0-9]+[\._]?[a-z0-9]+[@]\w+[.]\w{2,3}$/
        if( ! re.test(element.value.toLowerCase()) ){ 
          element.classList.add("error")
        }
      break
    }
  })

}

function clear_error(){
  event.target.classList.remove("error")
}



function one(selector){ return document.querySelector(selector)}
function all(selector){return document.querySelectorAll(selector)}
