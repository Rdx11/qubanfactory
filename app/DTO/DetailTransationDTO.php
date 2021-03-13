<?php

namespace App\DTO;

class CartDTO extends GenericDTO
{
 	private $id_detail_transaction;
    private $id_transaction;
    private $id_product;
    private $quantity;
    private $item_price;
    private $total_price;

    /**
     * @return mixed
     */
    public function getIdDetailTransaction()
    {
        return $this->id_detail_transaction;
    }

    /**
     * @param mixed $id_detail_transaction
     *
     * @return self
     */
    public function setIdDetailTransaction($id_detail_transaction)
    {
        $this->id_detail_transaction = $id_detail_transaction;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdTransaction()
    {
        return $this->id_transaction;
    }

    /**
     * @param mixed $id_transaction
     *
     * @return self
     */
    public function setIdTransaction($id_transaction)
    {
        $this->id_transaction = $id_transaction;

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

    /**
     * @return mixed
     */
    public function getItemPrice()
    {
        return $this->item_price;
    }

    /**
     * @param mixed $item_price
     *
     * @return self
     */
    public function setItemPrice($item_price)
    {
        $this->item_price = $item_price;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->total_price;
    }

    /**
     * @param mixed $total_price
     *
     * @return self
     */
    public function setTotalPrice($total_price)
    {
        $this->total_price = $total_price;

        return $this;
    }
}