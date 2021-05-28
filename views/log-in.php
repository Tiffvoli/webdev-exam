 <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/components/top-nav-index.php'); ?>

 <section id="login" class="flex">
     <div class="herobanner flex-column">
         <h1 class="header">chipper.</h1>
     </div>
     <div id="login-page" class="login flex-column">
         <h1 class="title login-title">Log in</h1>
         <div class="radios">
             <input type="radio" id="user" name="account" onchange="checkAccount()" checked>
             <label for="admin">User
             </label>
             <input type="radio" id="admin" name="account" onchange="checkAccount()">
             <label for="admin">Admin
             </label>
         </div>

         <form id="form" action="/login" method="POST" onsubmit="return validate()" class="user_account">
             <div class="omrs-input-group">
                 <label class="omrs-input-filled" for="email">
                     <input required name="email" id="email" type="text" data-validate="email">
                     <span class="omrs-input-label">Email</span>
                 </label>
             </div>
             <div class="omrs-input-group">
                 <label class="omrs-input-filled" for="password">
                     <input required name="password" id="password" type="password" maxlength="50" data-validate="str" data-min="2" data-max="50">
                     <span class="omrs-input-label">Password</span>
                 </label>
             </div>
             <a href="/forgot" class="text-blue">Forgot password?</a>
             <button type="submit">Log in</button>
             <div class="btn"><a class="text-blue" href="/signup">Sign up </a></div>
         </form>
         <!-- admin form -->
         <form id="form" action="/admin" method="POST" onsubmit="return validate()" class="admin_account hide">
             <div class="omrs-input-group">
                 <label class="omrs-input-filled" for="email">
                     <input required name="email_admin" id="admin_email" type="text" data-validate="email">
                     <span class="omrs-input-label">Email</span>
                 </label>
             </div>
             <div class="omrs-input-group">
                 <label class="omrs-input-filled" for="password">
                     <input required name="password_admin" id="admin_password" type="password" maxlength="50" data-validate="str" data-min="2" data-max="50">
                     <span class="omrs-input-label">Password</span>
                 </label>
             </div>
             <button type="submit">Log in</button>
             <div class="btn"><a class="text-blue" href="/signup">Sign up </a></div>
         </form>
         <script>
             function checkAccount() {

                 const admin = document.querySelector("#admin");
                 const user = document.querySelector("#user");
                 const admin_account = document.querySelector(".admin_account");
                 const user_account = document.querySelector(".user_account");
                 if (admin.checked) {
                     admin_account.classList.remove("hide");
                     user_account.classList.add("hide");
                     console.log("admin");

                 } else {
                     admin_account.classList.add("hide");
                     user_account.classList.remove("hide");
                     console.log("user");
                 }
             }
         </script>
     </div>
 </section>

 <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php');
    ?>