<?php

namespace App\Model\Mutation;

use App\Entity\Category;

class Filter
{
    /**
     * @var \DateTimeInterface
     */
    private $startDate;

    /**
     * @var \DateTimeInterface
     */
    private $endDate;

    /**
     * @var Category
     */
    private $category;

    /**
     * @return \DateTimeInterface
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param \DateTimeInterface $startDate
     * @return Filter
     */
    public function setStartDate(\DateTimeInterface $startDate = null): Filter
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param \DateTimeInterface $endDate
     * @return Filter
     */
    public function setEndDate(\DateTimeInterface $endDate = null): Filter
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return Filter
     */
    public function setCategory(Category $category = null): Filter
    {
        $this->category = $category;
        return $this;
    }
}
