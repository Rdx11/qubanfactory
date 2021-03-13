<?php

namespace App\DTO;

class CartDTO extends GenericDTO
{
 	private $id_delivery_info;
    private $id_transaction;
    private $sender_phone;
    private $consignee_phone;
    private $delivery_date;
    private $arrival_estimation;
    private $status;

    /**
     * @return mixed
     */
    public function getIdDeliveryInfo()
    {
        return $this->id_delivery_info;
    }

    /**
     * @param mixed $id_delivery_info
     *
     * @return self
     */
    public function setIdDeliveryInfo($id_delivery_info)
    {
        $this->id_delivery_info = $id_delivery_info;

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
    public function getSenderPhone()
    {
        return $this->sender_phone;
    }

    /**
     * @param mixed $sender_phone
     *
     * @return self
     */
    public function setSenderPhone($sender_phone)
    {
        $this->sender_phone = $sender_phone;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getConsigneePhone()
    {
        return $this->consignee_phone;
    }

    /**
     * @param mixed $consignee_phone
     *
     * @return self
     */
    public function setConsigneePhone($consignee_phone)
    {
        $this->consignee_phone = $consignee_phone;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeliveryDate()
    {
        return $this->delivery_date;
    }

    /**
     * @param mixed $delivery_date
     *
     * @return self
     */
    public function setDeliveryDate($delivery_date)
    {
        $this->delivery_date = $delivery_date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArrivalEstimation()
    {
        return $this->arrival_estimation;
    }

    /**
     * @param mixed $arrival_estimation
     *
     * @return self
     */
    public function setArrivalEstimation($arrival_estimation)
    {
        $this->arrival_estimation = $arrival_estimation;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }
}