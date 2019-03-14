<?php
	if (!empty($_POST['login']) ) {
        if(!strpos($_POST['login'],':') ) {//проверяем чтобы логин не содержал двоеточия
            $login = $_POST['login'];
            $pass = md5($_POST['password']);
            if(isset($_POST['name']) && isset($_POST['mail']) ) { //если значения name и mail в POST переданы(то есть была выбрана регистрация и заполнены поля), то регистрация
                if(!strpos($_POST['name'],':') && !strpos($_POST['mail'],':')) {//проверяем чтобы не содержали двоеточия 
                    $otherParams = [];
                    $otherParams['name'] = $_POST['name'];
                    $otherParams['mail'] = $_POST['mail'];
                    //регистрация
                    $user->registerUser($login, $pass, $otherParams);
                } else
                    print("<script language=javascript>window.alert('недопустимые данные ввода');</script>");
            }
            else   //если name и mail не введены значит пытаемся авторизоваться 
                $user->login($login, $pass);
        }
        else {//если логин содержит двоеточие
            print("<script language=javascript>window.alert('недопустимые данные ввода');</script>");
        }
    }
    if (!empty($_GET['logout'])) { //если нажали на выход - установилось значение logout=1(см.ниже)
                                // следовательно проверяем если значение в $_GET['logout'] есть, то
        $user->logout(); // то выходим
    }
?>