0<?php
$con = mysqli_connect("localhost","root","","food-order");
$user = "SELECT * FROM tbl_user ";
$user_result = $con->query($user);
if ($user_result->num_rows > 0) {
    while ($user_row = $user_result->fetch_assoc()) {
        $username = $user_row['username'];
        $id = $user_row['id'];
        $rating = "SELECT * FROM tbl_food_rating WHERE user_id = '$id'";
        $rating_result = $con->query($rating);
        if ($rating_result->num_rows > 0) {
            while ($rating_row = $rating_result->fetch_assoc()) {
                $product_id = $rating_row['food_id'];
                $product = "SELECT * FROM tbl_food WHERE id = '$product_id'";
                $product_result = $con->query($product);
                if ($product_result->num_rows > 0) {
                    while ($product_row = $product_result->fetch_assoc())  {
                        $r = $product_row["title"];
                        // print_r($product_row['id']);

                        $datasets[$username][$r] = $rating_row['rating'];
                        // print_r($product_row);
                    }
                }
            }
        }
    }
}

$foods = $datasets;
// print_r($books);