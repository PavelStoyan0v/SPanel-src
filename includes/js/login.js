$(".form-login").submit(function(e){
    e.preventDefault();
});

$(".form-alert").hide();
$('.btn-lg').click(function () {
  var email = $("input[name='username']").val();
  var password = $("input[name='password']").val();
  var rememberinput = $("input[name='remember']").is(':checked');
  if(rememberinput){
    var remember = 1;
  }else{
    var remember = 0
  }
  $.post("loginfunctionality",
    {
        email: email,
        password: password,
        remember: remember
    },
    function(data, status){
      if(data == "true"){
        location.href = "../";
      }else if(data == "teacher"){
        location.href = "http://teachers.spanel.pw"

      }else{
        $(".form-alert").show();
          location.href = "../../"
      }
  });

});
