const admin_email = "tiffany@gmail.com";
const admin_pass = "tiffany";
const admin_name = "Tiffany";

function validate_admin() {
  const pass_field = document.querySelector("#admin_password");
  const email_field = document.querySelector("#admin_email");
  console.log(admin_email);
  console.log(admin_pass);

  if (email_field.value == admin_email && pass_field.value == admin_pass) {
    console.log("correct admin info");
    return true;
  } else {
    console.log("incorrect admin info");
    email_field.classList.add("validate_error");
    pass_field.classList.add("validate_error");
    return false;
  }
}

document.querySelector(".admin_name").innerHTML = admin_name;
