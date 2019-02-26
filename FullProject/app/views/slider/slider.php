<div id="slider-wrap">
	<ul id="gallery">
		<!--
		<li>
			<a href=""><img src="img/tomat.jpg"></a>
		</li>
		-->
		<?php
			$query = "SELECT goods.id, goods.name, goods.img, goods.receipt_data
					  FROM goods
					  WHERE receipt_data > {d '2018-07-01'} AND receipt_data < {d '2019-02-13'}
					  ORDER BY receipt_data;";
			$resalt = $pdo->query($query)->fetchAll();
			// echo "массив ответа: ";echo "<br>";
			// echo "<pre>";
	  //       var_dump($resalt);
	  //       echo "</pre>";
			//<a href="/index.php?q=product&id=<?php echo $this->id;
			foreach ($resalt as $key => $value) {
				echo "<li>
						<a href='/index.php?q=product&id=".$value['id']."'>
							<img src='assets/".$value['img']."'>
						</a>
					</li>";
			}
		?>
	</ul>
</div>
<div id="gallery-controls">
	<a href="#" id="control-prev">
		<img src="img/gallery/prev.png">
	</a>
	<p>НОВЫЕ ПОСТУПЛЕНИЯ</p>
	<a href="#" id="control-next">
		<img src="img/gallery/next.png">
	</a>
</div>