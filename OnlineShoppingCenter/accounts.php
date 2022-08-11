<?php
    require 'admin_access.php';
    require_once "config.php";

    //Adding User

    if (isset($_POST['Add'])) {
      $uname=$_POST['name'];
      $email=$_POST['email'];
      $password=$_POST['password'];
      $phone=$_POST['phone'];
      $email=$_POST['email'];
      $role=$_POST['role'];

      $image_name = $_FILES['user_image']['name'];
      $image_temp = $_FILES['user_image']['tmp_name'];
      $time = time();
      $path = "images/".$time.$image_name;

      if(move_uploaded_file($image_temp, $path))
      {
      $query="INSERT INTO `user_tbl`(`Username`, `Password`, `Email`, `User_image`, `User_role`, `phoneNo`) VALUES ('$uname','$password','$email','$path','$role','$phone')";
      $RUN=mysqli_query($con,$query);
      if ($RUN) {
      echo '<script> alert("Data Saved!"); </script>';
      header('Location: accounts.php');
      }
      else{
      echo '<script> alert("Data not Saved!"); </script>';
      }
      } 
    }

    //Fetching User

    if (isset($_GET['id'])) {
      $id=$_GET['id'];
      $query=mysqli_query($con,"SELECT * FROM user_tbl WHERE User_id='$id'");
      while ($row = mysqli_fetch_assoc($query)) {
      $name=$row['Username'];
      $password=$row['Password'];
      $img=$row['User_image'];
      $Email=$row['Email'];
      $role=$row['User_role'];
      $phone=$row['phoneNo'];
    }
    }
    $sql = "SELECT * FROM user_tbl";
    $result = $con->query($sql);
    $arr_users = [];
    if ($result->num_rows > 0) {
        $arr_users = $result->fetch_all(MYSQLI_ASSOC);
    }

    //Updating User
    if (isset($_POST['Update'])) {
      $uname=$_POST['name'];
      $email=$_POST['email'];
      $password=$_POST['password'];
      $phone=$_POST['phone'];
      $email=$_POST['email'];
      $role=$_POST['role'];
      $u_id=$_POST['u_Id'];


      $image_name = $_FILES['user_image']['name'];
      $image_temp = $_FILES['user_image']['tmp_name'];
      $time = time();
      $path = "images/".$time.$image_name;
      if(move_uploaded_file($image_temp, $path))
      {
      $query="UPDATE user_tbl SET Username='$uname',Password='$password',Email='$email',User_image='$path',User_role='$role',phoneNo='$phone'  WHERE User_id=$u_id";
      $RUN=mysqli_query($con,$query);
      if ($RUN) {
      echo '<script> alert("Data Saved!"); </script>';
      header('Location: accounts.php');
      }
      else{
      echo '<script> alert("Data not Saved!"); </script>';
      }
      }
      else
      {
        $query="UPDATE user_tbl SET Username='$uname',Password='$password',Email='$email',User_role='$role',phoneNo='$phone'  WHERE User_id=$u_id";
      $RUN=mysqli_query($con,$query);
      if ($RUN) {
      echo '<script> alert("Data Saved!"); </script>';
      header('Location: accounts.php');
      }
      else{
      echo '<script> alert("Data not Saved!"); </script>';
      }
      } 
    }

    //Deleteing User

    if (isset($_POST['Deleterecored'])) {
    $id=$_POST['id'];
    $result = mysqli_query($con, "DELETE FROM user_tbl WHERE User_id=$id");
    header('location:accounts.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="ie=edge" />
      <title>Admin Accounts</title>
      <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Roboto:400,700"
        />
        <!-- https://fonts.google.com/specimen/Roboto -->
        <link rel="stylesheet" href="css/fontawesome.min.css" />
        <!-- https://fontawesome.com/ -->
        <link rel="stylesheet" href="css/bootstrap_admin.min.css" />
        <!-- https://getbootstrap.com/ -->
        <link rel="stylesheet" href="css/style_admin.css">
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>

        <!--
          Product Admin CSS Template
          https://templatemo.com/tm-524-product-admin
        -->

  </head>
    <style >
       .makeRed{
      border-bottom: 1px solid red !important;
    }
    </style>
    <body id="reportsPage">
      <div class="" id="home">
        <nav class="navbar navbar-expand-xl">
              <div class="container h-100">
                <a class="navbar-brand" href="accounts.php">
                  <h1 class="tm-site-title mb-0">Accounts Admin</h1>
                </a>
                <button
                  class="navbar-toggler ml-auto mr-0"
                  type="button"
                  data-toggle="collapse"
                  data-target="#navbarSupportedContent"
                  aria-controls="navbarSupportedContent"
                  aria-expanded="false"
                  aria-label="Toggle navigation"
                >
                  <i class="fas fa-bars tm-nav-icon"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mx-auto h-100">
                    <li class="nav-item">
                      <a class="nav-link" href="dashboard.php">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                        <span class="sr-only">(current)</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="products.php">
                        <i class="fas fa-shopping-cart"></i> Products
                      </a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link active" href="accounts.php">
                        <i class="far fa-user"></i> Accounts
                      </a>
                    </li>
                  </ul>
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link d-block" href="Logout.php">
                       <?php echo$_SESSION['Username'];?>, <b>Logout</b>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
        <div class="container mt-5">
          <div class="row tm-content-row">
            <div class="col-12 tm-block-col">
              <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
              <table id="userTable" class="display table-bordered hover">
                      <thead>
                          <th>Username</th>
                          <th>Password</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Role</th>
                          <th></th>
                      </thead>
                      <tbody>
                          <?php if(!empty($arr_users)) { ?>
                              <?php foreach($arr_users as $user) { ?>
                                  <tr>
                                      <td><?php echo $user['Username']; ?></td>
                                      <td><?php if($user['User_role']=="Admin"){echo $user['Password'];}else{echo"*******";} ?></td>
                                      <td><?php echo $user['Email']; ?></td>
                                      <td><?php echo $user['phoneNo']; ?></td>
                                      <td><?php echo $user['User_role']; ?></td>
                                      <?php if($user['User_role']=="Admin"){echo"<td><a href=accounts.php?id=".$user['User_id'].">Edit</a></td>";}else{echo"<td></td>";}?>
                                      
                                  </tr>
                              <?php } ?>
                          <?php } ?>
                      </tbody>
                  </table>
              </div>
            </div>
          </div>
          <!-- row -->
          <form method="POST" action="accounts.php" enctype="multipart/form-data">
          <div class="row tm-content-row">
            <div class="tm-block-col tm-col-avatar">
              <div class="tm-bg-primary-dark tm-block tm-block-avatar">
                <h2 class="tm-block-title">Change Avatar</h2>

                <div class="tm-avatar-container">
                            <img class="tm-avatar img-fluid mb-4" src="<?php if(isset($img)){echo $img;} else{echo"\OnlineShoppingCenter\images\user.png";} ?>" id="no_img">
                            <br>
                            <div class="fileupload btn">
                              <span class="btn-text btn-primary btn-block text-uppercase">edit</span>
                              <input class="upload" type="file" id="input_file" name="user_image" accept="image/png,image/jpeg,image/jpg">
                            </div>
                          </div>
              </div>
            </div>
            <div class="tm-block-col tm-col-account-settings">
              <div class="tm-bg-primary-dark tm-block tm-block-settings">
                <h2 class="tm-block-title">Account Settings</h2>
                <div class="tm-signup-form row">
                  <div class="form-group col-lg-6">
                    <label>Username</label>
                    <input
                    id="name"
                    name="name"
                    type="text"
                    value="<?php if(isset($name)){echo $name;} ?>"
                    class="form-control validate"
                    required
                    />
                  </div>
                  <div class="form-group col-lg-6">
                    <label>Email</label>
                    <input
                    id="email"
                    name="email"
                    type="email"
                    class="form-control validate"
                    value="<?php if(isset($name)){echo $Email;} ?>"
                    required
                    />
                  </div>
                  <div class="form-group col-lg-6">
                    <label>Password</label>
                    <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-control validate"
                    value="<?php if(isset($name)){echo $password;} ?>"
                    onkeyup='check();'
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                    required
                    onmouseover="this.type='text'"
                    onmouseout="this.type='password'"
                    />
                  </div>
                  <div class="form-group col-lg-6">
                    <label>Re-enter Password</label>
                    <input
                    id="password2"
                    name="password2"
                    type="password"
                    value="<?php if(isset($name)){echo $password;} ?>"
                    class="form-control validate"
                    onkeyup='check();'
                    required
                    onmouseover="this.type='text'"
                    onmouseout="this.type='password'"
                    />
                    <span id='message'></span>
                  </div>
                  <div class="form-group col-lg-6">
                    <label>Phone</label>
                    <input
                    id="phone"
                    name="phone"
                    value="<?php if(isset($name)){echo $phone;} ?>"
                    type="tel"
                    class="form-control validate"
                    required
                    />
                  </div>
                  <div class="form-group col-lg-6">
                    <label>Role</label>
                    <select class="form-control" name="role">
                      <option value="User" <?php if(isset($role)){ if($role=="User"){echo "selected";}}?> >User</option>
                      <option value="Admin" <?php if(isset($role)){ if($role=="Admin"){echo "selected";}}?> >Admin</option>
                    </select>
                  </div>
                  <input type="hidden" name="u_Id" value=<?php if(isset($id)){echo $id;}?>>
                  <div class="col-12">
                    <input type="submit" id="Add" name="Add" value="Add New User" class="btn btn-success btn-block text-uppercase" style="<?php if(isset($id)){echo "display: none;";}?>" ></input>

                    <input type="submit" id="Update" name="Update" value="Update User" class="btn btn-info btn-block text-uppercase" style="<?php if(isset($id)){echo "display: block;";} else{echo "display: none;";}?>" ></input>

                <button type="button" class="btn btn-primary btn-block text-uppercase" data-toggle="modal" data-target="#myModal"
                style="<?php if(isset($id)){echo "display: block;";} else{echo "display: none;";}?>">
                  Delete User
                </button>
              </div>
              </div>
              </div>
            </div>
          </div>
  </form>

<form action="accounts.php" method="POST">
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Delete This User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" name="Deleterecored" value="Deleterecored" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
          <input type="hidden" name="id" value=<?php echo $id;?>>
          <button type="button" name="no" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
        </div>

      </div>
    </div>
  </div>
</form>
        </div>
      </div>
      <script src="js/jquery-3.3.1.min.js"></script>
      <!-- https://jquery.com/download/ -->
      <script src="js/bootstrap_admin.min.js"></script>
          <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
          <script>
          $(document).ready(function() {
              $('#userTable').DataTable( {

        dom: 'Pfrtip',
        columnDefs:[
            {
                searchPanes: {
                    controls: false,
                },
                targets: [4]
            }
        ]
    });
});

          </script>
      <!-- https://getbootstrap.com/ -->
      <script type="text/javascript">

        var check = function() {
          if (document.getElementById('password').value ==
            document.getElementById('password2').value) {
            document.getElementById('message').style.color = 'green';
          document.getElementById('password').style.border ="1px solid green";
          document.getElementById('password2').style.border ="1px solid green";
            document.getElementById('message').innerHTML = 'Password Matched';
            document.getElementById('submit').disabled = false;
          } 
          else {
            document.getElementById('password').style.border ="1px solid red";
            document.getElementById('password2').style.border ="1px solid red";
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Password not Matched';
            document.getElementById('submit').disabled = true;
          }
        }


      $('#input_file').change(function () {
      if (this.files && this.files[0]) {
      var reader = new FileReader();
      reader.readAsDataURL(this.files[0]);
      reader.onload = function (x) {
      $('#no_img').attr('src', x.target.result);
      }
      }
      });
      </script>
    </body>
  </html>