<?php

namespace App\DTO;

class ProductDTO extends GenericDTO
{
 	private $id_product;
    private $id_product_category;
    private $name;
    private $weight;
    private $price;
    private $image;
    private $stock;

    /**
     * @return mixed
     */
    public function getIdProduct()
    {
        return $this->id_product;
    }

    /**
     * @param mixed $id_product
     *
     * @return self
     */
    public function setIdProduct($id_product)
    {
        $this->id_product = $id_product;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdProductCategory()
    {
        return $this->id_product_category;
    }

    /**
     * @param mixed $id_product_category
     *
     * @return self
     */
    public function setIdProductCategory($id_product_category)
    {
        $this->id_product_category = $id_product_category;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     *
     * @return self
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     *
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     *
     * @return self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @param mixed $stock
     *
     * @return self
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }
}