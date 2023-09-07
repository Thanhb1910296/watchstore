    <?php
        $sql_order = mysqli_query($connect, "SELECT * FROM orders ORDER BY order_id ASC"); 
        //delete
        if(isset($_GET['delete_order'])){
            $id = $_GET['delete_order'];
            $sql_delete = mysqli_query($connect, "DELETE FROM orders WHERE order_id='$id'");
            echo '<meta http-equiv="refresh" content= "0;URL=?part=order" />'; 
        }

        //update order
        if(isset($_POST['update_order'])){
            $status_id = $_POST['status_id'];
            $status = $_POST['status'];

            $sql_update_status = mysqli_query($connect, "UPDATE orders SET order_status='$status' WHERE order_id = '$status_id'");
            echo '<meta http-equiv="refresh" content= "0;URL=?part=order" />'; 
        }
    ?>

    <div class="card mb-4" style="width: 70%; display: table; margin: 0 auto;">
        <div class="card-header" >
            <svg class="svg-inline--fa fa-table fa-w-16 me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM224 416H64v-96h160v96zm0-160H64v-96h160v96zm224 160H288v-96h160v96zm0-160H288v-96h160v96z"></path></svg>
            Data Table
        </div>
        <div class="card-body">
            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <div class="dataTable-top">
                    <div class="dataTable-dropdown">
                        <label>
                            <option style="border-style: groove; float:left;">Order List</option>
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
                                <th data-sortable="" style="width: 8%"><a href="index.html#" >Order ID</a></th>
                                <th data-sortable="" style="width: 18%;"><a href="index.html#" >Customer First Name</a></th>
                                <th data-sortable="" style="width: 14%;"><a href="index.html#" >Payment Method</a></th>
                                <th data-sortable="" style="width: 12%;"><a href="index.html#" >Order Detail</a></th>
                                <th data-sortable="" style="width: 12%;"><a href="index.html#" >Order Total</a></th>
                                <th data-sortable="" style="width: 16%;"><a href="index.html#" >Order Status</a></th>
                                <th data-sortable="" style="width: 16%;"><a href="index.html#" >Created at</a></th>
                                <th data-sortable="" style="width: 8%;"><a href="index.html#" >Delete</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=0;
                                while($fetch_order = mysqli_fetch_array($sql_order)){
                                    $i = $fetch_order['order_id'];
                                    //
                                    $fetch_customer_id[$i] = $fetch_order['customer_id'];
                                    $sql_customer = mysqli_query($connect, "SELECT * FROM customers WHERE customer_id = '$fetch_customer_id[$i]'");
                                    $fetch_customer[$i] = mysqli_fetch_array($sql_customer);
                                    //
                                    $fetch_payment_method[$i] = $fetch_order['payment_method'];
                                    //
                                    $fetch_order_status[$i] = $fetch_order['order_status'];
                            ?>
                            <tr>
                                <td> <?php echo $fetch_order['order_id']?> </td>
                                <td> <?php echo $fetch_customer[$i]['first_name']?> </td>
                                <td> <?php echo $fetch_order['payment_method']?> </td>
                                <td> <a href="?part=order&detail=<?php echo $i?>"> See detail </a> </td>
                                <td> $ <?php echo $fetch_order['order_total']?> </td>
                                <td> 
                                    <form method="POST">
                                        <input type="hidden" name="status_id" value="<?php echo $fetch_order['order_id']?>">
                                        <select name="status">
                                            <option> <?php echo $fetch_order['order_status']?> </option>
                                            <option value="pending"> pending </option>
                                            <option value="confirmed"> confirmed </option>
                                        </select>
                                        <button type="submit" style="border:none" name="update_order"> 
                                            <?php 
                                                if($fetch_order['order_status'] != "confirmed"){
                                            ?>
                                                <i class="fas fa-circle"></i>
                                            <?php
                                                } else {
                                            ?>
                                                    <i class="fas fa-check-circle"></i>
                                            <?php
                                                }
                                            ?>
                                        </button>
                                    </form>
                                </td>
                                <td> <?php echo $fetch_order['created_at']?> </td>
                                <td>
                                    <a href="?part=order&delete_order=<?php echo $fetch_order['order_id']?>" role="button" style="text-decoration:none"><img src="../assets/img/delete.jpg" style="height:20px; width:24px"></a>
                                </td>
                                
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="dataTable-bottom">
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
    <!-- get id -->
    <?php
        if(isset($_GET['detail'])){
            $detail = $_GET['detail'];
            include('order_detail.php');
        }else{
            $detail = '';
        }
    ?>
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