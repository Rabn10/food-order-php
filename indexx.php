<?php
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: *");
// include "connection.php";

// $method = $_SERVER["REQUEST_METHOD"];

// switch ($method) {
//   case "POST":
//     $user = json_decode(file_get_contents("php://input"));
//     print_r($user);
    //   echo $user->username;
    //   echo $user->password;
    // $sql = "INSERT INTO admin(id,name,username,email,password,admin) VALUES(null,'temper holic','$user->username','temper@gmail.com','$user->password',1)";
    // if (mysqli_query($conn, $sql)) {
    //   $response = ["status" => 1, "message" => "user created"];
    // } else {
    //   $response = ["status" => 0, "message" => "Failed to create users."];
    // }
    // echo json_encode($response);
    // break;


?>
<!DOCTYPE html>
<html>
<head>
 
</head>
<body>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script >
  $(document).ready(function(){
    // $("#submit").click(function(){
    //   $("#message").html('wtf');
    // });



  //   $("#submit").click(function(){
  //     $.ajax({
  //       type:"POST",
  //       url:"indexx.php",
  //       data:{name:'my namez'},
  //       success:function(res){
  //         alert(res);
        
        
  //       }
  //   });
  // });
  // });

</script>

<script src="rating/jquery-3.6.0.slim.min.js"></script>
<script src="rating/jquery.star-rating.js"></script>
<script>
  $('.rating').starRating(
  {
    starSize: 1.5,
    showInfo: true
  });

   $(document).on('change', '.rating',
        function (e, stars, index) {
            alert(`Thx for ${stars} stars!`);
        });
</script>
  <div>
    <input type="text" name="name">
    <button id="submit">submit</button>
    <div id="message">ff</div>
  </div>

  <div class="rating"></div>








 
</body>
</html>
