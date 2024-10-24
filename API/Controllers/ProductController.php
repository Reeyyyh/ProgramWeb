<?php
namespace Controller;

include __DIR__ . '/../Traits/ResponseFormatter.php';
include __DIR__ . '/Controller.php';

use Traits\ResponseFormatter;

class ProductController extends Controller{
    use ResponseFormatter;

    public function __construct()
    {
        $this -> controllerName = "Get All product";
        $this -> controllerMethod = "GET";
    }

    public function getALlProduct(){
        $dummyData = [
            "Air mineral",
            "Kebab",
            "Spagheti",
            "Jus jambu"
        ];

        $response = [
            "controller_attribute" => $this->getControllerAtribute(),
            "product" => $dummyData
        ];

        return $this -> responseFormatter(200, "Success", $response);
    }
};


