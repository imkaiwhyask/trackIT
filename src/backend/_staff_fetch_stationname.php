<?php
$connect = new PDO("mysql:host=localhost; dbname=stadadb", "root", "");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

if($received_data->query != '')
{
 $query = "
 SELECT stationName FROM tbl_station 
 WHERE stationName LIKE '%".$received_data->query."%' 
 ORDER BY stationName ASC 
 LIMIT 10
 ";

 $statement = $connect->prepare($query);

 $statement->execute();

 while($row = $statement->fetch(PDO::FETCH_ASSOC))
 {
  $data[] = $row;
 }
}

echo json_encode($data);

?>