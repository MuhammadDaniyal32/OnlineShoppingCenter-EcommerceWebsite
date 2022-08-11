
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
    <div id="logreg-forms">
        <form class="form-signin"  id="login_form" name="form1" method="post">
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Login</h1><br>
            <input type="email" id="email_log"  class="form-control" placeholder="Email address" required ><br>
            <input type="password" id="password_log"  class="form-control" placeholder="Password" required><br>
            <h4 class="h4 mb-3 font-weight-normal text-center">Solve Captcha</h3>
            <center><img src="generate_captcha.php"/></center>
            <br>
            <input type="text" class="form-control" id="captcha-in" name="captcha" onkeyup='check();' placeholder="Captcha" required/><br>
            
            <button type="submit" name="submit" id="butlogin" class="btn btn-success btn-block"><i class="fas fa-sign-in-alt"></i> Login</button><br>
            <!-- <div class="alert alert-success" role="alert"><em><?php echo $login_msg;?>/em></div> -->
                <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    </div>
                    <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    </div>            
            <h5 class="text-center">Don't have an account!</h5>
            <hr/> 
            <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Register</button>
            </form>
            
            <form method="post" id="signup_form" class="form-signup">
                <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Register</h1><br>
                <input type="text"     id="u_name" class="form-control validate" placeholder="Username" required><br>
                <input type="email"    id="u_email" class="form-control validate" placeholder="Email address" required><br>
                <input type="tel"      id="u_phone" class="form-control validate" placeholder="Phone" required><br>
                <input type="password" id="u_pass" onkeyup='checkpass();' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" onmouseover="this.type='text'" onmouseout="this.type='password'" class="form-control validate" placeholder="Password" required><br>
                <input type="password" id="u_repeatpass" onkeyup='checkpass();' onmouseover="this.type='text'" onmouseout="this.type='password'" class="form-control validate" placeholder="Repeat Password" required>
                <span id='message'></span>
                <br>

                <button class="btn btn-primary btn-block" id="butsave" type="submit"><i class="fas fa-user-plus"></i> Register</button><br>
                <div class="alert alert-success alert-dismissible" id="success-reg" style="display:none;">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    </div>
                    <div class="alert alert-danger alert-dismissible" id="error-reg" style="display:none;">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    </div><br>
                <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> Back</a>
            </form>
            <br>
            
    </div>

    </div>
  </div>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/function.js"></script>
    
<script type="text/javascript">

    //Checking Captcha
    var check = function(){
        var cap=$('#captcha-in').val();
        if (cap !="") {
            $("#butlogin").removeAttr("disabled");
            $("#error").hide();
            }
    else{
        $("#butlogin").attr("disabled", "disabled");
        $("#error").show();
        $('#error').html('Please solve captcha!');
    }
    }

    //Validating Password
    var checkpass = function() {
      if (document.getElementById('u_pass').value ==
        document.getElementById('u_repeatpass').value) {
        document.getElementById('message').style.color = 'green';
      document.getElementById('u_pass').style.border ="1px solid green";
      document.getElementById('u_repeatpass').style.border ="1px solid green";
        document.getElementById('message').innerHTML = 'Password Matched';
        document.getElementById('butsave').disabled = false;
      } 
      else {
        document.getElementById('u_pass').style.border ="1px solid red";
        document.getElementById('u_repeatpass').style.border ="1px solid red";
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'Password not Matched';
        document.getElementById('butsave').disabled = true;
      }
    }

    //Registering User
    $(document).ready(function() {
        $('#butsave').on('click', function(e) {
            e.preventDefault();
            var name = $('#u_name').val();
            var email = $('#u_email').val();
            var phone = $('#u_phone').val();
            var role = "User";
            var pass = $('#u_pass').val();
            if(name!="" && email!="" && phone!="" && pass!="" ){
                $.ajax({
                    url: "login_ajax.php",
                    type: "POST",
                    data: {
                        type: 1,
                        name: name,
                        email: email,
                        phone: phone,
                        role: role,
                        pass: pass                      
                    },
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            $("#butsave").removeAttr("disabled");
                            $('#signup_form').find('input').val('');
                            $("#success-reg").show();
                            $('#success-reg').html('Registration successful !');
                            $("#error-reg").hide();                        
                        }
                        else if(dataResult.statusCode==201){
                            $("#success-reg").hide(); 
                            $("#error-reg").show();
                            $('#error-reg').html('Email ID already exists !');
                        }
                        
                    }
                });
            }
            else{
                alert('Please fill all the field !');
            }
    });

    //Login User
    $('#butlogin').on('click', function(e) {
        e.preventDefault();
        var cap=$('#captcha-in').val();
        var email = $('#email_log').val();
        var password = $('#password_log').val();
        if(email!="" && password!="" && cap !=""){
            $.ajax({
                url: "login_ajax.php",
                type: "POST",
                data: {
                    type:2,
                    cap: cap,
                    email: email,
                    password: password                      
                },
                cache: false,
                success: function(dataResult){
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        $("#success").show();
                        $('#success').html('Login successful !');  
                        location.href = "index.php";                      
                    }
                    else if(dataResult.statusCode==201){
                        $("#error").show();
                        $('#error').html('Invalid Email Id or Password !');
                    }
                    else if(dataResult.statusCode==202){
                        $("#error").show();
                        $('#error').html('Captcha Not Solved !');
                    }
                    
                }
            });
        }
        else{
            alert('Please fill all the field !');
        }
    
    });
});

    </script>
</body>
</html>