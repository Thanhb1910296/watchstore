    <?php
        //pagination
        $limit = !empty($_GET['limit'])?$_GET['limit']:8;
        //current page (1)
        $current_page = !empty($_GET['page'])?$_GET['page']:1;
        //offset
        $offset = ($current_page - 1) * $limit;
        //total product
        $total_records = mysqli_query($connect, "SELECT * FROM products");
        //count
        $count = mysqli_num_rows($total_records);
        //total page
        $total_page = ceil($count/ $limit);
    
        $sql_product = mysqli_query($connect, "SELECT * FROM products ORDER BY product_id ASC LIMIT ".$limit." OFFSET ".$offset.""); 
        //add
        if(isset($_POST['add_product'])){
            $category_id = $_POST['category_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_description = $_POST['product_description'];
            $product_image = $_POST['product_image'];
            $sql_add = mysqli_query($connect,"INSERT INTO products(category_id, product_name, product_price, product_description, product_image) VALUES ('$category_id','$product_name','$product_price', '$product_description', '$product_image')");
        }
        //delete
        if(isset($_GET['delete_product'])){
            $id = $_GET['delete_product'];
            $sql_delete = mysqli_query($connect, "DELETE FROM products WHERE product_id='$id'");
            echo '<meta http-equiv="refresh" content= "0;URL=?part=product" />'; 
        }
        //update
        if(isset($_POST['update_product'])){
            $id = $_POST['id'];
            //
            $new_category_id = $_POST['category_id'];
            $new_product_name = $_POST['product_name'];
            $new_product_price = $_POST['product_price'];
            $new_product_description = $_POST['product_description'];
            $new_product_image = $_POST['product_image'];
            //
            $sql_update = mysqli_query($connect,"UPDATE products SET category_id='$new_category_id', product_name='$new_product_name', product_price='$new_product_price', product_description='$new_product_description', product_image='$new_product_image' WHERE product_id = '$id'");
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
                            <option style="border-style: groove; float:left;">Product List</option>
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
                                <th data-sortable="" style="width: 5%;"><a href="#">Category ID</a></th>
                                <th data-sortable="" style="width: 5%;"><a href="#">Product ID</a></th>
                                <th data-sortable="" style="width: 20%"><a href="#">Product Name</a></th>
                                <th data-sortable="" style="width: 5%"><a href="#">Product Image</a></th>
                                <th data-sortable="" style="width: 5%"><a href="#">Product Price</a></th>
                                <th data-sortable="" style="width: 5%;"><a href="#">Update</a></th>
                                <th data-sortable="" style="width: 5%;"><a href="#">Delete</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=0;                                            
                                while($fetch_product = mysqli_fetch_array($sql_product)){
                                    $i = $fetch_product['product_id'];
                                    $fetch_category[$i] = $fetch_product['category_id'];
                                    $fetch_name[$i] = $fetch_product['product_name'];
                                    $fetch_price[$i] = $fetch_product['product_price'];
                                    $fetch_description[$i] = $fetch_product['product_description'];
                                    $fetch_image[$i] = $fetch_product['product_image'];
                            ?>
                            <tr>
                                <td> <?php echo $fetch_product['category_id']?> </td>
                                <td> <?php echo $fetch_product['product_id']?> </td>
                                <td> <?php echo $fetch_product['product_name']?> </td>
                                <td> <img src="../image/<?php echo $fetch_product['product_image']?>" width="75px" height="90px" /> </td>
                                <td> $ <?php echo $fetch_product['product_price']?> </td>
                                <td>
                                    <a href="#update<?php echo $i?>" role="button" style="text-decoration:none"><img src="../assets/img/update.jpg" style="height:16px; width:16px"></a>
                                </td>
                                <td>
                                    <a href="?part=product&delete_product=<?php echo $fetch_product['product_id']?>" role="button" style="text-decoration:none"><img src="../assets/img/delete.jpg" style="height:20px; width:24px"></a>
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
                            <?php
                                //previous
                                if($current_page > 1){
                                    $previous = $current_page-1;
                            ?>
                                    <!-- previous -->
                                    <li class="page-item">
                                        <a class="page-link" href="?part=product&limit=<?= $limit?>&page=<?= $previous?>">Previous</a>
                                    </li>
                            <?php
                                //-3 |page number| +3
                                } 
                                for($num=1; $num<=$total_page; $num++){
                                    if($num!=$current_page){
                                        if($num > $current_page - 3 && $num < $current_page + 3 ){
                            ?>
                                            <!-- page number -->
                                            <li class="page-item">
                                                <a class="page-link" href="?part=product&limit=<?= $limit?>&page=<?= $num?>"> <?= $num?> </a>
                                            </li>
                                    <?php
                                        }
                                    } else { 
                                    ?>
                                        <!-- current page (strong) -->
                                        <li class="current-page page-item">
                                            <strong class="current-page page-link"> <?= $num?> </strong>
                                        </li>
                            <?php
                                    }
                                }
                                //next
                                if($current_page < $total_page){
                                    $next = $current_page+1;
                            ?>
                                    <!-- next -->
                                    <li class="page-item">
                                        <a class="page-link" href="?part=product&limit=<?= $limit?>&page=<?= $next?>"> Next </a>
                                    </li>
                            <?php
                                }
                            ?>
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
                        <label for="">Category ID</label>
                        <input type="text" class="form-control" id="" placeholder="Enter" name="category_id">
                    </div>
                    <div class="form-group" style="margin-bottom:5px">
                        <label for="">Product Name</label>
                        <input type="text" class="form-control" id="" placeholder="Enter" name="product_name">
                    </div>
                    <div class="form-group" style="margin-bottom:5px">
                        <label for="">Product Price</label>
                        <input type="text" class="form-control" id="" placeholder="Enter" name="product_price">
                    </div>
                    <div class="form-group" style="margin-bottom:5px">
                        <label for="">Product Image</label></br>
                        <label for="file-upload" class="custom-file-upload">
                            <input id="file-upload" type="file" name="product_image"/>
                        </label>
                    </div>
                    <div class="form-group" style="margin-bottom:5px">
                        <label for="">Product Discription</label>
                        <input type="text" class="form-control" id="" placeholder="Enter" name="product_description">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit" name="add_product">
                    <a href="dashboard.php?part=product" class="btn btn-primary" name="back"> Back</a>
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
                            <span>Category ID</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" class="form-control" value="<?php echo $fetch_category[$j] ?>"></div>
                        </div>
                        <div class="col-md-6">
                            <span>Replace With</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="category_id" class="form-control"></div>
                        </div>
                    </div>
                    <!-- // -->
                    <div class="row">
                        <div class="col-md-6">
                            <span>Product Name</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" class="form-control" value="<?php echo $fetch_name[$j] ?>"></div>
                        </div>
                        <div class="col-md-6">
                            <span>Replace With</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="product_name" class="form-control"></div>
                    </div>
                    </div>
                    <!-- // -->
                    <div class="row">
                        <div class="col-md-6">
                            <span>Product Price</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" class="form-control" value="<?php echo $fetch_price[$j] ?>"></div>
                        </div>
                        <div class="col-md-6">
                            <span>Replace With</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="product_price" class="form-control"></div>
                        </div>
                    </div>
                    <!-- // -->
                    <div class="row">
                        <div class="col-md-6">
                            <span>Product Description</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" class="form-control" value="<?php echo $fetch_description[$j] ?>"></div>
                        </div>
                        <div class="col-md-6">
                            <span>Replace With</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" name="product_description" class="form-control"></div>
                        </div>
                    </div>
                    <!-- // -->
                    <div class="row" style="margin-bottom:10px">
                        <div class="col-md-6">
                            <span>Product Image</span>
                            <div class="inputbox mt-3 mr-2"> <input type="text" class="form-control" value="<?php echo $fetch_image[$j] ?>"></div>
                        </div>
                        <div class="col-md-6">
                            <span>Replace With</span>
                            <label for="file-upload" class="custom-file-upload" style="margin-top:10%">
                                <input id="file-upload" type="file" name="product_image"/>
                            </label>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Update" name="update_product">
                    <a href="dashboard.php?part=product" class="btn btn-primary" name="back"> Back</a>
                </form> 
            </div>
        </div> 
    </div>
    <?php
        }
    ?>