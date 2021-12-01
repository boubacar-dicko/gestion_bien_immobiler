<?php


namespace App\Entity;
class BienSearch
{
    /*
     * @var int|null
     */
    private  $maxPrice;

    /*
     * @var int|null
     */
    private  $minSurface;

    /**
     * @return mixed
     */
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * @param mixed $maxPrice
     * @return BienSearch
     */
    public function setMaxPrice($maxPrice)
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMinSurface()
    {
        return $this->minSurface;
    }

    /**
     * @param mixed $minSurface
     * @return BienSearch
     */
    public function setMinSurface($minSurface)
    {
        $this->minSurface = $minSurface;
        return $this;
    }

}
