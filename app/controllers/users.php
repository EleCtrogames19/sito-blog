<?php

include(ROOT_PATH . "/app/database/db.php");
include(ROOT_PATH . "/app/helpers/validateUsers.php");

$errors = array();
$username = "";
$email = "";
$password = "";
$passwordConf = "";

if (isset($_POST['register-btn'])) {

    $errors = validateUser($_POST);

    if (count($errors) === 0) {
        unset($_POST['register-btn'], $_POST['passwordConf']);
        $_POST['admin'] = 0;
            //criptaggio della password
        $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $user_id = create('users', $_POST);
        $user = selectOne('users', ['id' => $user_id]);

        //dd($user);
        //log user in
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['admin'] = $user['admin'];
        $_SESSION['message'] = $user['You are now logged in'];
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/index.php');
        exit();

    } else {//se sta un errore salviamo comunque i dati
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConf = $_POST['passwordConf'];
    }
}
