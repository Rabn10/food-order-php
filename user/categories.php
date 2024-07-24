<?php include('../user-partials/menu.php'); ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

                //display all the categories that are active
                $sql = "SELECT * FROM tbl_category WHERE active='yes'";


                //Execute the query
                $res = mysqli_query($conn,$sql);

                //count row
                $count= mysqli_num_rows($res);

                //check whether categories  available or not
                if ($count>0) 
                {
                    //categories available
                    while ($row=mysqli_fetch_assoc($res)) 
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        
                        ?>

                            <a href="category-foods.html">
                                <div class="box-3 float-container">
                                    <?php 
                                        if($image_name=="")
                                        {
                                            //image not avaialbe
                                            echo "<div class='error'>Image not found.</div>";
                                        }
                                        else
                                        {
                                            //image avaiable
                                            ?>

                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">


                                            <?php 
                                        }
                                     ?>
                                    
                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>


                        <?php  

                    }
                }
                else
                {
                    //categoy not avaialble
                    echo "<div class='error'>Category not found</div>";
                }

             ?>

            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


   <?php include('../user-partials/footer.php'); ?>