<?php

class ProductsRepository extends BaseRepository
{
    public function getAll() {
        return $this->products;
    }

    public function getById($id) {
        foreach ($this->products as $index => $product) {
            if ($product->id == $id) {
                return $this->products[$index];
            }
        }
    }

    public function getByCategory($category, $getAvailableOnly = false) {
        $filteredProducts = array();

        if ($getAvailableOnly) {
            foreach($this->products as $product) {
                if ($product->category === $category && $product->quantity > 0)
                    array_push($filteredProducts, $product);
            }
        }
        else {
            foreach($this->products as $product) {
                if ($product->category === $category)
                    array_push($filteredProducts, $product);
            }
        }


        return $filteredProducts;
    }

    public function getCategoryNames() {
        $categories = array();
        foreach ($this->products as $product) {
            $categories[] = $product->category;
        }
        $uniqueCategories = array_unique($categories);

        return $uniqueCategories;
    }

    public function editProduct($id, $editedProduct) {
        foreach ($this->products as $index => $product) {
            if ($product->id == $id) {
                $this->products[$index] = $editedProduct;
            }
        }

        $_SESSION["products"] = $this->products;
    }

    public function addProduct($productToAdd) {
        $id = -1;
        foreach($this->products as $product) {
            if (strtolower($product->name) === strtolower($productToAdd->name)) {
                die("This product already exists");
            }

            if ($id < $product->id) {
                $id = $product->id;
            }
        }

        $productToAdd->id = $id;

        array_push($this->products, $productToAdd);
        array_push($_SESSION["products"], $productToAdd);
    }

    public function deleteProduct($productId) {
        foreach ($this->products as $index => $product) {
            if ($product->id == $productId) {
                unset($this->products[$index]);
                unset($_SESSION["products"][$index]);
            }
        }
    }
}