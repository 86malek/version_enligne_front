<?php

//fetch.php;

if(isset($_GET["term"]))
{



$statement = Bdd::connectBdd()->prepare("SELECT * FROM eg_produit WHERE eg_produit_statut = 1 AND eg_produit_nom LIKE :rech ORDER BY eg_produit_prix ASC");
$statement->bindParam(":rech", $_GET["term"], PDO::PARAM_STR);


 $statement->execute();

 $result = $statement->fetchAll();

 $total_row = $statement->rowCount();

 $output = array();
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   $temp_array = array();
   $temp_array['value'] = $row['student_name'];
   $temp_array['label'] = '<img src="images/'.$row['image'].'" width="70" />&nbsp;&nbsp;&nbsp;'.$row['student_name'].'';
   $output[] = $temp_array;
  }
 }
 else
 {
  $output['value'] = '';
  $output['label'] = 'No Record Found';
 }

 echo json_encode($output);
}

?>