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
            <thead>
                <tr>
                    <th>№</th>
                    <th>Title</th>
                    <th>Count</th>
                    <th>Price</th>
                    <th>Price/Count</th>
                </tr>
            </thead>
            <tbody>
                <?php $cnt = 0;
                $sum = 0;
                foreach ($_CONTEXT['orders'] as $index => $item):
                    $cnt += $item['count'];
                    $sum += $item['price'] * $item['count']; ?>
                    <tr>
                        <td>
                            <?= $index + 1 ?>
                        </td>
                        <td>
                            <?= $item['title'] ?>
                        </td>
                        <td>
                            <?= $item['count'] ?>
                        </td>
                        <td>
                            <?= $item['price'] ?>
                        </td>
                        <td>
                            <?= $item['price'] * $item['count'] ?>
                        </td>
                        <td>
                            <button data-cart-inc="<?= $item['id_product'] ?>">
                                <i class="material-icons">add_circle</i>
                            </button>
                            <button data-cart-dec="<?= $item['id_product'] ?>">
                                <i class="material-icons">do_not_disturb_on</i>
                            </button>
                            <button data-cart-del="<?= $item['id_product'] ?>">
                                <i class="material-icons">delete_forever</i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan=3>Full price</th>
                    <td>
                        <?= $cnt ?>
                    </td>
                    <td>
                        <?= $sum ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    <?php endif ?>
<?php endif ?>