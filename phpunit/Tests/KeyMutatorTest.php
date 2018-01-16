<?php

namespace Tests\RWC\Arrays\Filters;

use PHPUnit\Framework\TestCase;
use RWC\Arrays\KeyMutatorFilter;
use RWC\Arrays\FilterInterface;

class KeyMutatorTest extends TestCase
{
    public function testConstructor()
    {
        $filter = new KeyMutatorFilter(function (string $key) {
            return '_' . $key;
        });

        $this->assertTrue(is_callable($filter->getMutator()));

        $data = ['key' => 'value'];

        $filteredData = $filter->filter($data);

        $this->assertFalse(isset($filteredData['key']));
        $this->assertTrue(isset($filteredData['_key']));
    }
}
