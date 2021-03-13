<?php

namespace App\DTO;

class UserAddressDTO extends GenericDTO
{
 	private $id_user_address;
    private $id_user;
    private $id_city;
    private $title;
    private $street;
    private $postCode;
    
    /**
     * @return mixed
     */
    public function getIdUserAddress()
    {
        return $this->id_user_address;
    }

    /**
     * @param mixed $id_user_address
     *
     * @return self
     */
    public function setIdUserAddress($id_user_address)
    {
        $this->id_user_address = $id_user_address;

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
    public function getIdCity()
    {
        return $this->id_city;
    }

    /**
     * @param mixed $id_city
     *
     * @return self
     */
    public function setIdCity($id_city)
    {
        $this->id_city = $id_city;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     *
     * @return self
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * @param mixed $postCode
     *
     * @return self
     */
    public function setPostCode($postCode)
    {
        $this->postCode = $postCode;

        return $this;
    }
}