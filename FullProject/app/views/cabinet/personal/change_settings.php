<?php
?>
<div class="content_changeSettings">
	<form action="/index.php?q=cabinet&cabinet=personal" method="post" enctype="multipart/form-data">
		<div>
			<label for="UserName">Имя</label>
			<input id="UserName" type="text" name="changeName" value="<?php echo $user->getUserName() ;?>">
		</div>
		<div>
			<label for="UserLogin">Логин</label>
			<input id="UserLogin" type="text" name="changeLogin" value="<?php echo $user->getLogin() ;?>">
		</div>
		<div>
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
			<div>
				<label for="UserAvatar">Сменить фото</label>
				<input id="UserAvatar" type="file" name="changeAvatar">
			</div>
		</div>
		<div>
			<label for="UserPhone">Телефон</label>
			<input id="UserPhone" type="text" name="changePhone" value="<?php echo $user->getPhone() ;?>">
		</div>
		<div>
			<label for="UserMail">Почта</label>
			<input id="UserMail" type="email" name="changeMail" value="<?php echo $user->getMail() ;?>">
		</div>
		<div>
			<label for="UserAddres">Адрес</label>
			<input id="UserAddres" type="text" name="changeAddres" value="<?php echo $user->getAddres() ;?>">
		</div>
		<div>
			<button type="submit">Сохранить изменения</button>
		</div>
	</form>
</div>