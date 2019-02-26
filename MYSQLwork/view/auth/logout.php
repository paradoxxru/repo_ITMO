<?php
echo $message;
?>

Пользователь: <?php echo $user->getUserName(); ?>, <a href="/?action=logout">Выход</a>
<?php
$avatar = $user->getAvatar();
echo "avatar ".$avatar;
if($avatar) {
	echo "<img height='100px' width='100px' src='/img/avatars/{$avatar}' />";
}
echo "$avatar<br>";
?>
<img height='100px' width='100px' src='/img/avatars/1.jpg' />
<div>
	<form action="/" method="post" enctype="multipart/form-data">
		<div><label>Аватар<input type="file" name="avatar"></label></div>
		<input type="submit" value="загрузить">
	</form>
</div>