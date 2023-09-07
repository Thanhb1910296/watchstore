    <?php
        $sql_customer = mysqli_query($connect, 'SELECT * FROM customers ORDER BY customer_id ASC');
        //add
        if(isset($_POST['add_customer'])){
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone_number = $_POST['phone_number'];
            $email = $_POST['email'];
            $customer_address = $_POST['customer_address'];
            $zip_code = $_POST['zip_code'];
            $sql_add = mysqli_query($connect,"INSERT INTO customers(first_name, last_name, phone_number, email, customer_address, zip_code) VALUES ('$first_name','$last_name', '$phone_number', '$email', '$customer_address', '$zip_code')");
        }
        //delete
        if(isset($_GET['delete_customer'])){
            $id = $_GET['delete_customer'];
            $sql_delete = mysqli_query($connect, "DELETE FROM customers WHERE customer_id='$id'");
            echo '<meta http-equiv="refresh" content= "0;URL=?part=customer" />'; 
        }
        //update
        if(isset($_POST['update_customer'])){
            $id = $_POST['id'];
            //
            $new_first_name = $_POST['first_name'];
            $new_last_name = $_POST['last_name'];
            $new_phone_number = $_POST['phone_number'];
            $new_email = $_POST['email'];
            $new_ustomer_address = $_POST['customer_address'];
            $new_zip_code = $_POST['zip_code'];
            $new_login_name = $_POST['login_name'];
            $new_login_password = $_POST['login_password'];
            //
            $sql_update = mysqli_query($connect,"UPDATE customers SET first_name='$new_first_name', last_name='$new_last_name', phone_number='$new_phone_number', email='$new_email', customer_address='$customer_address', zip_code='$new_zip_code', login_name='$new_login_name', login_password='$new_login_password'  WHERE customer_id = '$id'");
        }
    ?>

    <div class="card mb-4" style="width: 95%; display: table; margin: 0 auto;">
        <div class="card-header" >
            <svg class="svg-inline--fa fa-table fa-w-16 me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM224 416H64v-96h160v96zm0-160H64v-96h160v96zm224 160H288v-96h160v96zm0-160H288v-96h160v96z"></path></svg>
            Data Table
        </div>
        <div class="card-body">
            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <div class="dataTable-top">
                    <div class="dataTable-dropdown">
                        <label>
                            <option style="border-style: groove; float:left;">Customer List</option>
                        </label>
                    </div>
                    <div class="dataTable-search">
                        <input class="dataTable-input" placeholder="Search..." type="text">
                    </div>
                </div>      
                <div class="dataTable-container">
                    <table id="datatablesSimple" class="dataTable-table">
                        <thead>
                            <tr>                                    
                                <th data-sortable="" style="width: 8%;"><a href="#">Customer ID</a></th>
                                <th data-sortable="" style="width: 8%;"><a href="#">First Name</a></th>
                                <th data-sortable="" style="width: 8%"><a href="#">Last Name</a></th>
                                <th data-sortable="" style="width: 10%"><a href="#">Phone Number</a></th>
                                <th data-sortable="" style="width: 12%"><a href="#">Email</a></th>
                                <th data-sortable="" style="width: 12%;"><a href="#">Address</a></th>
                                <th data-sortable="" style="width: 8%;"><a href="#">Zip Code</a></th>
                                <th data-sortable="" style="width: 10%;"><a href="#">Login Name</a></th>
                                <th data-sortable="" style="width: 10%;"><a href="#">Login Password</a></th>
                                <th data-sortable="" style="width: 5%;"><a href="#">Update</a></th>
                                <th data-sortable="" style="width: 5%;"><a href="#">Delete</a></th>                                   
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=0;                                            
                                while($fetch_customer = mysqli_fetch_array($sql_customer)){
                                    //assign data
                                    $i = $fetch_customer['customer_id'];
                                    $fetch_first_name[$i] = $fetch_customer['first_name'];
                                    $fetch_last_name[$i] = $fetch_customer['last_name'];
                                    $fetch_phone_number[$i] = $fetch_customer['phone_number'];
                                    $fetch_email[$i] = $fetch_customer['email'];
                                    $fetch_customer_address[$i] = $fetch_customer['customer_address'];
                                    $fetch_zip_code[$i] = $fetch_customer['zip_code'];
                                    $fetch_login_name[$i] = $fetch_customer['login_name'];
                                    $fetch_login_password[$i] = $fetch_customer['login_password'];
                            ?>
                            <tr>
                                <td> <?php echo $fetch_customer['customer_id']?> </td>
                                <td> <?php echo $fetch_customer['first_name']?> </td>
                                <td> <?php echo $fetch_customer['last_name']?> </td>
                                <td> <?php echo $fetch_customer['phone_number']?> </td>
                                <td> <?php echo $fetch_customer['email']?> </td>
                                <td> <?php echo $fetch_customer['customer_address']?> </td>
                                <td> <?php echo $fetch_customer['zip_code']?> </td>
                                <td> <?php echo $fetch_customer['login_name']?> </td>
                                <td> <?php echo $fetch_customer['login_password']?> </td>
                                <td>
                                    <a href="#update<?php echo $i?>" role="button" style="text-decoration:none"><img src="../assets/img/update.jpg" style="height:16px; width:16px"></a>
                                </td>
                                <td>
                                    <a href="?part=customer&delete_customer=<?php echo $fetch_customer['customer_id']?>" role="button" style="text-decoration:none"><img src="../assets/img/delete.jpg" style="height:20px; width:24px"></a>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="dataTable-bottom">
                    <div class="dataTable-info">
                        <a class="btn btn-light" href="#add" role="button" style="background:blue">Add</a>
                    </div>
                    <nav class="dataTable-pagination">
                        <ul class="dataTable-pagination-list">
                            <li class="active">
                                <a href="" data-page="1">1</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <style>
        body div div div div table tbody tr .login-wrap{
            position:absolute;
            left:50%;
            margin-left:-33px;
            top:50%;
            margin-top:-30px;
        }
        .login-form{
            position:absolute;
            top:1%;
            left:50%;
            margin-left:-225px;
            width:450px;
            visibility:hidden;
            opacity: 0;
        }
        .login-form:target{
            top:20%;
            visibility: visible;
            opacity: 1;
            transition:all 1s ease;
        }
    </style>
    <!-- add -->
    <div class="container">
        <div class="card login-form" id="add">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="form-group" style="margin-bottom:5px">
                        <label for="">First Name</label>
                        <input type="text" class="form-control" id="" placeholder="Enter" name="first_name">
                    </div>
                    <div class="form-group" style="margin-bottom:5px">
                        <label for="">Last Name</label>
                        <input type="text" class="form-control" id="" placeholder="Enter" name="last_name">
                    </div>
                    <div class="form-group" style="margin-bottom:5px">
                        <label for="">Phone Number</label>
                        <input type="text" class="form-control" id="" placeholder="Enter" name="phone_number">
                    </div>
                    <div class="form-group" style="margin-bottom:5px">
                        <label for="">Email</label>
                        <input type="text" class="form-control" id="" placeholder="Enter" name="email">
                    </div>
                    <div class="form-group" style="margin-bottom:5px">
                        <label for="">Addess</label>
                        <input type="text" class="form-control" id="" placeholder="Enter" name="customer_address">
                    </div>
                    <div class="form-group" style="margin-bottom:5px">
                        <label for="">Zip Code</label>
                        <input type="text" class="form-control" id="" placeholder="Enter" name="zip_code">
                    </div>
                    <div class="form-group" style="margin-bottom:5px">
                        <label for="">Login Name</label>
                        <input type="text" class="form-control" id="" placeholder="Enter" name="login_name">
                    </div>
                    <div class="form-group" style="margin-bottom:5px">
                        <label for="">Login Password</label>
                        <input type="text" class="form-control" id="" placeholder="Enter" name="login_password">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit" name="add_customer">
                    <a href="dashboard.php?part=customer" class="btn btn-primary" name="back"> Back</a>
                </form> 
            </div>
        </div> 
    </div>
    <!-- update -->
    <?php
        $j = 0;
        while($j<=$i){
            $j++;
    ?>
    <div class="container">
        <div class="card login-form" id="update<?php echo $j?>">
            <div class="card-body">
                <form action="" method="POST">
                    <input type="hidden" class="form-control" name="id" value="<?php echo $j ?>">
                    <!-- // -->
                    <div class="row">
                        <div class="col-md-6">
                            <span>First name</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" class="form-control" value="<?php echo $fetch_first_name[$j] ?>"></div>
                        </div>
                        <div class="col-md-6">
                            <span>Replace With</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="first_name" class="form-control"></div>
                        </div>
                    </div>
                    <!-- // -->
                    <div class="row">
                        <div class="col-md-6">
                            <span>Last Name</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" class="form-control" value="<?php echo $fetch_last_name[$j] ?>"></div>
                        </div>
                        <div class="col-md-6">
                            <span>Replace With</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="last_name" class="form-control"></div>
                    </div>
                    </div>
                    <!-- // -->
                    <div class="row">
                        <div class="col-md-6">
                            <span>Phone Number</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" class="form-control" value="<?php echo $fetch_phone_number[$j] ?>"></div>
                        </div>
                        <div class="col-md-6">
                            <span>Replace With</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="phone_number" class="form-control"></div>
                        </div>
                    </div>
                    <!-- // -->
                    <div class="row">
                        <div class="col-md-6">
                            <span>Email</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" class="form-control" value="<?php echo $fetch_email[$j] ?>"></div>
                        </div>
                        <div class="col-md-6">
                            <span>Replace With</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="email" class="form-control"></div>
                        </div>
                    </div>
                    <!-- // -->
                    <div class="row">
                        <div class="col-md-6">
                            <span>Address</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" class="form-control" value="<?php echo $fetch_customer_address[$j] ?>"></div>
                        </div>
                        <div class="col-md-6">
                            <span>Replace With</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="customer_address" class="form-control"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Zip Code</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" class="form-control" value="<?php echo $fetch_zip_code[$j] ?>"></div>
                        </div>
                        <div class="col-md-6">
                            <span>Replace With</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="zip_code" class="form-control"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <span>Login Name</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" class="form-control" value="<?php echo $fetch_login_name[$j] ?>"></div>
                        </div>
                        <div class="col-md-6">
                            <span>Replace With</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="login_name" class="form-control"></div>
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-md-6">
                            <span>Login Password</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" class="form-control" value="<?php echo $fetch_login_password[$j] ?>"></div>
                        </div>
                        <div class="col-md-6">
                            <span>Replace With</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="login_password" class="form-control"></div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Update" name="update_customer">
                    <a href="dashboard.php?part=customer" class="btn btn-primary" name="back"> Back</a>
                </form> 
            </div>
        </div> 
    </div>
    <?php
        }
    ?>
