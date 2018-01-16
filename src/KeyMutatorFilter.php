<?php

/**
 * This file contains the RWC\Arrays\KeyMutatorFilter class.
 *
 * @author    Brian Reich <breich@reich-consulting.net>
 * @copyright (C) 2018 Reich Web Consulting
 * @license   MIT
 */

namespace RWC\Arrays;

use RWC\Arrays\FilterInterface;

/**
 * Filters an extracted array by passing the keys through a user function.
 *
 * The KeyMutatorFilter allows generic filtering of array keys in an array.
 * Pass a callable function which accepts a single string parameter and
 * returns a modified string. The array returned by filter() will return
 * the input array with the keys modified by the callable's logic. This can be
 * useful for appending/prepending prefixes and suffixes to keys, switching
 * naming conventions to/from camel case, and more.
 *
 * @author    Brian Reich <breich@reich-consulting.net>
 * @copyright (C) 2018 Reich Web Consulting
 * @license   MIT
 */
class KeyMutatorFilter implements FilterInterface
{
    /**
     * The callable used to mutate keys.
     *
     * @var callable
     */
    private $mutator;

    /**
     * Creates a KeyMutatorFilter.
     *
     * @param callable $mutator The user function used to filter keys.
     */
    public function __construct(callable $mutator)
    {
        $this->setMutator($mutator);
    }

    /**
     * Sets the user function used to filter keys.
     *
     * @param callable $mutator The user function used to filter keys.
     */
    public function setMutator(callable $mutator)
    {
        $this->mutator = $mutator;
    }

    /**
     * Gets the user function used to filter keys.
     *
     * @return callable Returns the mutator function.
     */
    public function getMutator() : callable
    {
        return $this->mutator;
    }

    /**
     * Returns the input array with keys modified by the mutator function logic.
     *
     * The filter() method will pass each key/index in the input array as the
     * first parameter to the mutator function configured on the filter. The
     * value returned by the mutation function will be used as the new key and
     * to the original value.
     *
     * There are no rules enforced in this filter except that the mutator's
     * return value must be a valid array key or index. The mutation function's
     * logic could result in duplicate keys overwriting each other, and it is
     * the implementation's responsibility to decide if that's accetable.
     *
     * @param  array $data The array to filter.
     *
     * @return array Returns the filtered array.
     * @throws FilterException if filtering fails.
     */
    public function filter(array $data) : array
    {
        $filteredData = [];

        foreach ($data as $key => $value) {
            $filteredData[ $this->getMutator()($key)] = $value;
        }

        return $filteredData;
    }
}
