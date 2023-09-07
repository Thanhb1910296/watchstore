    <?php 
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        } else{
            $id = '';
        }
        $get = mysqli_query($connect, "SELECT * FROM products WHERE product_id='$id'");
        $fetch = mysqli_fetch_array($get);

        if(!empty($_SESSION['login_name'])){
            $assign_name = $_SESSION['login_name'];
            if(isset($_POST['post_comment'])){
                $content = $_POST['content'];
                //
                $sql_post_comment = mysqli_query($connect, "INSERT INTO comments(product_id, login_name, content, created_at) VALUES ('$id', '$assign_name', '$content', NOW())");
                echo '<meta http-equiv="refresh" content= "0;URL=index.php?part=detail&id='.$id.'"/>';   
            }
        }
        $sql_comment = mysqli_query($connect, "SELECT * FROM comments WHERE product_id='$id'");
    ?>
    
    <section class="detail-main">
        <div class="detail-container">
            <div class="detail-path">
                <p> Home </p>
                <span style="margin-right:1%"> / </span>
                <p> Products </p>
                <span style="margin-right:1%"> / </span>
                <p> <?php echo $fetch['product_name'] ?> </p>
            </div>

            <div class="detail-product">
                <div class="detail-product-left">
                    <div class="detail-product-image">
                        <img src="image/<?php echo $fetch['product_image'] ?>">
                    </div>
                </div>
                <div class="detail-product-right">
                    <div class="detail-product-name">
                        <h1> <?php echo $fetch['product_name'] ?> </h1>
                    </div>
                    <div class="detail-product-price">
                        <p> <?php echo $fetch['product_price'] ?> $ </p>
                    </div>
                    <div class="detail-product-right-button">
                        <form action="?part=cart" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $fetch['product_id'] ?>" >
                            <input type="hidden" name="product_name" value="<?php echo $fetch['product_name'] ?>" >
                            <input type="hidden" name="product_price" value="<?php echo $fetch['product_price'] ?>" >
                            <input type="hidden" name="product_image" value="<?php echo $fetch['product_image'] ?>" >
                            <button type="submit" name="add-to-cart"> <i class="fas fa-shopping-cart"> <p> Add to cart </p> </i> </button>
                            <button> <a href="?part=home"> <p> Continue shopping </p> </a> </button>
                        </form>
                    </div>
                    <div class="detail-product-description">
                        <p> <?php echo $fetch['product_description'] ?> </p>
                    </div>
                    <div style="margin-top:40px">
                        <i class="fas fa-star" style="color:gold"></i>
                        <i class="fas fa-star" style="color:gold"></i>
                        <i class="fas fa-star" style="color:gold"></i>
                        <i class="fas fa-star" style="color:gold"></i>
                        <i class="fas fa-star" style="color:gold"></i>
                    </div>
                    <div style="margin-top:20px">
                        <h2> Hot line </h2>
                        <p style="font-size:24px; color:red; margin-top:10px"> 0364 132 131 </p>
                        <i class="fas fa-phone" style="color:red; font-size:20px; margin-top:10px""></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="detail-related">
        <div class="detail-comment-title">
            <p> Comments </p>
        </div>
        <div class="detail-comment-container">
            <div class="detail-comment">
                <form>
                    <?php 
                        while($fetch_comment = mysqli_fetch_array($sql_comment)){
                    ?>
                        <lable> <?php echo $fetch_comment['login_name'] ?> </lable>
                        <input type="text" value="<?php echo $fetch_comment['content'] ?>">
                            <i class="fas fa-star" style="color:gold"></i>
                            <i class="fas fa-star" style="color:gold"></i>
                            <i class="fas fa-star" style="color:gold"></i>
                            <i class="fas fa-star" style="color:gold"></i>
                            <i class="fas fa-star" style="color:gold"></i>
                    <?php
                        }
                    ?>
                </form>
                <form id="post" method="POST">
                    <lable style="color:red; font-size:20px"> Your comment </lable>
                    <input type="text" name="content">
                    <button type="submit" name="post_comment"> 
                        <i class="fas fa-comments" style="font-size:18px"></i> 
                    </button>
                </form>
            </div>
        </div>
    </section>
    <?php 
        $relative = $fetch['category_id'];
        $except = $fetch['product_id']; 
    ?>
    <section class="detail-related">
        <div class="detail-related-title">
            <p> Related products </p>
        </div>
        <div class="detail-related-products-container">
            <?php
                $query = mysqli_query($connect, "SELECT * FROM products WHERE category_id='$relative' EXCEPT SELECT * FROM products WHERE product_id='$except'");
                while($row = mysqli_fetch_array($query)){
            ?>
            <div class="detail-related-products">
                <img src="image/<?php echo $row['product_image'] ?>">
                <h1> <a href="?part=detail&id=<?php echo $row['product_id']?>">
                    <?php echo $row['product_name'] ?> 
                </h1>
                <p> <?php echo $row['product_price'] ?> $ </p>
            </div>
            <?php
                }
            ?>
        </div>
    </section>
    
