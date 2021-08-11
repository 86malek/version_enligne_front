<?php

//order_process.php

session_start();

$total_price = 0;

$item_details = '';

$order_details = '
<div class="table-responsive" id="order_table">
 <table class="table table-bordered table-striped">
  <tr>  
            <th>Product Name</th>  
            <th>Quantity</th>  
            <th>Price</th>  
            <th>Total</th>  
        </tr>
';

if(!empty($_SESSION["shopping_cart"]))
{
 foreach($_SESSION["shopping_cart"] as $keys => $values)
 {
  $order_details .= '
  <tr>
   <td>'.$values["product_name"].'</td>
   <td>'.$values["product_quantity"].'</td>
   <td align="right">$ '.$values["product_price"].'</td>
   <td align="right">$ '.number_format($values["product_quantity"] * $values["product_price"], 2).'</td>
  </tr>
  ';
  $total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);

  $item_details .= $values["product_name"] . ', ';
 }
 $item_details = substr($item_details, 0, -2);
 $order_details .= '
 <tr>  
        <td colspan="3" align="right">Total</td>  
        <td align="right">$ '.number_format($total_price, 2).'</td>
    </tr>
 ';
}
$order_details .= '</table>';

?>