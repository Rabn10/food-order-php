<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>

        <?php
            //create sql query 
            $sql = "SELECT * FROM tbl_category where active='yes' AND featured='yes' Limit 3";
            //execute the query
            $res = mysqli_query($conn,$sql);
            //count rows to check whether the category is avaiable or not
            $count = mysqli_num_rows($res);

            if($count>0)
            {
                //category available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    <a href="category-foods.html">
                    <div class="box-3 float-container">
                        <?php
                            if($image_name=="")
                            {
                                //display message
                                echo "<div class='error'>image not added</div>";
                            }
                            else
                            {
                                //image avaiable
                                ?>
                                    <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name?>" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                        <h3 class="float-text text-white"><?php echo $title;?></h3>
                        
                    </div>
                    </a>

                    <?php
                }
            }
            else
            {
                //category not avaialbe
                echo "<div class='error'>Category not added</div>";
            }
        
        ?>

        
    </div>
   </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //getting foods from database that are active and featured
                $sql2 = "SELECT * FROM tbl_food WHERE active='yes' AND featured='yes'LIMIT 6";
                //execue the qurey
                $res2 = mysqli_query($conn,$sql2);

                //count row
                $count2 = mysqli_num_rows($res2);

                //check whether food avaialble or not
                if ($count2>0) 
                {
                     //food avaiable
                    while ($row=mysqli_fetch_assoc($res2)) 
                    {
                        //get all the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];

                        ?>
                         <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    //check if image name is avaiable or not
                                    if ($image_name=="") 
                                    {
                                         //Image not avaiable
                                        echo "<div class='error'>Image not avaiable</div>";
                                     } 
                                     else
                                     {
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php 
                                     }
                                 ?>
                                
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo $price; ?></p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="order.html" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php  
                    }
                 } 
                 else
                 {
                    //food not available
                    echo "<div class='error'>food not added</div>";
                 }

             ?>

           


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>