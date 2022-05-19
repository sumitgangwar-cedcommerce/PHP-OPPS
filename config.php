<?php
	namespace std;
	session_start();
	if(!isset($_SESSION['cart']))	$_SESSION['cart'] = array();	
	$products  =array(
		array(
			"image"=>"images/football.png",
			"name"=>"Product 101",
			"price"=>"$150.00"
		),
		array(
			"image"=>"images/basketball.png",
			"name"=>"Product 102",
			"price"=>"$120.00"
		),
		array(
			"image"=>"images/table-tennis.png",
			"name"=>"Product 103",
			"price"=>"$90.00"
		),
		array(
			"image"=>"images/tennis.png",
			"name"=>"Product 104",
			"price"=>"$110.00"
		),
		array(
			"image"=>"images/soccer.png",
			"name"=>"Product 105",
			"price"=>"$80.00"
		)
	);
	class Product{
		public $name;
		public $image;
		public $price;
		function __construct($name , $image , $price){
			$this->name = $name;
			$this->image = $image;
			$this->price = $price;
		}
		function push_cart(){
			$t=1;
			foreach($_SESSION['cart'] as $key=>$val){
				if($val[0]==$this->name){
					$_SESSION['cart'][$key][3]++;
					$t=0;
					break;
				}
			}
			if($t){
				$_SESSION['cart'][$this->name] = array($this->name , $this->image , $this->price , 1);
			}
		}
		
	}    
	
	if(isset($_POST['cart'])){
		$name = $_POST['name'];
		$price = $_POST['price'];
		$image = $_POST['image'];
		$obj = new Product($name , $image , $price);
		$obj->push_cart();
		show_cart();
		
	}
	if(isset($_POST['delete'])){
		unset($_SESSION['cart'][$_POST['name']]);
		show_cart();
	}
	function show_cart(){
		echo'<tr>
				<th>Name</th>
				<th>Image</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Action</th>
			</tr>';
		foreach($_SESSION['cart'] as $key=>$val){
			echo'<tr>
					<td>'.$val[0].'</td>
					<td><img src="'.$val[1].'"></td>
					<td>'.$val[2].'</td>
					<td>'.$val[3].'</td>
					<td><button class="delete" id="'.$val[0].'">Remove</button></td>
				</tr>';
		}
	}

	
	 
?>