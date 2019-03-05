<?php
?>
<h3>Личные данные пользователя</h3>
<div class="content_userPersonal">
	<div>
		<?php
			$avatar = $user->getAvatar();
			if($avatar)
				$src = $avatar;
			else
				$src = 'no_foto2.png';
		?>
		<img src="assets/images/avatars/<?php echo $src ;?>" alt='фото'>	
	</div>
	<div class="data_user">
		<span>Имя : <b><?php echo $user->getUserName();?></b></span>
		<span>Логин : <b><?php echo $user->getLogin();?></b></span>
		<span>Почта : <b><?php echo $user->getMail();?></b></span>
		<span>Телефон : <b><?php echo $user->getPhone();?></b></span>
		<span>Адрес доставки : <b><?php echo $user->getAddres();?></b></span>
		<div>
			<br>
			<a href="/index.php?q=cabinet&cabinet=personal&settings=change">Редактировать личные данные</a>
		</div>
	</div>
	<!--
	<div>
		<div>
			<form action="/index.php?q=cabinet&cabinet=personal" method="post" enctype="multipart/form-data">
				<div>
					<label>Сменить фото<input type="file" name="avatar"></label>
				</div>
				<input type="submit" value="загрузить">
			</form>

		</div>
	</div>
	-->

</div>