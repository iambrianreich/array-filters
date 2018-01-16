<?php

/**
 * This file contains the RWC\Arrays\ChainedFilter class.
 *
 * @author    Brian Reich <breich@reich-consulting.net>
 * @copyright (C) 2018 Reich Web Consulting
 * @license   MIT
 */

namespace RWC\Arrays;

use RWC\Arrays\FilterInterface;

/**
 * An Array Filter that allows filters to be grouped and run in succession.
 *
 * To use ChainFilter, call the constructor by passing an array of objects that
 * implement FilterInterface, or call setFilter() to set the list of
 * filters after instantiation, or call addFilter() to add filters one at a
 * time. The addFilter() method returns a fluid interface which provides an
 * expressive way of defining complex filters.
 *
 * When the extractFilter() method is called, each chained extraction filter in
 * the order in which they were added.
 *
 * @author    Brian Reich <breich@reich-consulting.net>
 * @copyright (C) 2018 Reich Web Consulting
 * @license   MIT
 */
class ChainedFilter implements FilterInterface
{
    /**
     * The list of chained filters.
     *
     * @var array
     */
    private $filters = [];

    /**
     * Created a new ChainedFilter.
     *
     * The passed array must contain only instances of FilterInterface
     * which will be assigned immediately to the ChainedFilter in the order in
     * which they appear in the array.
     *
     * @param array $filters A list of 0 or more FilterInterface.
     */
    public function __construct(array $filters = [])
    {
        $this->setFilters($filters);
    }

    /**
     * Sets the list of filters assigned to the ChainedFilter.
     *
     * The passed array must contain only instances of FilterInterface
     * which will be assigned immediately to the ChainedFilter in the order in
     * which they appear in the array. Any filters that have already been
     * assigned to the ChainedFilter will be removed.
     *
     * @param array $filters A list of 0 or more FilterInterface.
     */
    public function setFilters(array $filters) : void
    {
        $this->clearFilters();
        array_walk($filters, function (FilterInterface $filter) {
            $this->addFilter($filter);
        });
    }

    /**
     * Appends an filter to the ChainedFilter.
     *
     * @param FilterInterface $filter The filter to append.
     */
    public function addFilter(FilterInterface $filter) : ChainedFilter
    {
        $this->filters[] = $filter;
        return $this;
    }

    /**
     * Clears the list of filters.
     *
     * Clears the lit of filters. This will result in a ChainedFilter that does
     * no filtering.
     *
     * @return  void
     */
    public function clearFilters() : void
    {
        $this->filters = [];
    }

    /**
     * Returns a list of filters assigned to the ChainedFilter.
     *
     * @return array Returns a list of filters assigned to the ChainedFilter.
     */
    public function getFilters() : array
    {
        return $this->filters;
    }

    /**
     * Filters the array through each chained filter in the order it was added.
     *
     * @param  array $data The array to filter.
     *
     * @return array Returns the filtered array.
     * @throws FilterException if filtering fails.
     */
    public function filter(array $data) : array
    {
        $data = $data;

        foreach ($this->getFilters() as $filter) {
            $data = $filter->filter($data);
        }

        return $data;
    }
}
