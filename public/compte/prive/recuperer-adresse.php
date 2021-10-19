<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

     $prepAddr = str_replace(' ','+',$_GET['adresse']);
     $geocode=file_get_contents('http://www.mapquestapi.com/geocoding/v1/address?maxResults=1&key=wsJZ523rBfhlDPKaTpijUAU6YA5fcnVB&location='.$prepAddr);
     $json_data = json_decode($geocode);
     echo $json_data->results[0]->locations[0]->latLng->lat.', '.$json_data->results[0]->locations[0]->latLng->lng;

?>
