<?php
include('../config/constants.php');
if(isset($_POST['submit_rating'])){
    echo $user_name=$_SESSION['id'];
    echo $food_id = $_POST['foodid'];
    echo $rating_value= $_POST['ratings'];

    $sql = "INSERT INTO `tbl_food_rating`(`user_id`, `food_id`, `rating`) VALUES ('".$user_name."','".$food_id."','".$rating_value."')";

    if(mysqli_query($conn,$sql)){
        echo 'sucess';
    }
    else 
    echo 'fail';


    //  ds header('location:http://localhost/food-order/user/index.php');
}