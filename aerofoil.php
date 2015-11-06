<?php

// given a line defined by two points, extend that line to a known point on the x axis and return new co-ordinates
function extendLineToX($known_point_x, $Ax, $Ay, $Az, $Bx, $By, $Bz) {
	$t = (($known_point_x - $Ax)/($Bx-$Ax));
    $new_x = $known_point_x;
    $new_y = $Ay+$t*($By-$Ay);
    $new_z = $Az+$t*($Bz-$Az);


    //echo($t);
    echo($new_x.','.$new_y.','.$new_z);
}

extendLineToX(0, 50, 0, 50, 100, 0, 0 ); // call the function
?>