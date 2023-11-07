<h1>Cart - a place with your ordered items</h1>
<?php if (empty($_CONTEXT['user'])): ?>
    <p>
        Cart is available only to authorized users. Please log in.
    </p>
<?php else:
    if (empty($_CONTEXT['cart'])): ?>
        <p>
            Cart is empty. It's time to order something from the <a href="/shop">shop page</a>.
        </p>
    <?php else: ?>
        There will be your items.
        <table>
            <tr>
                <th>ID</th>
                <th>ID_Cart</th>
                <th>ID_Product</th>
                <th>Count</th>
            </tr>
            <?php foreach ($_CONTEXT['orders'] as $item): ?>
                <tr>
                    <td><?php echo $item['id']; ?></td>
                    <td><?php echo $item['id_cart']; ?></td>
                    <td><?php echo $item['id_product']; ?></td>
                    <td><?php echo $item['count']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif ?>
<?php endif ?>