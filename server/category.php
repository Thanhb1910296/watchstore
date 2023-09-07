    <?php
        $sql_category = mysqli_query($connect, "SELECT * FROM categories ORDER BY category_id ASC");
        //add
        if(isset($_POST['add_category'])){
            $category_name = $_POST['category_name'];
            $sql_add = mysqli_query($connect,"INSERT INTO categories(category_name) VALUES ('$category_name')");
        }
        //delete
        if(isset($_GET['delete_category'])){
            $id = $_GET['delete_category'];
            $sql_delete = mysqli_query($connect, "DELETE FROM categories WHERE category_id='$id'");
            echo '<meta http-equiv="refresh" content= "0;URL=?part=category" />'; 
        }
        //update
        if(isset($_POST['update_category'])){
            $id = $_POST['id'];
            $new_category_name = $_POST['category_name'];
            $sql_update = mysqli_query($connect,"UPDATE categories SET category_name='$new_category_name' WHERE category_id = $id");
        }
    ?>
    <div class="card mb-4" style="width: 60%; display: table; margin: 0 auto;">
        <div class="card-header" >
            <svg class="svg-inline--fa fa-table fa-w-16 me-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="table" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M464 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM224 416H64v-96h160v96zm0-160H64v-96h160v96zm224 160H288v-96h160v96zm0-160H288v-96h160v96z"></path></svg>
            Data Table
        </div>
        <div class="card-body">
            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                <div class="dataTable-top">
                    <div class="dataTable-dropdown">
                        <label>
                            <option style="border-style: groove; float:left;">Category</option>
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
                                <th data-sortable="" style="width: 12%"><a href="index.html#" >Categoy ID</a></th>
                                <th data-sortable="" style="width: 48%;"><a href="index.html#" >Category Name</a></th>
                                <th data-sortable="" style="width: 20%;"><a href="index.html#" >Update</a></th>
                                <th data-sortable="" style="width: 20%;"><a href="index.html#" >Delete</a></th>                       
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i=0;
                                while($fetch_category = mysqli_fetch_array($sql_category)){
                                    $i = $fetch_category['category_id'];
                                    $array[$i] = $fetch_category['category_name'];
                            ?>
                            <tr>
                                <td> <?php echo $fetch_category['category_id']?> </td>
                                <td> <?php echo $fetch_category['category_name']?> </td>
                                <td>
                                    <a href="#update<?php echo $i?>" role="button" style="text-decoration:none"><img src="../assets/img/update.jpg" style="height:16px; width:16px"></a>
                                </td>
                                <td>
                                    <a href="?delete_category=<?php echo $fetch_category['category_id']?>" role="button" style="text-decoration:none"><img src="../assets/img/delete.jpg" style="height:20px; width:24px"></a>
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
                                <a href="" data-page="1">1</a>
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
                        <label for="">Category Name</label>
                        <input type="text" class="form-control" id="" aria-describedby="emailHelp" placeholder="Enter" name="category_name">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Submit" name="add_category">
                    <a href="dashboard.php?part=category" class="btn btn-primary" name="back"> Back</a>
                </form> 
            </div>
        </div> 
    </div>
    <!-- update -->
    <?php
        for($j=1;$j<=$i;$j++){
    ?>
    <div class="container">
        <div class="card login-form" id="update<?php echo $j?>">
            <div class="card-body">
                <form action="" method="POST">
                    <input type="hidden" class="form-control" name="id" value="<?php echo $j ?>">
                    <div class="form-group" style="margin-bottom:5px">
                        <label for="">Category Name</label>
                        <input type="text" class="form-control" value="<?php echo $array[$j] ?>">
                    </div>
                    <div class="form-group" style="margin-bottom:5px">
                        <label for="">Replace With</label>
                        <input type="text" class="form-control" id="" placeholder="Replace with" name="category_name">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Update" name="update_category">
                    <a href="dashboard.php?part=category" class="btn btn-primary" name="back"> Back</a>
                </form> 
            </div>
        </div> 
    </div>
    <?php
        }
    ?>
