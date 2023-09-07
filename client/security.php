    <?php 
        $assign_id = $_SESSION['customer'];
        $customer = mysqli_query($connect, "SELECT * FROM customers WHERE customer_id = '$assign_id'");
        $fetch_customer = mysqli_fetch_array($customer);
        if(isset($_POST['change'])){
            $login_password = $_POST['login_password'];
            $new_password = $_POST['new_password'];
            $re_password = $_POST['re_password'];       
            $sql_check_password = mysqli_query($connect, "SELECT * FROM customers WHERE customer_id = '$assign_id' AND login_password = '$login_password'");
            $count = mysqli_num_rows($sql_check_password);
            if($count == 0 ){
                echo '<script type="text/javascript">';
                echo ' alert("Old password incorrect !")';
                echo '</script>';
                echo '<meta http-equiv="refresh" content= "0;URL=index.php?part=security"/>';
            } elseif($new_password != $re_password){
                echo '<script type="text/javascript">';
                echo ' alert("Password and comfirm password does not match !")';
                echo '</script>';
                echo '<meta http-equiv="refresh" content= "0;URL=index.php?part=security"/>';
            } else{
                $sql_update_password = mysqli_query($connect, "UPDATE customers SET login_password = '$new_password' WHERE customer_id = '$assign_id'");
                echo '<script type="text/javascript">';
                echo ' alert("Update complete !")';
                echo '</script>';
                echo '<meta http-equiv="refresh" content= "0;URL=index.php?part=profile"/>';
            }
        }
    ?>
    <form method="POST">
        <section class="profile-main">
            <div class="profile-container">
                <div class="profile-title">
                    <h1> Your Profle  </h1>
                </div>
                <div class="profile-infor">
                    <div class="profile-infor-left">
                        <div class="profile-infor-image">
                            <img src="assets/img/user.jpg">
                        </div>
                        <div class="profile-infor-link">
                        <p style="padding-left:50px; font-weight:bold; font-size:22px; color: blue"> <?php echo $fetch_customer['first_name'] ?> </p>
                            <a href="?part=profile"> Profile </a>
                            <a href="?part=history"> Order History </a>
                            <a> My wallet </a>
                            <a style="color:yellow; font-weight:bold; font-size:20px"> Security </a>
                        </div>
                    </div>
                    <div class="profile-infor-right">
                        <div class="profile-infor-right-title">
                            <p> Update Security </p>
                        </div>
                        <div class="profile-infor-right-input"> 
                            <input type="password" name="login_password" class="form-control" placeholder="Enter old password*" required="required" />
                            <span> Old Password </span>  
                            <input type="password" name="new_password" class="form-control" placeholder="Enter new password *" required="required" />
                            <span> New Password </span>
                            <input type="password" name="re_password" class="form-control" placeholder="Re enter new password *" required="required" />
                            <span> Re Password </span>
                        </div>
                    </div>
                    <button class="btn-update" type="submit" name="change"> <a> <p> Update </p> </a> </button>
                </div>
            </div>
        </section>
    </form>