<?php
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <title>php</title>
  <!-- Compiled and minified CSS -->    
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<!--Import Google Icon Font-->      
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
<nav>    
<div class="nav-wrapper purple accent-3">    
  <a href="/" class="brand-logo">PHP</a>      
  <ul id="nav-mobile" class="right hide-on-med-and-down">       
  <li><a href="sass.html">Sass</a></li>        
  <li><a href="badges.html">Components</a></li>       
  <li><a href="collapsible.html">JavaScript</a></li>      
  </ul>    
  </div>  
  </nav>

  <div class="container">

  <h1>PHP.Вступ</h1>
  <p>
    Встановлення: потрібен веб-сервер(apache)
    та окремо PHP.
    Простіше за все встановити збірку на кшталт ХАМРР,
    у ній налаштовані взаємні конфігурації серверу та мови.
  </p>
  <p>
    Налаштування: при встановлені утворюється один локальний хост
    (localhost),він розміщений у папці htdocs(xampp)
    Можна видалити все з цієї папки та замінити на власний сайт.
    Віртуальний хост можна налаштувати через конфігурацію Apache
    редагуванням файлу /conf/extra/httpd-bhosts.conf(зразок у файлі).
    Якщо хосту задається власне ім*я,то його треба зазначити у DNS-файлі 
    системи(/windows/system32/drivers/etc/hosts).
    
    У локальному хості створюємо файл індекс.пхп
    Він є надбудовою над ХТМЛ, тобто довільний ХТМЛ файл є
    файл є валідним ПХП файлом.ПХП надає можливість додавати до ХТМЛ активність через 
    вставки &lt;?php код?> або для виразів &lt;?= вираз ?>
  </p>

  <p>
    <pre>
    <?php print_r( $_SERVER) ; ?>    
    </pre>
  </p>
</div>
</body>
 <!-- Compiled and minified JavaScript -->    
 <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</html>