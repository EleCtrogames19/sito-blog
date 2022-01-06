<?php
function validateUser($user)
{


    $errors = array();
        //vari errori
    if (empty($user['username'])) {
        array_push($errors, 'Username is required');
    }
    if (empty($user['email'])) {
        array_push($errors, 'Email is required');
    }
    if (empty($user['password'])) {
        array_push($errors, 'Password is required');
    }
    if (empty($user['passwordConf'])) {
        array_push($errors, 'Password Cofermation do not is insert');
    }
    if ($user['passwordConf'] !== $user['password']) {
        array_push($errors, 'Password do not match');
    }
//email o username esistenti
$existingUser1 = selectOne('users', ['email'=> $user['email']]);
if (isset($existingUser1)){
   array_push($errors, 'Email already exists');
}
$existingUser2 = selectOne('users', ['username'=> $user['username']]);
if (isset($existingUser2)){
   array_push($errors, 'Username already exists');
}

    return $errors;
}
