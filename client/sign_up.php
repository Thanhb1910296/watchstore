    <?php
        if(isset($_POST['register'])){     
            $new_login_name = $_POST['new_login_name'];
            $new_login_password = $_POST['new_login_password'];
            $confirm_password = $_POST['confirm_password'];              
            //mark
            $mark = 0;
            if($new_login_password != $confirm_password){
                $mark = 1;  
            }
            $sql_account = mysqli_query($connect, "Select * from customers WHERE login_name='$new_login_name'");
            $count = mysqli_num_rows($sql_account);
            // 1 = success, 2 = exist, 3 = not match 
            if($count == 0 && $mark == 0){
                $sql_create_account = mysqli_query($connect, "INSERT INTO customers(login_name, login_password) VALUES ('$new_login_name', '$new_login_password')");
                echo '<script type="text/javascript">';
                echo ' alert("Your account has been successfully created")';
                echo '</script>';
                echo '<meta http-equiv="refresh" content= "0;URL=index.php?part=sign_in" />';  
            } elseif($count == 1 && $mark == 0){
                echo '<script type="text/javascript">';
                echo ' alert("This account already exist")';
                echo '</script>';
            }elseif($count == 0 && $mark == 1){
                echo '<script type="text/javascript">';
                echo ' alert("Password and confirm password does not match")';
                echo '</script>';
            } else{
                echo '<script type="text/javascript">';
                echo ' alert("Something wrong")';
                echo '</script>';
            }       
        }    
    ?>
    <form method="POST">
        <div class="form-sign">
            <div class="form-container">
                <div class="form-header">
                    <h3 class="form-title"> Sign up </h3>
                    <a href="?part=sign_in" style="padding-right:12px; padding-top:12px; font-size:18px; color:red"> Sign in </a>
                </div>

                <div class="form-main">
                    <div class="form-input"> 
                        <input type="text" placeholder="Enter your username" name="new_login_name" required="required">
                    </div>
                    <div class="form-input"> 
                        <input type="password" placeholder="Enter your password" name="new_login_password" required="required">
                    </div>
                    <div class="form-input"> 
                        <input type="password" placeholder="Re-enter password" name="confirm_password" required="required">
                    </div>
                </div>

                <div class="form-aside">
                    <p class="form-policy"> 
                        <input type="checkbox">
                        I have read and agree to the privacy terms
                    </p>
                </div>

                <div class="form-controls">
                    <button class="btn-back"> <a href="index.php"> Back </a> </button>
                    <button class="btn-sign" name="register"> Register </button>
                </div>
            </div>
        </div>
    </form>
