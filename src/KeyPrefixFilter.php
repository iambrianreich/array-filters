<?php

/**
 * This file contains the RWC\Arrays\KeyAppenderFilter class.
 *
 * @author    Brian Reich <breich@reich-consulting.net>
 * @copyright (C) 2018 Reich Web Consulting
 * @license   MIT
 */

namespace RWC\Arrays;

use RWC\Arrays\FilterInterface;
use RWC\Arrays\KeyMutatorFilter;

/**
 * Filters keys by adding a prefix to them.
 *
 * The filtered array will be returned with all of the same keys and values
 * except the keys will start with the prefix assigned to the filter.
 *
 * @author    Brian Reich <breich@reich-consulting.net>
 * @copyright (C) 2018 Reich Web Consulting
 * @license   MIT
 */
class KeyPrefixFilter extends KeyMutatorFilter
{
    /**
     * The prefix to add to all array keys.
     *
     * @var string
     */
    private $prefix;

    /**
     * Creates a KeyPrefixFilter.
     *
     * The prefix is passed to the constructor.  When filter() is run, it
     * will add the prefix to all keys.
     *
     * @param string $prefix The prefix to add to array keys.
     */
    public function __construct(string $prefix)
    {
        parent::__construct(array($this, 'prepend'));
        $this->setPrefix($prefix);
    }

    /**
     * Sets the key prefix.
     *
     * @param string $prefix The key prefix.
     *
     * @return KeyPrefixFilter Returns a fluid interface.
     */
    public function setPrefix(string $prefix) : KeyPrefixFilter
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Returns the key prefix.
     *
     * @return Returns the key prefix.
     */
    public function getPrefix() : string
    {
        return $this->prefix;
    }

    /**
     * Returns the configured prefix followed by the key.
     *
     * @param  string $key The key to prefix.
     *
     * @return string Returns the prefixed key.
     */
    public function prepend(string $key) : string
    {
        return $this->getPrefix() . $key;
    }
}
