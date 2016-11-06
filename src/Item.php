<?php


class Item {

    private $id;
    private $name;
    private $price;
    private $category;
    private $description;
    private $quantityOnStock;

    public function __construct() {
        $this->id = - 1;
        $this->name = '';
        $this->price = 0;
        $this->category = 0;
        $this->description = '';
        $this->quantityOnStock = 0;
    }


    public function getId() {
        return $this->id;
    }


    public function getName() {
        return $this->name;
    }


    public function setName($name) {
        if (is_string($name) && strlen(trim($name)) > 0) {
            $this->name = trim($name);
        }
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        if (is_numeric($price) && $price >= 0) {
            $this->price = trim($price);
        }
    }

    public function getCategory() {
        return $this->category;
    }


    public function setCategory($category) {
        if (is_int($category) && $category >= 0) {
            $this->category = trim($category);
        }
    }

    public function getDescription() {
        return $this->description;
    }


    public function setDescription($description) {
        if (is_string($description) && strlen(trim($description)) > 0) {
            $this->description = trim($description);
        }
    }


    public function getQuantityOnStock() {
        return $this->quantityOnStock;
    }


    public function setQuantityOnStock($quantityOnStock) {
        if (is_int($quantityOnStock) && $quantityOnStock >= 0) {
            $this->quantityOnStock = trim($quantityOnStock);
        }
    }

}