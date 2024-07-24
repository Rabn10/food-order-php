<?php include('../user-partials/menu.php'); 
include('../algorithm/dataset.php');
include('../algorithm/recommend.php');



$username = $_SESSION['user'];
//algorithm
$re = new Recommend();
$food_recommend = $re->getRecommendations($foods, $username);
// print_r($food_recommend);
$_SESSION['id'] ;



?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>user/food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section> <br>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }

    ?>

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
                    <a href="<?php echo SITEURL;?>user/category-foods.php?category_id=<?php echo $id;?>">
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
                $sql2 = "SELECT * FROM tbl_food WHERE active='yes' AND featured='yes'";
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

                                <a href="<?php echo SITEURL;?>user/order.php?food_id=<?php echo $id ?>" class="btn btn-primary">Order Now</a>
                                <label>Rate:</label>
                                <form action="ratings.php" method="post">
                                    <input type="hidden" name="foodid" value="<?php echo $id ?>">
                                    <input type="hidden" name="username" value="<?php echo $_SESSION['user'] ?>">

                                <select name="ratings">
                                    <option value="1">1</option>
                                    <option value="2" >2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <button id="submit_rating" name="submit_rating" >submit</button>
                                    </form>
                                <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<!-- <script >
  $(document).ready(function(){
    // $("#submitr").click(function(){
    //   $("#message").html('wtf');
    // });



    $("#submitr").click(function(){
      $.ajax({
        type:"POST",
        url:"test.php",
        data:{name:'my namez',fid:'<?php echo $id;?>'},
        success:function(res){
          console.log(res);
        
        
        }
    });
  });
  });

</script> -->

                               
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
            <a href="foods.php">See All Foods</a>
        </p><br>
        <h2 class="text-center">Recommendation Foods</h2>
    <?php
        foreach($food_recommend as $key=>$value){
            $sql = "select * from tbl_food where title='".$key."'";
            $row = mysqli_query($conn,$sql);
            if(mysqli_num_rows($row)>0){
                while($result = mysqli_fetch_assoc($row)){
                    
                        $id = $result['id'];
                        $title = $result['title'];
                        $price = $result['price'];
                        $description = $result['description'];
                        $image_name = $result['image_name'];
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

                                <a href="<?php echo SITEURL;?>user/order.php?food_id=<?php echo $id ?>" class="btn btn-primary">Order Now</a>
                                    </div>
                                    </div>

                

         <?php       }
            }
        }

?>
    <div>


</div>

 </section>
 <br>

    
    <!-- fOOD Menu Section Ends Here -->

<!-- social Section Starts Here -->
<section class="social social1">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <!-- footer Section Starts Here -->
    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">Admin</a></p>
        </div>
    </section>
    <!-- footer Section Ends Here -->

</body>
</html>