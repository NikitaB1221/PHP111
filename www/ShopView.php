<?php
// сторінка має надходити із запиту, а загальна кількість (last_page) - передаватись з контроллера


// Визначаємо максимальну та мінімальну ціни з наявної вибірки
if (is_array($products) && count($products) > 0) {
    $max_price = $products[0]['price'];
    $min_price = $max_price;
    foreach ($products as $product) {
        if ($product['price'] > $max_price) {
            $max_price = $product['price'];
        }
        if ($product['price'] < $min_price) {
            $min_price = $product['price'];
        }
    }
}

?>
<div class="row">
    <div class="col s2">
        <h4>Product groups</h4>

        <ul class="collection">
            <a href="?grp=all" class="collection-item">All</a>
            <?php foreach ($product_groups as $product_group): ?>
                <a href="?grp=<?= $product_group['url'] ?>" class="collection-item">
                    <?= $product_group['title'] ?>
                </a>
            <?php endforeach ?>
        </ul>
        <h4>By price</h4>
        <span>From</span> <input id='min-price-input' type="number" value="<?= $min_price ?>" />
        <span>Before</span> <input id='max-price-input' type="number" value="<?= $max_price ?>" />
        <button id="price-filter-button" class="waves-effect waves-light btn purple accent-3"><i
                class="material-icons right">cloud</i>Show</button>
    </div>
    <div class="col s10">
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col" style="width: 200px; height: 340px;">
                    <div class="card">
                        <div class="card-image">
                            <img src="/img/<?= $product['avatar'] ?>" style="height:150px">
                        </div>
                        <div class="card-content">
                            <span class="card-title" title="<?= $product['title'] ?>"
                                style="font-size:1.2vw;height: 32px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                                <?= $product['title'] ?>
                            </span>
                            <p>
                                <?= $product['description'] ?>
                            </p>
                            <p><b>Price:
                                    <?= $product['price'] ?>
                                </b></p>
                        </div>
                        <div class="card-action right-align">
                            <i class="material-icons">visibility</i>
                            <i style='display:inline-block;vertical-align:top;margin-right:20px'>123</i>
                            <a href="#"><i class="material-icons">shopping_cart</i></a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <!-- Paginator -->
    <!-- Paginator -->
    <?= $current_page ?> /
    <?= $last_page ?>
    <ul class="pagination">
        <li class="<?= $current_page == 1? "disabled" : "waves-effect" ?>"><a href="#1"><i class="material-icons">chevron_left</i></a></li>
        <?php for ($i = 1; $i < $last_page; $i += 1): ?>
            <li class="<?= $current_page == $i? "active" : "waves-effect" ?>">
                <a href="#<?= $i?>"><?= $i?></a>
            </li>
        <?php endfor ?>
        <li class="<?= $current_page == $last_page? "disabled" : "waves-effect" ?>"><i class="material-icons">chevron_right</i></a></li>
    </ul>
</div>