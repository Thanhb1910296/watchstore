    <?php
        if(isset($_POST['search'])){
            $keyword = $_POST['keyword'];
            $search= mysqli_query($connect, "SELECT * FROM products WHERE products.product_name LIKE '%".$keyword."%'");
            $count = mysqli_num_rows($search);
        }else{
            $keyword = '';
        }
        if(isset($_GET['catalog'])){
            $catalog = $_GET['catalog'];
            $search= mysqli_query($connect, "SELECT * FROM products WHERE products.product_name LIKE '%".$catalog."%'");
            $count = mysqli_num_rows($search); 
        }
        else{
            $catalog = '';
        }
    ?>
    <section class="main">
        <div class="container">
            <div class="path">
                <p> Home </p>
                <span style="margin-right:1%"> / </span>
                <p> Products </p>
                <span style="margin-right:1%"> / </span>
                <p style="color:black"> return[<?php echo $count ?> results] </p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="left">
                    <ul>
                        <li class="left-items">
                            <a href=""> Best Salers </a>
                            <ul>
                                <li> <a href=""> 10% </a> </li>
                                <li> <a href=""> 20% </a> </li>
                                <li> <a href=""> 50% </a> </li>
                                <li> <a href=""> 75% </a> </li>
                                <li> <a href=""> 90% </a> </li>
                            </ul>
                        </li>
                        <li class="left-items">
                            <a href=""> Super Deal </a>
                        </li>
                        <li class="left-items">
                            <a href=""> Membership Zone </a>
                        </li>
                        <li class="left-items">
                            <a href=""> Event Coupon </a>
                        </li>
                    </ul>
                </div>
                <div class="right">
                    <div class="right-items">
                        <p class="title"> Products List </p>
                    </div>
                    <div class="right-items">
                        <button> <span> Filter </span> <i class="fas fa-sort-down"> </i> </button>
                    </div>
                    <div class="right-items">
                        <select>
                            <option> Orders by ID ASC</option>
                            <option> Orders by ID DESC</option>
                            <option> Oldest to newest </option>
                            <option> Newest to oldest </option>
                        </select>
                    </div>
                    <div class="right-content">
                    <?php 
                        $count = 0;
                        while($row = mysqli_fetch_array($search)){
                            $count++;
                    ?>
                        <div class="right-content-item">
                            <img src="image/<?php echo $row['product_image'] ?>" alt="...">
                            <h1> 
                                <a href="?part=detail&id=<?php echo $row['product_id'] ?>"> 
                                    <?php echo $row['product_name'] ?> 
                                </a> 
                            </h1>
                            <p> <?php echo $row['product_price'] ?> $ </p>
                        </div>
                    <?php 
                        } 
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </section>