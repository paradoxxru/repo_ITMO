<?php
echo $message;
?>
<div>
	<form action="/" method="post">
	    <input type="text" placeholder="Логин" name="login">
	    <input type="passwordtext" placeholder="Пароль" name="password">
	    <input type="submit" value="Вход">
	</form>
</div>
<div>
	<form action="/" method="post">
		<div>
			<label><input type="text" name="login"></label>
			<label><input type="password" name="password"></label>
		</div>
		<div>
			<label><input type="email" name="email"></label>
			<label><input type="tel" name="phone"></label>
		</div>
		<input type="hidden" name="type" value="reg">
		<input type="submit" value="Регистрация">
	</form>
</div>