<?php

/**
 * This file contains the RWC\Arrays\IncludeFieldsFilter class.
 *
 * @author    Brian Reich <breich@reich-consulting.net>
 * @copyright (C) 2018 Reich Web Consulting
 * @license   MIT
 */

namespace RWC\Arrays;

use RWC\Arrays\FilterInterface;

/**
 * Strips fields from an array that aren't included in a whitelist.
 *
 * The IncludeFieldsFilter is configured with a list of fields to include in
 * the result set.  The fields are configured by passing them as a list to the
 * constructor, by setting the list via setIncludedFields(), or by adding them
 * individually via addIncludedField(). When filtered() executes, any
 * properties in the input array will be filtered from the output array.
 *
 * @author    Brian Reich <breich@reich-consulting.net>
 * @copyright (C) 2018 Reich Web Consulting
 * @license   MIT
 */
class IncludeFieldsFilter implements FilterInterface
{
    /**
     * The list of included fields
     *
     * @var array
     */
    private $includedFields;

    /**
     * Created a new IncludeFieldsFilter.
     *
     * The input array should be an array of strings which specifies the names
     * of any fields that should be included in the output array.
     *
     * @param array $includedFields A list of fields to include.
     */
    public function __construct(array $includedFields = [])
    {
        $this->setIncludedFields($includedFields);
    }

    /**
     * Sets the list of included fields.
     *
     * Sets the list of included properties. If any fields have already been
     * added, those fields will be cleared before setting the list.
     *
     * @param array $includedFields A list of fields to include.
     *
     * @return  IncludeFieldsFilter Returns a fluid interface.
     */
    public function setIncludedFields(array $includedFields = []) : IncludeFieldsFilter
    {
        $this->clearIncludedFields();

        array_walk($includedFields, function ($includedField) {
            $this->addIncludedField($includedField);
        });

        return $this;
    }

    /**
     * Clears the list of included fields.
     *
     * @return  IncludeFieldsFilter Returns a fluid interface.
     */
    public function clearIncludedFields() : IncludeFieldsFilter
    {
        $this->includedFields = [];

        return $this;
    }

    /**
     * Adds a field to the list of fields to include in output.
     *
     * @param string $includedField The field to include.
     *
     * @return  IncludeFieldsFilter Returns a fluid interface.
     */
    public function addIncludedField(string $includedField) : IncludeFieldsFilter
    {
        $this->includedFields[] = $includedField;

        return $this;
    }

    /**
     * Returns a list of fields to include in output.
     *
     * @return array Returns a list of included fields.
     */
    public function getIncludedFields() : array
    {
        return $this->includedFields;
    }
    
    /**
     * Filters out fields not explicitly included.
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
            // Only add included fields.
            if (in_array($key, $this->getIncludedFields())) {
                $filteredData[$key] = $value;
            }
        }

        return $filteredData;
    }
}
