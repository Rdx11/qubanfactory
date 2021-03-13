<?php

namespace App\DTO;

class GenericDTO
{
    //todo
    private $isForApi;

    /**
     * @return mixed
     */
    public function getisForApi()
    {
        return $this->isForApi;
    }

    /**
     * @param mixed $isForApi
     */
    public function setIsForApi($isForApi): void
    {
        $this->isForApi = $isForApi;
    }

}
