<?php

include __DIR__ . '/Controllers/ProductController.php';

use Controller\ProductController;

$productController = new ProductController;

echo $productController -> getAllProduct();