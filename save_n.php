<?php
require_once('db/noun.php');

$n = htmlspecialchars($_POST['n']);
$exp = htmlspecialchars($_POST['exp']);

Noun::update($n, $exp);

header('location: view.php?n='.$n.'&exp='.$exp);