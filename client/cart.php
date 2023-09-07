    <?php
        if(isset($_POST['add-to-cart'])){
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image= $_POST['product_image'];

            $sql_add = mysqli_query($connect, "SELECT * FROM order_items WHERE product_id='$product_id' AND order_id IS NULL");
            $count = mysqli_num_rows($sql_add);
            if($count > 0){
                $fetch_add = mysqli_fetch_array($sql_add);
                $quantity = $fetch_add['quantity'] + 1;
                $sql_cart = mysqli_query($connect, "UPDATE order_items SET quantity='$quantity' WHERE product_id='$product_id' AND order_id IS NULL");
            }else{
                $quantity = 1;
                $sql_cart = mysqli_query($connect, "INSERT INTO order_items(product_id, product_name, product_price, product_image, quantity) values ('$product_id', '$product_name', '$product_price', '$product_image', '$quantity')");
            }
            echo '<meta http-equiv="refresh" content= "0;URL=?part=cart" />';
        } 
        elseif(isset($_GET['del'])){
            $id = $_GET['del'];
            $sql_del = mysqli_query($connect, "SELECT * FROM order_items WHERE product_id='$id' AND order_id IS NULL"); 
            $fetch_del = mysqli_fetch_array($sql_del);
            $decrease = $fetch_del['quantity'] - 1;
            if($decrease>=1)
                $sql_del = mysqli_query($connect, "UPDATE order_items SET quantity='$decrease' WHERE product_id='$id' AND order_id IS NULL");
            else{
                $sql_del = mysqli_query($connect, "DELETE FROM order_items WHERE product_id='$id' AND order_id IS NULL");
            }
            echo '<meta http-equiv="refresh" content= "0;URL=?part=cart" />'; 
        }
        ?>
    <section class="cart-main">
        <div class="cart-container">
            <p style="background-color:grey"> E-commerce Cart </p>
            <div class="cart-content">      
                <div class="cart-top">
                    <table>
                        <tr>
                            <th> Product Name </th>
                            <th> Image </th>
                            <th> Unit Price </th>
                            <th> Quantity </th>
                            <th> Delete </th>
                        </tr>
                        <?php
                            $temp= 0;
                            $total = 0;
                            $sum = 0;
                            $sql_items = mysqli_query($connect, "SELECT * FROM order_items WHERE order_id IS NULL");
                            while($fetch_items = mysqli_fetch_array($sql_items)){
                                $temp += $fetch_items['product_price'] * $fetch_items['quantity'];
                                $total = $temp;
                                $sum +=  $fetch_items['quantity'];
                        ?>
                        <tr>
                            <td> <?php echo $fetch_items['product_name'] ?> </td>
                            <td> <img src="image/<?php echo $fetch_items['product_image'] ?>"> </td>
                            <td> <?php echo $fetch_items['product_price'] ?> </td>
                            <td> <?php echo $fetch_items['quantity'] ?> </td>
                            <td> 
                                <a href="?part=cart&del=<?php echo $fetch_items['product_id']?>">
                                    <i class="fa fa-trash"></i>
                                </a>     
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
            </div>
            <div class="cart-content">
                <div class="cart-bottom">
                    <table>
                        <tr>
                            <th> Total </th>
                            <th> Value </th>
                        </tr>
                        <tr>
                            <td> Quantity </td>
                            <td> <?php echo $sum ?> </td>
                        </tr>
                        <tr>
                            <td> Price </td>
                            <td> <p style="font-size:20px"> $ <?php echo $total ?> </p> </td>
                        </tr>
                    </table>
                    <div class="cart-checkout-content">
                        <button> <a href="index.php"> Continue shopping </a> </button>
                        <button> <a href="?part=payment"> Checkout </a> </button>
                    </div>
                </div>
            </div>
        </div>
    </section>