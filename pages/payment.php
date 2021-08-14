<?php


include("../config/fonction.php");

session_start();

if(isset($_POST["button_action"]))
{

$order_number = rand(100000,999999);
$status = 1;
   $order_data = array( 
   ':order_number'   => $order_number,
   ':order_status'   => $status,
   ':customer_email'  => $_POST['email'],
   ':customer_nom_prenom'  => $_POST["client"],
   ':customer_adresse'  => $_POST['adresse'],
   ':customer_gouv'  => $_POST['gouvernorat'],
   ':customer_cp'   => $_POST['postal'],
   ':customer_tel'  => $_POST['tel'],
   ':customer_commande'  => $_POST['commande']
  );

  $query = "
  INSERT INTO eg_order_table 
     (order_number, order_status, customer_email, customer_nom_prenom, customer_adresse, customer_gouv, customer_cp, customer_tel, customer_commande) 
     VALUES (:order_number, :order_status, :customer_email, :customer_nom_prenom, :customer_adresse, :customer_gouv, :customer_cp, :customer_tel, :customer_commande)
  ";

  $statement = Bdd::connectBdd()->prepare($query);

  $statement->execute($order_data);

  $order_id = Bdd::connectBdd()->lastInsertId();

  foreach($_SESSION["shopping_cart"] as $keys => $values)
  {
   $order_item_data = array(
    ':order_id'  => $order_id,
    ':order_item_name' => $values["product_name"],
    ':order_item_quantity' => $values["product_quantity"],
    ':order_item_price' => $values["product_price"]
   );

   $query = "
   INSERT INTO eg_order_item 
   (order_id, order_item_name, order_item_quantity, order_item_price) 
   VALUES (:order_id, :order_item_name, :order_item_quantity, :order_item_price)
   ";

   $statement = Bdd::connectBdd()->prepare($query);

   $statement->execute($order_item_data);
  }

  unset($_SESSION["shopping_cart"]);

  $_SESSION["success_message"] = "Vos dérnieres commandes sont en cours de traitement par nos experts.";
  header('location:https://expert-gaming.tn/Commande');
}


?>