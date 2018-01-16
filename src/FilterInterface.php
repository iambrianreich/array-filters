<?php

/**
 * This file contains the RWC\Arrays\FilterInterface interface.
 *
 * @author    Brian Reich <breich@reich-consulting.net>
 * @copyright (C) 2018 Reich Web Consulting
 * @license   MIT
 */

namespace RWC\Arrays;

use RWC\Arrays\FilterException;

/**
 * Filters an array.
 *
 * The FilterInterface is about as simple as it gets.  It accepts an array, and
 * returns an array. The specific filter provides the the logic of how the
 * original array is filtered or modified into the result array.
 *
 * @author    Brian Reich <breich@reich-consulting.net>
 * @copyright (C) 2018 Reich Web Consulting
 * @license   MIT
 */
interface FilterInterface
{
    /**
     * Filters an array and returns the result.
     *
     * @param  array $data The array to filter.
     *
     * @return array Returns the filtered array.
     * @throws FilterException if filtering fails.
     */
    public function filter(array $data) : array;
}
