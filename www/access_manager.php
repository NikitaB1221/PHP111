<?php

$uri = $_SERVER['REQUEST_URI']; //  request addresses 
$router = [
	'/' => 'index.php',
	'/index' => 'index.php',
	'/about' => 'about.php',
	'/forms' => 'forms.php',
];
$router['/db'] = 'db.php';
// if( $uri == '/index' || $uri === '/about'|| $uri === '/db' ) {
	if( isset( $router[$uri] ) ) {
		if( $_SERVER[ 'REQUEST_METHOD' ] == 'PUT' ) {  // робота з формами
			include $router[$uri] ;  // без шаблону - на файл
		}
		else {	
			$page =  // змінні локалізуються тільки у функціях, оголошена поза функцією змінна доступна скрізь, у т.ч. в іншому файлі
				$router[$uri] ;  // у РНР оператор "+" діє тільки на числа, для рядків - оператор "."
			include '_layout.php' ;  // перехід до інструкцій в іншому файлі
		}
	}
	else {
		echo 'access manager - 404' ;
	}