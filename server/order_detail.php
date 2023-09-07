    <?php
        if(isset($_GET['detail'])){
            $detail = $_GET['detail'];
        }else{
            $detail = '';
        }
        //delete
        if(isset($_GET['delete_order_item'])){
            $id = $_GET['delete_order_item'];
            $sql_delete = mysqli_query($connect, "DELETE FROM order_items WHERE item_id='$id'"); 
        }
        //update
        if(isset($_POST['update_order_item'])){
            $id = $_POST['id'];
            //
            $new_product_id = $_POST['product_id'];
            $sql_update = mysqli_query($connect,"UPDATE order_items SET product_id = '$new_product_id' WHERE item_id = $id");
            //
            $new_quantity = $_POST['quantity'];
            $sql_update_product = mysqli_query($connect,"UPDATE order_items JOIN products ON order_items.product_id = products.product_id SET order_items.product_name = products.product_name, order_items.product_price = products.product_price, order_items.quantity = '$new_quantity' WHERE order_items.product_id = '$new_product_id'");
        }
        $sql_order_item = mysqli_query($connect, "SELECT * FROM order_items WHERE order_id = '$detail'");                                 
    ?>
    
    <div class="card mb-4" style="width: 70%; display: table; margin: 0 auto;">
        <div class="card-header">
            <svg class="svg-inline--fa fa-table fa-w-16 me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM224 416H64v-96h160v96zm0-160H64v-96h160v96zm224 160H288v-96h160v96zm0-160H288v-96h160v96z"></path></svg>
            Data Table
        </div>
        <div class="card-body">
            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <div class="dataTable-top">
                    <div class="dataTable-dropdown">
                        <label>
                            <option style="border-style: groove; float:left;">Order Detail <?php echo $detail ?></option>
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
                                <th data-sortable="" style="width: 8%;"><a href="index.html#" >Item ID</a></th>
                                <th data-sortable="" style="width: 42%;"><a href="index.html#" >Product Name</a></th>
                                <th data-sortable="" style="width: 18%;"><a href="index.html#" >Product Price</a></th>
                                <th data-sortable="" style="width: 8%;"><a href="index.html#" >Quantity</a></th>
                                <th data-sortable="" style="width: 8%;"><a href="index.html#" >Update</a></th>
                                <th data-sortable="" style="width: 8%;"><a href="index.html#" >Delete</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=0;
                                while($fetch_order_item = mysqli_fetch_array($sql_order_item)){
                                    $i = $fetch_order_item['item_id'];
                                    $fetch_order_id[$i] = $fetch_order_item['order_id'];
                                    $fetch_product_id[$i] = $fetch_order_item['product_id'];
                                    $fetch_product_name[$i] = $fetch_order_item['product_name'];
                                    $fetch_product_price[$i] = $fetch_order_item['product_price'];                                       
                                    $fetch_quantity[$i] = $fetch_order_item['quantity'];                                
                            ?>
                            <tr>
                                <td> <?php echo $fetch_order_id[$i] ?> </td>
                                <td> <?php echo $i?> </td>
                                <td> <?php echo $fetch_product_name[$i] ?> </td>
                                <td> <?php echo $fetch_product_price[$i] ?> </td>
                                <td> <?php echo $fetch_quantity[$i]?> </td>
                                <td>
                                    <a href="#update_order_item<?php echo $i?>" role="button" style="text-decoration:none"><img src="../assets/img/update.jpg" style="height:16px; width:16px"></a>
                                </td>
                                <td>
                                    <a href="?part=order&detail=<?php echo $detail?>&delete_order_item=<?php echo $fetch_order_item['item_id']?>" role="button" style="text-decoration:none"><img src="../assets/img/delete.jpg" style="height:20px; width:24px"></a>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="dataTable-bottom">
                    <!-- <div class="dataTable-info">
                        <a class="btn btn-light" href="#add" role="button" style="background:blue">Add</a>
                    </div> -->
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
    <!-- update -->
    <?php
        for($j=1;$j<=$i;$j++){
    ?>
    <div class="container">
        <div class="card login-form" id="update_order_item<?php echo $j?>">
            <div class="card-body">
                <form action="" method="POST">
                    <input type="hidden" class="form-control" name="id" value="<?php echo $j ?>">
                <!-- // -->
                    <div class="form-group" style="margin-bottom:5px">
                        <label for="">Product ID</label>
                        <input type="text" class="form-control" value="<?php echo $fetch_product_id[$j]?>">
                    </div>
                    <div class="form-group" style="margin-bottom:5px">
                        <label for="">Replace With</label>
                        <input type="text" class="form-control" id="" placeholder="Replace with" name="product_id">
                    </div>
                <!-- // -->
                    <div class="form-group" style="margin-bottom:5px">
                        <label for="">Quantity</label>
                        <input type="text" class="form-control" value="<?php echo $fetch_quantity[$j]?>">
                    </div>
                    <div class="form-group" style="margin-bottom:5px">
                        <label for="">Replace With</label>
                        <input type="text" class="form-control" id="" placeholder="Replace with" name="quantity">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Update" name="update_order_item">
                    <a href="dashboard.php?part=order" class="btn btn-primary" name="back"> Back</a>
                </form> 
            </div>
        </div> 
    </div>
    <?php
        }
    ?>