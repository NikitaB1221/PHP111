<?php
	$plain_array = [ 10, 20, 30, 40 ] ;
	$data = [
		'mon' => 10,
		'tue' => 20,
		'wed' => 15,
		'thu' => 18,
		'fri' => 7,
	] ;
?>
<h1>About</h1>
<p>
	PHP - Hypertext PreProcessor - мова програмування, початково
	призначена для перед-оброблення HTML. З файлу РНР утворюється
	код HTML шляхом пророблення спеціальних вставок.
	З розвитком мова стала самостійною, але частіше за все використовується
	для веб-задач.
</p>
<p>
	РНР є інтерпретованою (REPL) мовою з динамічною типізацією та
	динамічним утворенням змінних. Змінні з'являються від моменту
	їх присвоєння, перевірити наявність змінною можна операцією
	<code>isset()</code>. Звертання до неіснуючої змінної видає помилку,
	але ряд функцій блокують цю помилку, роблячи виклик безпечним.
</p>
<p>
	Мова є процедурною, з підтримкою ООП. Працює швидко.
	Асоціативність масивів робить їх схожими на об'єкти JS, що
	дозволяє використовувати ідеї прототипного програмування.
</p>
<p>
	РНР розроблявся з концепцією "другої мови програмування", тобто
	зручною для переходу з багатьох інших мов (перших мов). Тому
	у мові багато альтернатив, на кшталт операторів || та or,
	операторів echo "123" та функції print("123"),
	split - explode, і так далі.
</p>

<ul class="collection">
<?php foreach( $plain_array as $val ) { ?>
		<li class="collection-item">
			<?= $val ?>
		</li>
<?php } ?>
</ul>

<table>
<thead>
	<tr>
		<th>day</th>
		<th>profit</th>
	</tr>
</thead>
<tbody>
<?php foreach( $data as $day => $profit ) : ?>
   <tr>
       <td><?= $day ?></td>
       <td><?= $profit ?></td>
   </tr>
<?php endforeach ?>
</tbody>
</table>