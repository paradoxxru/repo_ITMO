<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 12.01.2019
 * Time: 13:25
 */


class User
{
    private $login = 'anonimous';
    private $token;
    private $user_name;
    private $user_mail;
    private $is_auth = false;
    private $permissions = [
        'view_profile' => false
    ];

    public function isAuth() {
        return $this->is_auth;
    }
    public function login($login, $pass) {
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
    public function logout() {

    }
    public function registration($login, $password, $params) {

    }
    public function hasPermission($action) {
        if(isset($this->permissions[$action])) {
            return $this->permissions[$action];
        }
        return false;
    }
    public function __construct()
    {

    }
    public function getAllPermissions() {
        return $this->permissions;
    }
}