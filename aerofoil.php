<?php


function aerofoil_processFile($input_file,$output_file, $chordA, $chordB, $locA, $locB, $machine_minX, $machine_maxX) {
	$handle = fopen($input_file, "r");
	if ($handle) {
    while (($line = fgets($handle)) !== false) {
    	$line = trim(str_replace("  ", " ", $line)); //removing whitespaces
    	$exploded_line = explode (" " ,$line);

    	//describes the points at the base and tip of the wing
    	$pointA = array(
    		            "x" => $locA,
                        "y" => $chordA*$exploded_line[0],
                        "z" => $chordA*$exploded_line[1],
                      );

    	$pointB = array(
    		            "x" => $locB,
                        "y" => $chordB*$exploded_line[0],
                        "z" => $chordB*$exploded_line[1],
                      );
    	
        //extends points to machine limits in x axis

        $XY_coord = aerofoil_extendLineToX($machine_minX, $pointA, $pointB);
        $ZE_coord = aerofoil_extendLineToX($machine_maxX, $pointA, $pointB);
        
    	// write to file
    	$current = file_get_contents($output_file);
    	$current .= "G00 "."X".$pointA['x']." Y".$pointA['y']." Z".$pointB['x']." E".$pointB['y']."\n";
    	file_put_contents($output_file, $current);
    }

    fclose($handle);
    } else {
    // error opening the file.
  } 
}





// given a line defined by two points, extend that line to a known point on the x axis and return new co-ordinates
function aerofoil_extendLineToX($known_point_x, &$pointA, &$pointB) {
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


/*$newpoint = aerofoil_extendLineToX(0, $pointA, $pointB); // call the function*/
aerofoil_processFile("NACA_2412.dat", "NACA_2412.gcode",20, 20, 0, 100, 0, 100);


?>