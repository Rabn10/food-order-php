<?php include('../user-partials/menu.php'); ?>

<?php
//check whehter id is passed or not
if(isset($_GET['category_id']))
{
    //category id is seet and get the id
    $category_id = $_GET['category_id'];
    //get caategory id
    $sql = "SELECT title FROM tbl_category WHERE id = $category_id";

    //execute the query
    $res = mysqli_query($conn,$sql);

    //get the value from database
    $row = mysqli_fetch_assoc($res);

    //get the title
    $category_title = $row['title'];
}
else
{
    //category not passed 
    //redirected to home page
    header('location:'.SITEURL.'user/index.php');
}


?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //create sql query to get food based on selected category
                $sql2 = "SELECT * FROM tbl_food WHERE category_id= $category_id";

                $res2 = mysqli_query($conn,$sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2>0)
                {
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>



                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Food not avaliable</div>";
                }
            

            ?>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Food Title</h4>
                    <p class="food-price">$2.3</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and organice vegetables.
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('../user-partials/footer.php'); ?>