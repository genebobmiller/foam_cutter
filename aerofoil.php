<?php
// given a line defined by two points, extend that line to a known point on the x axis and return new co-ordinates
function extendLineToX($known_point_x, &$pointA, &$pointB) {
	$t = (($known_point_x - $pointA["x"])/($pointB["x"]-$pointA["x"]));
    
    $point = array(
    "x" => $pointA["x"]+$t*($pointB["x"]-$pointA["x"]),
    "y" => $pointA["y"]+$t*($pointB["y"]-$pointA["y"]),
    "z" => $pointA["z"]+$t*($pointB["z"]-$pointA["z"]),
	);
    return($point);

}

$pointA = array(
    "x" => "50",
    "y" => "0",
    "z" => "50",
);

$pointB = array(
    "x" => "100",
    "y" => "0",
    "z" => "0",
);


$newpoint = extendLineToX(0, $pointA, $pointB); // call the function
var_dump($newpoint)
?>