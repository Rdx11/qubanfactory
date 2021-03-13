<?php

namespace App\DTO;

class ProductCategoriesDTO extends GenericDTO
{
 	private $id_product_category;
    private $name;

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
}