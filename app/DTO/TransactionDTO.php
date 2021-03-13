<?php

namespace App\DTO;

class TransactionDTO extends GenericDTO
{
 	private $id_transaction;
    private $id_user;
    private $amount;
    private $reference_code;
    private $status;
    
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
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     *
     * @return self
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReferenceCode()
    {
        return $this->reference_code;
    }

    /**
     * @param mixed $reference_code
     *
     * @return self
     */
    public function setReferenceCode($reference_code)
    {
        $this->reference_code = $reference_code;

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