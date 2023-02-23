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
        try {
            if (isset($_GET['offset']) && isset($_GET['limit'])) {
                $offset = $_GET['offset'];
                $limit = $_GET['limit'];
            } else {
                $offset = NULL;
                $limit = NULL;
            }
            $products = $this->service->getAll($offset, $limit);
            $this->respond($products);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }

    public function getOne($id)
    {
        $product = $this->service->getOne($id);

        // we might need some kind of error checking that returns a 404 if the product is not found in the DB
        // check if product exists
        if ($product == null) {
            // header("HTTP/1.0 404 Not Found");
            // exit;
            $this->respondWithError(404, "Product not found");
            return;
        }
        $this->respond($product);
    }

    public function create()
    {
        try {
            $product = $this->createObjectFromPostedJson("Models\Product");
            // something is missing. Shouldn't we update the product in the DB?
            $product = $this->service->insert($product);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

        $this->respond($product);
    }

    public function update($id)
    {
        $updatedProduct = $this->service->getOne($id);

        if ($product = null){
            $this->respondWithError(404, "Product not found");
            return;
        }
        // There is no code here
        try{
            $product = $this->createObjectFromPostedJson("Models\Product");
            $this->service->update($product, $id);

            $this->respond($updatedProduct);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage()); 
        }
        $updatedProduct = $this->service->getOne($id);
    }

    public function delete($id){
        $product = $this->service->getOne($id);

        if ($product == null){
            $this->respondWithError(404, "Product not found");
            return;
        }

        try{
            $this->service->delete($id);
            $this->respond($product);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage()); 
        }
    }
}