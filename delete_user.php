<?php
session_start();
require_once 'src/UserRepository.php';
$newUser = new UserRepository("json_files/users.json");
$newUser->deleteUserById($_SESSION['id']);
header('Location: articles.php');
exit;
