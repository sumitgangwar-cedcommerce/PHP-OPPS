<?php include "./config.php";
	  include "cart_class.php";
	  session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<title>
		Products
	</title>
	<link href="style.css" type="text/css" rel="stylesheet">
</head>

<body>
	<?php include "header.php";?>
	<div id="main">
		<div id="products">
			<?php foreach($products as $val){ ?>
				<div id="product-101" class="product">
					<img src="<?php echo $val['image'];?>">
					<h3 class="title"><a href="#"><?php echo $val['name'];?></a></h3>
					<span><?php echo $val['price'];?></span>
					<a class="add-to-cart" name="<?php echo $val['name'];?>" price="<?php echo $val['price'];?>" image="<?php echo $val['image'];?>" href="">Add To Cart</a>
				</div>
			<?php } ?>
		</div>
	</div>
	
		<table id="res" class="ss">

		</table>
	
	<?php include "footer.php";?>
	<script>
		$(document).ready(function(){
			$('.add-to-cart').click(function(){
				event.preventDefault();
				$name = $(this).attr('name');
				$price = $(this).attr('price');
				$image = $(this).attr('image');
				$.ajax({
					type : 'post',
					url : 'config.php',
					data :{
						cart : 'cart',
						name : $name,
						price : $price,
						image : $image
					},
					success : function(response){
						$('#res').html(response);
					}
				});
				
			});
			$('#res').on("click",".delete",function(){
				$name = $(this).attr('id');
				$.ajax({
					type : 'post',
					url : 'config.php',
					data :{
						delete : 'cart',
						name : $name,
					},
					success : function(response){
						$('#res').html(response);
					}
				})
			});
		});
	</script>
</body>
</html>