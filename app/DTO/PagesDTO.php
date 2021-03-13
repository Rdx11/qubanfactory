<?php

namespace App\DTO;

class PagesDTO extends GenericDTO
{
 	private $id_pages;
    private $titles;
    private $content;
    private $category;
    
    /**
     * @return mixed
     */
    public function getIdPages()
    {
        return $this->id_pages;
    }

    /**
     * @param mixed $id_pages
     *
     * @return self
     */
    public function setIdPages($id_pages)
    {
        $this->id_pages = $id_pages;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitles()
    {
        return $this->titles;
    }

    /**
     * @param mixed $titles
     *
     * @return self
     */
    public function setTitles($titles)
    {
        $this->titles = $titles;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     *
     * @return self
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     *
     * @return self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }
}