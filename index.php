<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/54f0cb7e4a.js" crossorigin="anonymous"></script>
    <title> Watchstore </title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/detail.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="css/sign.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/payment.css">
</head>
<body>
    <?php
        session_start();
        include('connect/database.php');
    ?>
    <section class="topbar">
        <div class="container">
            <div class="row">
                <div class="logo">
                    <img src="./assets/img/favicon.jpg" alt="...">
                </div>
                <div class="top-menu">
                    <ul>
                        <li> <a href="index.php"> Home </a> </li>
                        <li> 
                            Categories
                            <ul class="top-menu-dropdown">
                            <?php
                                $data = mysqli_query($connect, "SELECT category_name FROM categories");
                                while($row = mysqli_fetch_array($data)){
                            ?>
                                    <li> <a href="?part=search&catalog=<?php echo $row['category_name']?>"> <?php echo $row['category_name'] ?> </a> </li>
                            <?php
                                }
                            ?>
                            </ul>
                        </li>
                        <li> <a href=""> About </a> </li>
                        <li> <a href=""> Contact </a> </li>
                        <li> <a href="server/index.php"> Dashboard </a> </li>
                    </ul>                       
                </div>
                <div class="top-menu-others">
                    <ul>
                        <li> 
                            <form action="?part=search" method="POST"> 
                                <input type="text" placeholder="Search..." name="keyword"> 
                                <button type="submit" name="search"> 
                                    <i class="fa fa-search"></i>
                                </button> 
                            </form>
                        </li>
                        <li> 
                            <a class="fa fa-user" href=""> </a> 
                            <?php
                                if(empty($_SESSION['login_name'])){
                            ?>
                                    <a class="fa fa-sign-in" href="?part=sign_in"> </a>
                                    
                            <?php
                                } else {
                            ?>
                                    <a class="fa fa-sign-out" href="?part=list&log_out"> </a>
                                    <p style="padding-left:12px"> <a href="?part=profile"> <?php echo $_SESSION['login_name'] ?> </a> </p>
                            <?php
                                }
                            ?>
                        </li>
                        <?php
                            $count = 0;
                            $query = mysqli_query($connect, "SELECT * FROM order_items WHERE order_id iS NULL");
                            while($fetch = mysqli_fetch_array($query)){                                      
                                $count += $fetch['quantity'];
                            }
                        ?>
                        <li> <a class="fas fa-shopping-cart" href="?part=cart"> </a> <input type="text" style="width:20px" value="<?php echo $count ?>"></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <?php            
        if(isset($_GET['part'])){
            $temp = $_GET['part'];
        } else{
            $temp = '';
        }
        if($temp == 'detail'){
            include('client/detail.php');
        } elseif($temp == 'cart'){
            include('client/cart.php');
        } elseif($temp == 'sign_in'){
            include('client/sign_in.php');
        } elseif($temp == 'sign_up'){
            include('client/sign_up.php');
        } elseif($temp =='payment'){
            include('client/payment.php');
        } elseif($temp == 'search'){
            include('client/search.php');
        } elseif($temp == 'profile'){
            include('client/profile.php');
        } elseif($temp =='history'){
            include('client/history.php');
        } elseif($temp == 'security'){
            include('client/security.php');
        }else{
            include('client/list.php');
        }
        if(isset($_GET['log_out'])){
            unset($_SESSION['customer']);
            unset($_SESSION['login_name']);
            echo '<meta http-equiv="refresh" content= "0;URL=index.php?part=list" />';  
        }
    ?>
    <section class="footer">
        <div class="footer-container">
            <div class="footer-copyright"> @Thanh</div>
        </div>
    </section>
</body>
    <?php
        mysqli_close($connect);
    ?>
</html>
