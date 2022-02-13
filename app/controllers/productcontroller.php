<?php

namespace Controllers;

use Exception;
use Services\ProductService;

class ProductController extends Controller
{
    private $service;

    // initialize services
    function __construct()
    {
        $this->service = new ProductService();
    }

    public function getAll()
    {
        // this code seems to have been lost
    }

    public function getOne($id)
    {
        $product = $this->service->getOne($id);

        // we might need some kind of error checking that returns a 404 if the product is not found in the DB

        $this->respond($product);
    }

    public function create()
    {
        try {
            $product = $this->createObjectFromPostedJson("Models\Product");
            // something is missing. Shouldn't we update the product in the DB?

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($product);
    }

    public function update($id)
    {
        // There is no code here
    } 
}
