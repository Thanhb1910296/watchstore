    <?php
        //customer login
        if(isset($_POST['login'])){     
            $login_name = $_POST['login_name'];
            $login_password = $_POST['login_password'];
            //empty
            if($login_name=='' || $login_password==''){
                echo '<script type="text/javascript">';
                echo ' alert("Username or password cannot be empty")';
                echo '</script>';
            }
            //not empty  
            else{
                $sql_account = mysqli_query($connect, "Select * from customers WHERE login_name='$login_name' AND login_password='$login_password'");
                $count = mysqli_num_rows($sql_account);
                
                //wrong
                if($count == 0){
                    echo '<script type="text/javascript">';
                    echo ' alert("Incorrect username or password")';
                    echo '</script>';
                }
                //right
                else{
                    $fetch_account = mysqli_fetch_array($sql_account);
                    $_SESSION['customer'] = $fetch_account['customer_id'];
                    $_SESSION['login_name'] = $fetch_account['login_name'];
                    $sql_del = mysqli_query($connect, "DELETE FROM order_items WHERE order_id IS NULL");
                    echo '<meta http-equiv="refresh" content= "0;URL=index.php?part=list" />';   
                }
            }
        }
    ?>
    
    <form method="POST">
        <div class="form-sign">
            <div class="form-container">
                <div class="form-header">
                    <h3 class="form-title"> Sign in </h3>
                    <a href="?part=sign_up" style="padding-right:12px; padding-top:12px; font-size:18px; color:red"> Sign up </a>
                </div>

                <div class="form-main">
                    <div class="form-input"> 
                        <input type="text" placeholder="Enter your username" name="login_name">
                    </div>
                    <div class="form-input"> 
                        <input type="password" placeholder="Enter your password" name="login_password">
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
                    <button type="submit" class="btn-sign" name="login"> Login </button>
                </div>
            </div>
        </div>
    </form>