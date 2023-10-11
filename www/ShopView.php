<?php
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
        <button id="price-filter-button" class="waves-effect waves-light btn purple accent-3"><i class="material-icons right">cloud</i>Show</button>
    </div>
    <div class="col s10">
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col s12 m3 l2 xl3">
                    <div class="card">
                        <div class="card-image">
                            <img src="/img/<?= $product['avatar'] ?>" style="max-height:150px">
                        </div>
                        <div class="card-content">
                            <span class="card-title" style="font-size:1.2vw">
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

</div>