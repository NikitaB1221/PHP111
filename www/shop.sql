CREATE TABLE product_groups (
    `id`  BIGINT PRIMARY KEY  DEFAULT UUID_SHORT(),
    `title` VARCHAR(64) NOT NULL,
    `description` TEXT NULL,
    `avatar` VARCHAR(256) NULL
) ENGINE = InnoDB, DEFAULT CHARSET = UTF8

CREATE TABLE product_actions (
    `id`  BIGINT PRIMARY KEY  DEFAULT UUID_SHORT(),
    `title` VARCHAR(64) NOT NULL,
    `description` TEXT NULL,
    `discount` FLOAT NOT NULL
) ENGINE = InnoDB, DEFAULT CHARSET = UTF8

CREATE TABLE products (
    `id`  BIGINT PRIMARY KEY  DEFAULT UUID_SHORT(),
    `id_group` BIGINT NOT NULL,
    `title` VARCHAR(64) NOT NULL,
    `description` TEXT NULL,
    `avatar` VARCHAR(256) NULL,
    `price`  FLOAT NOT NULL,
    `id_action` BIGINT NULL,
    `delete_dt` DATETIME NULL
) ENGINE = InnoDB, DEFAULT CHARSET = UTF8

INSERT INTO product_groups (`title`) VALUES ('Glass products');
INSERT INTO product_groups (`title`) VALUES ('Wood products');
INSERT INTO product_groups (`title`) VALUES ('Stone products');
INSERT INTO product_groups (`title`) VALUES ('Office products');



INSERT INTO product () VALUES (id_group,title,avatar,price) VALUES ((SELECT id FROM product_groups WHERE title='Glass products'),'Christmas ball','glass1.png',300);

INSERT INTO products (`id_group`, `title`, `avatar`, `price`)
VALUES ( 
    (SELECT id FROM product_groups WHERE `title`='Glass products'),
    'Christmas ball', 'glass1.png', 300
)

INSERT INTO products (`id_group`, `title`, `avatar`, `price`)
VALUES ( 
    (SELECT id FROM product_groups WHERE `title`='Glass products'),
    'Glass bull', 'glass2.png', 300
);

INSERT INTO products (`id_group`, `title`, `avatar`, `price`)
VALUES ( 
    (SELECT id FROM product_groups WHERE `title`='Glass products'),
    'Sphere with a helicopter', 'glass3.png', 300
);

INSERT INTO products (`id_group`, `title`, `avatar`, `price`)
VALUES ( 
    (SELECT id FROM product_groups WHERE `title`='Wood products'),
    'Wooden basket', 'wood1.png', 300
);
VALUES ( 
    (SELECT id FROM product_groups WHERE `title`='Wood products'),
    'Wooden mace', 'wood2.png', 1500
);
VALUES ( 
    (SELECT id FROM product_groups WHERE `title`='Wood products'),
    'Wooden mug', 'wood3.png', 1000
);

ALTER TABLE `product_groups` 
ADD `url` VARCHAR(32) CHARACTER 
SET utf8 COLLATE utf8_unicode_ci NULL 
AFTER `avatar`, 
ADD UNIQUE `uri_index` (`url`);

INSERT INTO products (`id_group`, `title`, `avatar`, `price`)
VALUES ( 
    (SELECT id FROM product_groups WHERE `title`='Stone products'),
    'Stone candlesticks', 'stone1.png', 1000
);

INSERT INTO products (`id_group`, `title`, `avatar`, `price`)
VALUES ( 
    (SELECT id FROM product_groups WHERE `title`='Stone products'),
    'Stone pots', 'stone2.png', 1250
);

INSERT INTO products (`id_group`, `title`, `avatar`, `price`)
VALUES ( 
    (SELECT id FROM product_groups WHERE `title`='Stone products'),
    'Stone night light', 'stone3.png', 1150
);

INSERT INTO products (`id_group`, `title`, `avatar`, `price`)
VALUES ( 
    (SELECT id FROM product_groups WHERE `title`='Office products'),
    'Office chair', 'office1.png', 2500
);

INSERT INTO products (`id_group`, `title`, `avatar`, `price`)
VALUES ( 
    (SELECT id FROM product_groups WHERE `title`='Office products'),
    'Office table', 'office2.png', 3000
);

INSERT INTO products (`id_group`, `title`, `avatar`, `price`)
VALUES ( 
    (SELECT id FROM product_groups WHERE `title`='Office products'),
    'Office lamp', 'office3.png', 2350
);

INSERT INTO products (`id_group`, `title`, `avatar`, `price`)
VALUES ( 
    (SELECT id FROM product_groups WHERE `title`='Office products'),
    'Office table clock', 'office4.png', 1245
);

INSERT INTO product_actions (`title`,`description`,`discount`)
VALUES ('Halloween sale', 'Valid on the night of October 31-32', 10 );

INSERT INTO product_actions (`title`,`description`,`discount`)
VALUES ('New Year Sale', 'A week before and a week after the New Year', 15 );

INSERT INTO product_actions (`title`,`description`,`discount`)
VALUES ('Sale', 'Until the end of the product', 20 );


CREATE TABLE shop_cart_order(
    `id` BIGINT PRIMARY KEY DEFAULT UUID_SHORT(),
    `id_user` BIGINT NULL,
    `create_dt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `order_dt` DATETIME NULL,
    `delete_dt` DATETIME NULL  
) ENGINE = InnoDB, DEFAULT CHARSET = UTF8;

CREATE TABLE shop_cart_item (
    `id` BIGINT PRIMARY KEY DEFAULT UUID_SHORT(),
    `id_cart` BIGINT NULL,
    `id_product` BIGINT NOT NULL,
    `count` INT NOT NULL DEFAULT 1
) ENGINE = InnoDB, DEFAULT CHARSET = UTF8;