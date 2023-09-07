    <?php
        $sql_total = mysqli_query($connect, "SELECT * FROM order_items WHERE order_id IS NULL");
        $temp= 0;
        $total = 0;

        while($fetch_total = mysqli_fetch_array($sql_total)){
            $temp += $fetch_total['product_price'] * $fetch_total['quantity'];
            $total = $temp;
        }

        if(!empty($_SESSION['customer'])){
            $sql_customer = mysqli_query($connect,"SELECT * FROM customers");
            $fetch_customer = mysqli_fetch_array($sql_customer);
            $assign_id = $_SESSION['customer'];

            if(isset($_POST['pay'])){
                $shipping_address = $_POST['shipping_address'];
                //
                $method = "credit card";
                $card_number = $_POST['card_number'];
                $expiration_date = $_POST['expiration_date'];
                $cvv = $_POST['cvv'];
                $coupon_code = $_POST['coupon_code'];
                //
                $status = "pending";
                
                $insert_order = mysqli_query($connect, "INSERT INTO orders(customer_id, payment_method, order_status, order_total, created_at) VALUES ('$assign_id', '$method', '$status', '$total', NOW())");
                
                $order = mysqli_query($connect,"SELECT max(order_id) AS max_order_id FROM orders");
                $fetch_order = mysqli_fetch_array($order);
                $assign_order = $fetch_order['max_order_id'];
                
                $insert_payment_method = mysqli_query($connect, "INSERT INTO payment_methods(customer_id, payment_method, card_number, expiration_date, cvv, coupon_code) VALUES ('$assign_id', '$method', '$card_number', '$expiration_date', '$cvv', '$coupon_code')");
                
                $insert_shipping_address = mysqli_query($connect, "INSERT INTO shipping_addresses(customer_id, order_id, shipping_address) VALUES ('$assign_id', '$assign_order', '$shipping_address')");

                $update_orders = mysqli_query($connect, "UPDATE order_items SET order_id='$assign_order' WHERE order_id IS NULL");

                echo '<script type="text/javascript">';
                echo ' alert("Thank you, come again !")';
                echo '</script>';
                echo '<meta http-equiv="refresh" content= "0;URL=?part=list" />'; 
            }
        }
    ?>
    <div class="payment-main">
        <form class="payment-form">
            <h1>Payment</h1>
            <div class="payment-content">
                <lable> First name </lable>
                <input type="text" value="<?php echo $fetch_customer['first_name'] ?>">
            </div>
            <div class="payment-content">
                <lable> Last name </lable>
                <input type="text" value="<?php echo $fetch_customer['last_name'] ?>">
            </div>
            <div class="payment-content">
                <lable> Email </lable>
                <input type="text" value="<?php echo $fetch_customer['email'] ?>">
            </div>
            <div class="payment-content">
                <lable> Phone number </lable>
                <input type="text" value="<?php echo $fetch_customer['phone_number'] ?>">
            </div>
            <div class="payment-content">
                <lable> Your address </lable>
                <input type="text" value="<?php echo $fetch_customer['customer_address'] ?>">
            </div>
            <div class="payment-content">
                <lable> Xip/Post code </lable>
                <input type="text" value="<?php echo $fetch_customer['zip_code'] ?>">
            </div>

        </form>

        <form class="payment-form"  method="POST">
            <h1>Payment</h1>
            <div class="payment-content">
                <lable> Card number </lable>
                <input type="text" name="card_number">
                <i class="fa fa-credit-card"></i>
            </div>
            <div class="payment-content">
                <lable> Expiration date </lable>
                <input type="date" name="expiration_date">
            </div>
            <div class="payment-content">
                <lable> CVV </lable>
                <input type="text" name="cvv">
                <i class="fa fa-credit-card-alt"></i>
            </div>
            <div class="payment-content">
                <lable> Coupon code </lable>
                <input type="text" name="coupon_code">
                <i class="fa fa-drivers-license"></i>
            </div>
            <div class="payment-content">
                <lable> Shipping address </lable>
                <input type="text" name="shipping_address">
                <i class="fa fa-truck"></i>
            </div>
            <button type="submit" name="pay"> Pay </button>
        </form>

        <form class="payment-form">
            <h1> Delivery & Information </h1>
            <div class="payment-detail">
                <p> Order are delivered on business days (Monday to Friday) excluding public holidays </p>
                <a href=""> See details </a>
                <p> 
                    Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our 
                    <span style="color:red"> privacy policy </span> 
                </p>
                <h2> Conditions </h2>
                <p> 
                    <input type="checkbox"> 
                    I have read and agree to the website 
                    <span style="color:red"> term and conditions (*) </span> 
                </p>
            </div>
        </form>
    </div>
    

    
    