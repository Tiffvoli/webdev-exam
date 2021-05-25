 <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/components/top-nav.php'); ?>

 <section id="login" class="flex">
     <div class="herobanner flex-column">
         <h1 class="header">chipper.</h1>
     </div>
     <div id="login-page" class="login flex-column">
         <h1 class="title login-title">Log in</h1>
         <form id="form" action="/login" method="POST" onsubmit="return validate()">
             <label for="email">Email<input name="email" id="email" type="text" placeholder="Enter your email" data-validate="email"></label>
             <label for="password">Password<input name="password" id="password" type="password" maxlength="50" data-validate="str" data-min="2" data-max="50" placeholder="Enter your password"></label>
             <button type="submit">Log in</button>
             <div class="btn">Sign up </div>
         </form>
     </div>
 </section>

 <?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/components/bottom-footer.php');
    ?>