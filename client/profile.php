    <?php
        $assign_id = $_SESSION['customer'];
        if(isset($_POST['update'])){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone_number = $_POST['phone_number'];
            $email = $_POST['email'];
            $customer_address = $_POST['customer_address'];
            $zip_code = $_POST['zip_code'];
            //
            $sql_new_customer = mysqli_query($connect, "UPDATE customers SET first_name='$first_name', last_name='last_name', phone_number='$phone_number', email='$email', customer_address='$customer_address', zip_code='$zip_code' WHERE customer_id='$assign_id'");
            //
            echo '<script type="text/javascript">';
            echo ' alert("Update successful !")';
            echo '</script>';
            echo '<meta http-equiv="refresh" content= "0;URL=index.php?part=profile"/>';
        }
        $sql_customer_info = mysqli_query($connect, "SELECT * FROM customers WHERE customer_id = '$assign_id'");
        $fetch_customer_info = mysqli_fetch_array($sql_customer_info);
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
                            <p style="padding-left:50px; font-weight:bold; font-size:22px; color: blue"> <?php echo $fetch_customer_info['first_name'] ?> </p>
                            <a style="color:yellow; font-weight:bold; font-size:20px"> Profile </a>
                            <a href="?part=history"> Order history </a>
                            <a> My wallet </a>
                            <a href="?part=security"> Security </a>
                        </div>
                    </div>
                    <div class="profile-infor-right">
                        <div class="profile-infor-right-title">
                            <p> Information </p>
                        </div>
                        <div class="profile-infor-right-input"> 
                            <input type="text" name="first_name" class="form-control" placeholder="First Name *" value="<?php echo $fetch_customer_info['first_name'] ?>" />
                            <span> First Name </span>  
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name *" value="<?php echo $fetch_customer_info['last_name'] ?>" />
                            <span> Last Name </span>
                            <input type="text" name="phone_number" class="form-control" placeholder="Phone Number *" value="<?php echo $fetch_customer_info['phone_number'] ?>" />
                            <span> Phone Number </span>
                            <input type="text" name="email" class="form-control" placeholder="Your Email *" value="<?php echo $fetch_customer_info['email'] ?>" />
                            <span> Email </span>
                            <input type="text" name="customer_address" class="form-control" placeholder="Address *" value="<?php echo $fetch_customer_info['customer_address'] ?>" />
                            <span> Your Address </span>
                            <input type="text" name="zip_code" class="form-control" placeholder="Zip Code *" value="<?php echo $fetch_customer_info['zip_code'] ?>" />
                            <span> Zip/Post Code </span>
                        </div>
                    </div>
                    <button class="btn-update" type="submit" name="update"> <a> <p> Update </p> </a> </button>
                </div>
            </div>
        </section>
    </form>