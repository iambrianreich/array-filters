<?php

namespace Tests\Catalyst\Hydrator\Filters;

use PHPUnit\Framework\TestCase;
use RWC\Arrays\KeyPrefixFilter;
use RWC\Arrays\FilterInterface;

class KeyPrefixFilterTest extends TestCase
{
    public function testConstructor()
    {
        $filter = new KeyPrefixFilter('_');

        $this->assertTrue(is_callable($filter->getMutator()));

        $data = ['key' => 'value'];

        $filteredData = $filter->filter($data);

        $this->assertFalse(isset($filteredData['key']));
        $this->assertTrue(isset($filteredData['_key']));
    }
}
