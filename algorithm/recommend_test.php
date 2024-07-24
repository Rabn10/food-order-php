<?php

require_once("recommend.php");
include("dataset.php");



$re = new Recommend();
print_r($re->getRecommendations($books, "mount123"));

?>