<?php

$uri = $_SERVER[ 'REQUEST_URI' ] ;  // адреса запиту 
if( $uri == '/index' || $uri === '/about' ) {
	$page =  // змінні локалізуються тільки у функціях, оголошена поза функцією змінна доступна скрізь, у т.ч. в іншому файлі
		substr( $uri, 1 ) . '.php' ;  // у РНР оператор "+" діє тільки на числа, для рядків - оператор "."
	include '_layout.php' ;  // перехід до інструкцій в іншому файлі
}
else {
	echo 'access manager - 404' ;
}