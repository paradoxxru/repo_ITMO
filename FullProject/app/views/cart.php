<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ESHOP</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous"> 
</head>
<body>
	<?php
		//$user = new \app\User(); //создаем, проверяем залогинен ли, записываем инфу в поля объекта
		$user = new \app\auth\CUser($pdo);
        if(isset($_GET['logout'])) //если нажали выход, то logout
            $user->logout();

        $userCart = new \app\dataio\CUserCart($pdo,$user->getLogin(),$user->getUserId());
        //запцскаем мотод обработки экшинов
        $userCart->actionsWithCart();
        
	?>
	<?php
		//подключили файл проверки логина пользователя
		//include('../app/views/entrance/entrance_check.php');
		// echo "массив session<br>";
		// echo "<pre>";
		// var_dump($_SESSION);
		// echo "</pre>";
		//unset($_SESSION['cart']);
	?>
	<div class="header">
		<div class="inner-header">
			<div class="wrapper">
				<?php 
					//подключаем header
					include('../app/views/header/header.php');
				?>
			</div>
		</div>
	</div><!--end class="header"-->
	<!--слайдер - галерея изображений-->
	<section>
		<div class="wrapper slider-border">
			<div id="slider-wrap">
				<ul id="gallery">
					<!--
					<li>
						<a href=""><img src="img/tomat.jpg"></a>
					</li>
					-->
				</ul>
			</div>
			<div id="gallery-controls">
				<a href="#" id="control-prev">
					<img src="img/gallery/prev.png">
				</a>
				<p>Новые поступления</p>
				<a href="#" id="control-next">
					<img src="img/gallery/next.png">
				</a>
			</div>
		</div>
	</section>
	<section>
			<main>
				<div class="wrapper row">
					<section class="filter-section col-2">
						<?php
							//подключаем секцию фильтров
							include('../app/views/filter/filter_section.php');
						?>
					</section>
					<div class="content_sorting col-10">
						<div class="flex-column">
							<section class="sorting-section">
								<?php
									//подключаем секцию сортировок
									include('../app/views/sorting/sorting_section.php');
								?>
							</section>
							<section class="content-section">
								<div class="cart">
									<h1>Корзина</h1>
										<?php
											$cart = $userCart->getCart();
											// echo "каозина пользователя: <br>";
											// echo "<pre>";
											// var_dump($cart);
											// echo "</pre>";
											if(count($cart)>0) {
												foreach ($cart as $id => $item) {
										            $product = new \app\product\CProduct();
										            $product->fromArray($item); //заполняем значениями
										            $product->render('cart'); //выводим
										        }
									    	}
										?>
	    							<div class='cart__order'>
							            <div class="cart__order-summaryInfo">
							                <span><?php echo "Общая стоимость: ".$userCart->getTotalCost();?></span>
							                <span><?php echo "Общая вес: ".$userCart->getTotalWeight();?></span>
							            </div>
							            <div class='cart__order-action'>
							                <a href="/index.php?q=order">Оформить заказ</a>
							            </div>
							        </div>
						        </div>
							</section>
						</div><!--end "flex-column"-->
					</div><!-- end "content_sorting"-->
				</div>
			</main>
	</section>
	<!-- форма и контакты -->
	<section class="feedback">
		<div class="wrapper">
			<?php
				//подключаем форму обратной связи и контакты
				include('../app/views/contacts/contacts_section.php');
			?>
		</div>
	</section>
	<div class="footer">
		<?php
			//подключаем footer
			include('../app/views/footer/footer.php');
		?>
	</div>
	<!-- модальное окно - Входа и Регистрации-->
	<div class="overlay" id="entrance">
		<?php
			//подключаем модальное окно
			include('../app/views/modal_window/modal_window.php');
		?>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</body>
</html>