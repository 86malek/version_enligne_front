<?php
session_start();
    include("../config/fonction.php");	
	
	
	$total_price = 0;
	
	$item_details = '';
	
	$order_details = '
	<div class="table-responsive" id="order_table">
	 <table class="table table-bordered table-striped">
	  <tr>  
				<th>Nom du produit</th>  
				<th>Quantité</th>  
				<th>Prix</th>  
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
	   <td align="right">'.$values["product_price"].' TND</td>
	   <td align="right">'.number_format($values["product_quantity"] * $values["product_price"], 3).' TND</td>
	  </tr>
	  ';
	  $total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
	
	  $item_details .= $values["product_name"] . ', ';
	 }
	 $item_details = substr($item_details, 0, -2);
	 $order_details .= '
	 <tr>  
			<td colspan="3" align="right">Total</td>  
			<td align="right">'.number_format($total_price, 3).' TND</td>
		</tr>
	 ';
	}
	$order_details .= '</table></div>';
	
	?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<!-- Basic page needs
	============================================ -->
	<title>Expert Gaming | Confirmation de la commande</title>
	<meta charset="utf-8">
	<meta name="keywords" content="" />
	<meta name="robots" content="index, follow" />

	<!-- Mobile specific metas
	============================================ -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<!-- Favicon
	============================================ -->
	<link rel="shortcut icon" href="../ico/favicon.png">

	<!-- Google web fonts
	============================================ -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>

	<!-- font-awesome
	============================================ -->
	<link href="../css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
	
    <!-- Libs CSS
	============================================ -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	
	<link href="../js/datetimepicker/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="../js/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link href="../css/themecss/lib.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	
	<!-- Theme CSS
	============================================ -->
   	<link href="../css/themecss/so_megamenu.css" rel="stylesheet">
    <link href="../css/themecss/so-categories.css" rel="stylesheet">
	<link href="../css/themecss/so-listing-tabs.css" rel="stylesheet">
	<link href="../css/header8.css" rel="stylesheet">
	<link href="../css/footer5.css" rel="stylesheet">
	<link id="color_scheme" href="../css/home8.css" rel="stylesheet">
	<link id="color_scheme" href="../css/home4.css" rel="stylesheet">
	<link id="color_scheme" href="../css/theme.css" rel="stylesheet">
	<link href="../css/responsive.css" rel="stylesheet">
	<style>
	.require
	{
	border:1px solid #FF0000;
	background-color: #cbd9ed;
	}
  	</style>

</head>

<body class="res layout-subpage">

	<div id="wrapper" class="wrapper-full">

		<!-- Header Container  -->
		<?php
			include("../include/top.php");
		?>
		<!-- //Header Container  -->

		<!-- Main Container  -->
		<div class="main-container container">
			<ul class="breadcrumb">
				<li><a href="Accueil"><i class="fa fa-home"></i></a></li>
				<li>Suivi de commande</li>
			</ul>
			
			<div class="row">
				<!--Middle Part Start-->
				<div id="content" class="col-sm-12">
						<h2 class="title">Ma dernière commande</h2>
  						<span id="message"></span>
						<div class="panel panel-default">
							<div class="panel-heading">Processus de commande</div>
							<div class="panel-body">
								<form method="post" id="order_process_form" action="payment.php">
									<div class="row">
										<div class="col-md-6" style="border-right:1px solid #ddd;">
											<h4>Détails du consommateur</h4>
											<div class="row">
												<div class="col-sm-12">
													<label><b>Nom et Prénom *</b></label>
													<input type="text" name="client" id="client" class="form-control" value="" required/>
													<span id="error_client" class="text-danger"></span>
												</div>
												<div class="col-sm-12">
													<label><b>Adresse email *</b></label>
													<input type="email" name="email" id="email" class="form-control" value="" required />
													<span id="error_email_address" class="text-danger"></span>
												</div>
												<div class="col-sm-12">
													<label><b>Adresse postale *</b></label>
													<textarea name="adresse" id="adresse" class="form-control"></textarea>
													<span id="error_adresse" class="text-danger"></span>
												</div>
												
												<div class="col-sm-6">
													<label><b>Gouvernorat *</b></label>
													<input type="text" name="gouvernorat" id="gouvernorat" class="form-control" value="" required/>
													<span id="error_gouvernorat" class="text-danger"></span>
												</div>
												<div class="col-sm-6">
													<label><b>Code postal *</b></label>
													<input type="text" name="postal" id="postal" class="form-control" value="" required/>
													<span id="error_postal" class="text-danger"></span>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<label><b>Téléphone * :</b></label>
													<input type="text" name="tel" id="tel" class="form-control" value="" required/>
													<span id="error_tel" class="text-danger"></span>
												</div>
											</div>
											<hr />
											<h4>Details du paiement</h4>
											<div class="row">
												<div class="col-md-12">
													<label>Choisir votre type de paiement</label>
													<select name="" class="form-control"  required>
													<option value="">Par chéque</option>
													<option value="">Par chéque</option>
														<option value="">Par chéque</option>
													</select>
												</div>
											</div>
											<br />
											<div>
												<input type="hidden" name="total_amount" value="<?php echo $total_price; ?>" />
												<input type="hidden" name="item_details" value="<?php echo $item_details; ?>" />
												<input type="button" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Pay Now" />
											</div>
										</div>
										<div class="col-md-6">
											<h4>Détails de la commande</h4>
											<?php
											echo $order_details;
											?>
										</div>
									</div>
								</form>
							</div>
						</div>
				</div>
				<!--Middle Part End-->
			</div>
		</div>
		<!-- //Main Container -->

		<!-- Footer Container -->
		<?php
			include("../include/footer.php");
		?>
		<!-- //end Footer Container -->

	</div>


	<!-- Include Libs & Plugins
============================================ -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script type="text/javascript" src="../js/jquery-2.2.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/owl-carousel/owl.carousel.js"></script>
	<script type="text/javascript" src="../js/themejs/libs.js"></script>
	<script type="text/javascript" src="../js/unveil/jquery.unveil.js"></script>
	<script type="text/javascript" src="../js/countdown/jquery.countdown.min.js"></script>
	<script type="text/javascript" src="../js/dcjqaccordion/jquery.dcjqaccordion.2.8.min.js"></script>
	<script type="text/javascript" src="../js/datetimepicker/moment.js"></script>
	<script type="text/javascript" src="../js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../js/modernizr/modernizr-2.6.2.min.js"></script>

	<!-- Theme files
	============================================ -->
	<script type="text/javascript" src="../js/themejs/application.js"></script>
	<script type="text/javascript" src="../js/themejs/so_megamenu.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
	
	<script>

		 
		$(document).ready(function(){


			load_cart_data();

			function load_cart_data()
			{
			$.ajax({
			url:"../include/fetch_cart.php",
			method:"POST",
			dataType:"json",
			success:function(data)
			{
				$('#cart_details').html(data.cart_details);
				$('.total_price').text(data.total_price);
				$('.cart-counter').text(data.total_item);
			}
			})
			}

			$('#cart-popover').popover({
			html : true,
			container : 'body',
			content:function(){
			return $('#popover_content_wrapper').html();
			}
			});

			$(document).on('click', '#clear_cart', function(){
				var action = 'empty';
				$.ajax({
				url:"include/action.php",
				method:"POST",
				data:{action:action},
				success:function()
				{
					load_cart_data();
					//$('#cart-popover').popover('hide');
					addProductNotice('Notification', '','<h3>Votre panier est de nouveau vide</h3>', 'danger');
				}
				})
			});
			});

			function addProductNotice(title, thumb, text, type) {
				$.jGrowl.defaults.closer = false;
				//Stop jGrowl
				//$.jGrowl.defaults.sticky = true;
				var tpl = '<h3>'+text+'</h3>';
				$.jGrowl(tpl, {		
					life: 4000,
					header: title,
					speed: 'slow',
					theme: type
				});
			}

		function validate_form()
			{
			var valid_card = 0;
			var valid = true;
			var email_address = $('#email_address').val();
			var customer_name = $('#customer_name').val();
			var customer_address = $('#customer_address').val();

			





			if(customer_address == '')
			{
			$('#customer_address').addClass('require');
			$('#error_customer_address').text('Enter Address Detail');
			valid = false;
			}
			else
			{
			$('#customer_address').removeClass('require');
			$('#error_customer_address').text('');
			valid = true;
			} 

			

			return valid;
		}


	<script>

</body>

</html>