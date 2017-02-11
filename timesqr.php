<?php

$text=$_GET["id"];
$numero_giorno_settimana = date("w");
$c=0;
$t=0;
//$text="s-srhvmp4sep-nocco2"; debug on Lecce (Italy)


date_default_timezone_set("Europe/Rome");
$ora=date("H:i:s", time());
$ora2=date("H:i:s", time()+60*60);
$today = date ("Y-m-d");
//$today="2017-02-10"; debug
$distanza=[];
$json_string = file_get_contents("https://transit.land/api/v1/onestop_id/".$text);
$parsed_json = json_decode($json_string);
$count = 0;
$countl = 0;
$namedest=$parsed_json->{'name'};
$IdFermata="";

foreach($parsed_json->{'routes_serving_stop'} as $data=>$csv1){
 $count = $count+1;
}

$countl=0;
$countl2=0;
$json_string1 = file_get_contents("https://transit.land/api/v1/schedule_stop_pairs?destination_onestop_id=".$text."&origin_departure_between=".$ora.",".$ora2."&date=".$today);

//echo $json_string1;
$parsed_json1 = json_decode($json_string1);


foreach($parsed_json1->{'schedule_stop_pairs'} as $data12=>$csv11){
 $countl = $countl+1;
}

$start=0;
if ($countl == 0){

}else{
    $start=1;
}

$temp_c1="";
for ($l=0;$l<$countl;$l++)
  {
	if (($parsed_json1->{'schedule_stop_pairs'}[$l]->{'service_days_of_week'}[$numero_giorno_settimana-1]) == TRUE)
  	  {

        $distanza[$l]['orari']=$parsed_json1->{'schedule_stop_pairs'}[$l]->{'destination_arrival_time'};
        $json_string2 = file_get_contents("https://transit.land/api/v1/onestop_id/".$parsed_json1->{'schedule_stop_pairs'}[$l]->{'origin_onestop_id'});
        $parsed_json2 = json_decode($json_string2);
        $name=$parsed_json2->{'name'};
      foreach($parsed_json2->{'routes_serving_stop'} as $data12=>$csv11){
      if ($parsed_json2->{'routes_serving_stop'}[$data12]->{'route_onestop_id'}==$parsed_json1->{'schedule_stop_pairs'}[$l]->{'route_onestop_id'}){
          $linea=$parsed_json2->{'routes_serving_stop'}[$data12]->{'route_name'};
          $temp_c1 .="N. ".$linea." =>";
      $temp_c1 .=$distanza[$l]['orari']."</br>";//." proveniente da ".$name;

        }
        }


        $c++;
      }

  //  }

  }
  sort($distanza);


if ( $start==1){
echo "<font face='verdana'>Linee in arrivo nella prossima ora a <b>".$namedest."</b>:<br><br>";

echo $temp_c1;

}else{
  echo "<font face='verdana'>Non ci sono arrivi nella prossima ora / No Bus arrives next hour";

}




?>
