<?php ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .product-card {
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            max-width: 300px;
            margin: 0 auto;
            transition: transform 0.2s ease-in-out;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
        }

        .product-details {
            padding: 20px;
        }

        .product-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 18px;
            color: #f00;
        }

        .product-discount {
            font-size: 16px;
            color: #00f;
            margin-top: 5px;
        }

        .buy-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #bf00ff;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.2s ease-in-out;
        }

        .buy-button:hover {
            background-color: ##bf00ff;
        }
    </style>
</head>
<body>
    <div class="product-card">
        <img class="product-image" src="/img/6518573d41541.png" alt="Item Title">
        <div class="product-details">
            <h2 class="product-title">Item Title</h2>
            <p class="product-price">Prise: $100</p>
            <p class="product-discount">Sale: 10%</p>
            <a href="#" class="buy-button">Purchase</a>
        </div>
    </div>
</body>
</html>