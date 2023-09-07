    <?php
        $limit = !empty($_GET['limit'])?$_GET['limit']:12;
        $current_page = !empty($_GET['page'])?$_GET['page']:1;
        $offset = ($current_page - 1) * $limit;
        $total_records = mysqli_query($connect, "SELECT * FROM products");
        $count = mysqli_num_rows($total_records);
        $total_page = ceil($count/ $limit);
    ?>
    <section class="main">
        <div class="container">
            <div class="path">
                <p> Home </p>
                <span style="margin-right:1%"> / </span>
                <p> Products </p>
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
                        $query = mysqli_query($connect, "SELECT * FROM products LIMIT ".$limit." OFFSET ".$offset."");
                        while($row = mysqli_fetch_array($query)){
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
                    <div class="right-pagination">
                        <div class="right-page-number">
                            <ul>
                            <?php
                                //previous
                                if($current_page > 1){
                                    $previous = $current_page-1;
                            ?>
                                <!-- previous -->
                                <li>
                                    <a href="?limit=<?= $limit ?>&page=<?= $previous ?>">Previous</a>
                                </li>
                            <?php
                                //-3 |page number| +3
                                } for($num=1; $num<=$total_page; $num++){
                                    if($num!=$current_page){
                                        if($num > $current_page - 3 && $num < $current_page + 3 ){
                            ?>
                                <!-- page number -->
                                <li>
                                    <a href="?limit=<?= $limit ?>&page=<?= $num ?>"> <?= $num ?> </a>
                                </li>
                            <?php
                                        }
                                    } else { 
                            ?>
                                <!-- current page (strong) -->
                                <li>
                                    <strong> <?= $num?> </strong>
                                </li>
                            <?php
                                    }
                                }
                                //next
                                if($current_page < $total_page){
                                    $next = $current_page+1;
                            ?>
                                <!-- next -->
                                <li>
                                    <a href="?limit=<?= $limit ?>&page=<?= $next ?>"> Next </a>
                                </li>
                            <?php
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>