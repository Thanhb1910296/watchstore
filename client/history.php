    <?php
        $assign_id = $_SESSION['customer'];
        
        $sql_customer_info = mysqli_query($connect, "SELECT * FROM customers WHERE customer_id = '$assign_id'");
        $fetch_customer_info = mysqli_fetch_array($sql_customer_info);

        $sql_customer_order = mysqli_query($connect, "SELECT * FROM orders WHERE customer_id = '$assign_id'");
        $sql_customer_item= mysqli_query($connect, "SELECT * FROM orders JOIN order_items ON orders.order_id = order_items.order_id WHERE orders.customer_id = '$assign_id'")
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
                            <a href="?part=profile"> Profile </a>
                            <a style="color:yellow; font-weight:bold; font-size:18px"> Order History </a>
                            <a> My wallet </a>
                            <a href="?part=security"> Security </a>
                        </div>
                    </div>
                    <div class="profile-infor-right">
                        <div class="profile-infor-right-title">
                            <p> Order History </p>
                        </div>
                        <div class="profile-history-table"> 
                            <table style="width:700px">
                                <tr>
                                    <th> Order ID </th>
                                    <th> Payment Method </th>
                                    <th> Order Status </th>
                                    <th> Order Total </th>
                                    <th> Created at </th>
                                </tr>
                                <?php
                                    while($fetch_customer_order = mysqli_fetch_array($sql_customer_order)){
                                ?>
                                <tr>
                                    <td> <?php echo $fetch_customer_order['order_id'] ?> </td>
                                    <td> <?php echo $fetch_customer_order['payment_method'] ?> </td>
                                    <td> <?php echo $fetch_customer_order['order_status'] ?> </td>
                                    <td> $ <?php echo $fetch_customer_order['order_total'] ?> </td>
                                    <td> <?php echo $fetch_customer_order['created_at'] ?> </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </table>
                            <div class="profile-infor-right-title" style="margin:100px 0 0 100px">
                                <p> Order Detail </p>
                            </div>
                            <table style="width:900px">
                                <tr>
                                    <th style="width:10%"> Order ID </th>
                                    <th style="width:10%"> Items ID </th>
                                    <th style="width:40%"> Product Name </th>
                                    <th style="width:18%"> Product Image </th>
                                    <th style="width:12%"> Unit Price </th>
                                    <th style="width:10%"> Quantity </th>
                                </tr>
                                <?php
                                    while($fetch_customer_item = mysqli_fetch_array($sql_customer_item)){
                                ?>
                                <tr>
                                    <td> <?php echo $fetch_customer_item['order_id'] ?> </td>
                                    <td> <?php echo $fetch_customer_item['item_id'] ?> </td>
                                    <td> <?php echo $fetch_customer_item['product_name'] ?> </td>
                                    <td> <img src="image/<?php echo $fetch_customer_item['product_image'] ?>" style="width:50px; height:60px"> </td>
                                    <td> $ <?php echo $fetch_customer_item['product_price'] ?> </td>
                                    <td> <?php echo $fetch_customer_item['quantity'] ?> </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </table>
                        </div> 
                    </div>
                </div>
            </div>
        </section>
    </form>