<?php

/**
 * This file contains the RWC\Arrays\ExcludeFieldsFilter class.
 *
 * @author    Brian Reich <breich@reich-consulting.net>
 * @copyright (C) 2018 Reich Web Consulting
 * @license   MIT
 */

namespace RWC\Arrays;

use RWC\Arrays\FilterInterface;

/**
 * Strips fields from an array.
 *
 * The ExcludeFieldsFilter is configured with a list of fields to exclude from
 * the result set.  The fields are configured by passing them as a list to the
 * constructor, bt setting the list via setExclusions(), or by adding them
 * individually via addExclusion(). When filtered() executes, any
 * properties in the input array will be filtered from the output array.
 *
 * @author    Brian Reich <breich@reich-consulting.net>
 * @copyright (C) 2018 Reich Web Consulting
 * @license   MIT
 */
class ExcludeFieldsFilter implements FilterInterface
{
    /**
     * The list of exclusions
     *
     * @var array
     */
    private $exclusions;

    /**
     * Created a new ExcludeFieldsFilter.
     *
     * The input array should be an array of strings which specifies the names
     * of any fields that should be excluded from the filtered output array.
     *
     * @param array $exclusions A list of fields to exclude.
     */
    public function __construct(array $exclusions = [])
    {
        $this->setExclusions($exclusions);
    }

    /**
     * Sets the list of excluded fields.
     *
     * Sets the list of excluded properties. If any fields have already been
     * added, those fields will be cleared before setting the exclusions list.
     *
     * @param array $exclusions A list of fields to exclude.
     *
     * @return  ExcludeFieldsFilter Returns a fluid interface.
     */
    public function setExclusions(array $exclusions = []) : ExcludeFieldsFilter
    {
        $this->clearExclusions();

        array_walk($exclusions, function ($exclusion) {
            $this->addExclusion($exclusion);
        });

        return $this;
    }

    /**
     * Returns the list of exclusions.
     *
     * @return  ExcludeFieldsFilter Returns a fluid interface.
     */
    public function clearExclusions() : ExcludeFieldsFilter
    {
        $this->exclusions = [];

        return $this;
    }

    /**
     * Adds an exclusion to the list of fields to exclude from output.
     *
     * @param string $exclusion The field to exclude.
     *
     * @return  ExcludeFieldsFilter Returns a fluid interface.
     */
    public function addExclusion(string $exclusion) : ExcludeFieldsFilter
    {
        $this->exclusions[] = $exclusion;

        return $this;
    }

    /**
     * Returns a list of fields to exclude from output.
     *
     * @return array Returns a list of exclusions.
     */
    public function getExclusions() : array
    {
        return $this->exclusions;
    }
    
    /**
     * Filters excluded fields from the array.
     *
     * @param  array $data The array to filter.
     *
     * @return array Returns the filtered arra.
     * @throws FilterException if filtering fails.
     */
    public function filter(array $data) : array
    {
        $filteredData = [];

        foreach ($data as $key => $value) {
            // Skip all excluded fields
            if (in_array($key, $this->getExclusions())) {
                continue;
            }

            $filteredData[$key] = $value;
        }

        return $filteredData;
    }
}
