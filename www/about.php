<?php
$data = [
    'mon' => 23,
    'tue' => 15,
    'wed' => 21,
    'thu' => 13,
    'fri' => 35,
];
?>
<h1>About</h1>
<p>
    <code>isset()</code>
</p>
<ul class="collection">

    <?php foreach ($data as $val) { ?>
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
        <?php foreach ($data as $day => $profit): ?>
            <tr>
                <td>
                    <?= $day ?>
                </td>
                <td>
                    <?= $profit ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<br>