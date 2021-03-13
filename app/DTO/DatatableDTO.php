<?php
namespace App\DTO;

class DatatableDTO extends GenericDTO {
    private $limit;
    private $search;
    private $start;
    private $order;
    private $dir;
    private $draw;
    private $is_filter;
    private $from;
    private $untill;
    private $data;
    private $bulan;
    private $tahun;

    /**
     * @return mixed
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * @param mixed $limit
     *
     * @return self
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSearch()
    {
        return $this->search;
    }

    /**
     * @param mixed $search
     *
     * @return self
     */
    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @param mixed $start
     *
     * @return self
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     *
     * @return self
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * @param mixed $dir
     *
     * @return self
     */
    public function setDir($dir)
    {
        $this->dir = $dir;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDraw()
    {
        return $this->draw;
    }

    /**
     * @param mixed $draw
     *
     * @return self
     */
    public function setDraw($draw)
    {
        $this->draw = $draw;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsFilter()
    {
        return $this->is_filter;
    }

    /**
     * @param mixed $is_filter
     *
     * @return self
     */
    public function setIsFilter($is_filter)
    {
        $this->is_filter = $is_filter;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     *
     * @return self
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUntill()
    {
        return $this->untill;
    }

    /**
     * @param mixed $untill
     *
     * @return self
     */
    public function setUntill($untill)
    {
        $this->untill = $untill;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     *
     * @return self
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBulan()
    {
        return $this->bulan;
    }

    /**
     * @param mixed $bulan
     *
     * @return self
     */
    public function setBulan($bulan)
    {
        $this->bulan = $bulan;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTahun()
    {
        return $this->tahun;
    }

    /**
     * @param mixed $tahun
     *
     * @return self
     */
    public function setTahun($tahun)
    {
        $this->tahun = $tahun;

        return $this;
    }
}
