<?php

/**
 * This file contains the RWC\Arrays\KeyReplacementFilter class.
 *
 * @author    Brian Reich <breich@reich-consulting.net>
 * @copyright (C) 2018 Reich Web Consulting
 * @license   MIT
 */

namespace RWC\Arrays;

use RWC\Arrays\FilterInterface;

/**
 * Filters an array by passing the keys through a mapping array.
 *
 * The KeyReplacementFilter makes it easy to convert an array of key/value
 * pairs from one set of keys for another. A great use case for this would be
 * when you want to normalize the data from a database query with a strange
 * field naming convention to your application's own naming standards.
 *
 * @author    Brian Reich <breich@reich-consulting.net>
 * @copyright (C) 2018 Reich Web Consulting
 * @license   MIT
 */
class KeyReplacementFilter extends KeyMutatorFilter
{
    /**
     * An array of key mappings.
     *
     * @var array
     */
    protected $map;

    /**
     * Creates a KeyMutatorFilter.
     *
     * @param callable $mutator The user function used to filter keys.
     */
    public function __construct(array $map)
    {
        parent::__construct([$this, 'map']);
        $this->setMap($map);
    }

    /**
     * Sets the key map.
     *
     * @param array $map The key map.
     */
    public function setMap(array $map) : void
    {
        $this->map = $map;
    }

    /**
     * Returns the key map.
     *
     * @return array Returns the key map.
     */
    public function getMap() : array
    {
        return $this->map;
    }

    /**
     * Maps the specified array key to the associated key in the map table.
     *
     * @param  string|int $key The key to map.
     * @return string|int Returns the mapped key name.
     */
    public function map($key) : string
    {
        // If key is mapped, return mapping.
        if (isset($this->getMap()[$key])) {
            return $this->getMap()[$key];
        }

        return $key;
    }
}
