

<?php 

$value = $_POST['value']; //get required value

$val_in = $_POST['val_in']; //get currency_name

$val_out = $_POST['val_out']; //get required currency_name
$xml=simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml"); //Get XML- file

 function get_rate($xml, $val){

        if ($val != 'EUR'){
		     
		    $m = $xml->xpath('//*[@currency="'.$val.'"]'); //get currency_value 
			if (count($m) > 0) {
					    
			    $rate = (string)$m[0]['rate'];
						
					    
			} else {
						
			    exit("Something going wrong!");
				    
		}} else {
		$rate = 1;/* if required currency_name EUR rate = 1*/
		}	
     return $rate;		
 }

 switch ($_POST['action']){
                
    case "convert":
        $rate_in = get_rate ($xml, $val_in);

        $rate_out = get_rate ($xml, $val_out);

        $transfer = ($value/$rate_in)*$rate_out;

        echo "<br/>Result: ".$value." ".$val_in." = ".round($transfer, 3)." ".$val_out;

    break;
}



