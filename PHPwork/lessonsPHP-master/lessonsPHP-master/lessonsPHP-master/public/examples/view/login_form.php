<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 12.01.2019
 * Time: 13:54
 */
?>

<form method='post' action='/'>
    <div>
        <label for='Login'>Логин </label>
        <input id='Login' name='login' placeholder='Логин'/>
    </div>
    <div>
        <label for='Password'>Пароль </label>
        <input
            id='Password'
            name='password'
            type='password'
            placeholder='Пароль'
        />
    </div>
    <button>Войти</button>
</form>
