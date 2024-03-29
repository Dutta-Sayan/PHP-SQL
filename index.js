$(document).ready(function(){

  $(".user-registration-form").submit(function(e){
    let username = $(".username").val();
    let email = $(".email").val();
    let password = $(".password").val();

    let errStatus = true;
    if(username.length == 0 || email.length == 0 || password.length == 0) {
      $(".input-err").text("*Empty fields present");
      errStatus = false;
    }
    else if (!username.match(/(^[a-zA-Z_ ]{1,25}$)/)) {
      $(".input-err").text("*Invalid username pattern");
      errStatus = false;
    }
    else if(!email.match(/(^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$)/)) {
      $(".input-err").text("*Invalid email!");
      errStatus = false;
    }
    if (errStatus == false) {
      e.preventDefault();
    }
  });
});