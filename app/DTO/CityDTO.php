<?php

namespace App\DTO;

class CartDTO extends GenericDTO
{
 	private $id_city;
    private $id_province;
    private $name;

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
    public function getIdProvince()
    {
        return $this->id_province;
    }

    /**
     * @param mixed $id_province
     *
     * @return self
     */
    public function setIdProvince($id_province)
    {
        $this->id_province = $id_province;

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
}