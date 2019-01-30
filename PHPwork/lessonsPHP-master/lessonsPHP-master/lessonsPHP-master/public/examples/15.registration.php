<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 25.12.2018
 * Time: 19:45
 */

function printFormLogin(){
    echo "
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
    ";
}
function login() {
    $login = $_POST['login'];
    $pass = md5($_POST['password']);
    if(hasUser($login)) {
        // Есть такой пользователь
        // @todo Сделать проверку на корректный пароль
        if(strcmp(getPassword($login), $pass) === 0) {
            // setcookie('login', $login);
            $_SESSION['login'] = $login;
            $_SESSION['token'] = getToken();
        } else {
            return false;
        }
        // $pass = getPassword($login);
    } else {
        // Такого пользователя нет
        registerUser($login, $pass);
        // setcookie('login', $login);
        $_SESSION['login'] = $login;
        $_SESSION['token'] = getToken();
    }
    return true;
}

function hasUser($login) {
    $users = file('users.db');
    foreach($users as $user) {
        if(strpos($user, $login . ':') === 0)
            return true;
    }
    return false;
}
function getPassword($login) {
    $password = false;
    $users = file('users.db');
    foreach($users as $user) {
        if(strpos($user, $login . ':') === 0) {
            $password = substr(trim($user), strlen($login) + 1);
            break;
        }
    }
    return $password;
}

function isLogin() {
    $token = getToken();
    return (!empty($_SESSION['login']) && (strcmp($token, $_SESSION['token'])===0));
//    return (!empty($_SESSION['login']));
}
function registerUser($login, $pass) {
    file_put_contents(
        'users.db',
        $login . ':' . $pass . "\n",
        FILE_APPEND
    );
}
function getUserName() {
    return $_SESSION['login'];
}

function logout() {
    // setcookie('login');
    unset($_SESSION['login']);
}

function getToken() {
    return md5($_SESSION['login'] .
        $_SERVER['HTTP_USER_AGENT'] .
        $_SERVER['REMOTE_ADDR']
    );
//    $_SERVER['HTTP_X_REAL_IP']
}