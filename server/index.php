   <?php
      session_start();
      include('../connect/database.php');
      if(isset($_POST["admin_login"])){
         $login_name = $_POST['login_name'];
         $login_password = md5($_POST["login_password"]);
         if($login_name==''|| $login_password==''){
            echo '<script type="text/javascript">';
            echo ' alert("Username or password cannot be empty")';
            echo '</script>';
         }else{
            $sql_admin = mysqli_query($connect,"SELECT * FROM admin WHERE login_name='$login_name' AND login_password='$login_password'");
            $count = mysqli_num_rows($sql_admin);
            $fetch_admin = mysqli_fetch_array($sql_admin);
            if($count == 0){
               echo '<script type="text/javascript">';
               echo ' alert("Incorrect username or password")';
               echo '</script>';
            }else{
               $_SESSION['admin'] = $fetch_admin['first_name'];
               header('Location: dashboard.php');
            }
         }
      }
   ?>
<!DOCTYPE html>
<head>
   <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   <link href="admin-css/admin.css" rel="stylesheet" />
</head>
<body>
   <div class="sidenav">
      <div class="login-main-text">
         <h2>Login<br> as a Admin user</h2>
         <p>Please enter your login details.</p>
      </div>
   </div>
   <div class="main">
      <div class="col-md-6 col-sm-12">
         <div class="login-form">
            <form action="" method="POST">
               <div class="form-group">
                  <label>User Name</label>
                  <input type="text" class="form-control" placeholder="User Name" name="login_name">
               </div>
               <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" placeholder="Password" name="login_password">
               </div>
               <input type="submit" class="btn btn-black" name="admin_login" value="Login" />
            </form>
         </div>
      </div>
   </div>
</body>
</html>   