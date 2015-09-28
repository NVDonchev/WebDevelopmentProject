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

    public function getByCategory($category) {
        $filteredProducts = array();
        foreach($this->products as $product) {
            if ($product->category === $category)
                array_push($filteredProducts, $product);
        }

        return $filteredProducts;

        $uniqueCategories = $this->getDistrictCategories();
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
    }
}