<?php

namespace App\DTO;

class CartDTO extends GenericDTO
{
 	private $id_cart;
    private $id_user;
    private $id_product;
    private $quantity;

    /**
     * @return mixed
     */
    public function getIdCart()
    {
        return $this->id_cart;
    }

    /**
     * @param mixed $id_cart
     *
     * @return self
     */
    public function setIdCart($id_cart)
    {
        $this->id_cart = $id_cart;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     *
     * @return self
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

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
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     *
     * @return self
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }
}