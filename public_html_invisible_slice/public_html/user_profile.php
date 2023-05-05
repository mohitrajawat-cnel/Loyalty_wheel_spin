<?php
$countryArray = array(
	
);
// Assuming the array is placed above this function
    
    $output = "<select id='".$id."' name="country_code_num" class='".$classes."'>";
	
	foreach($countryArray as $code => $country){
	
		$output .= "<option value='".$country["code"]."'>".$code." - (+".$country["code"].")</option>";
	}
	
	$output .= "</select>";
	
	echo $output; 
    // or echo $output; to print directly
?>