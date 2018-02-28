<?php

namespace Tests\RWC\Arrays\Filters;

use PHPUnit\Framework\TestCase;
use RWC\Arrays\IncludeFieldsFilter;
use RWC\Arrays\FilterInterface;

class IncludeFieldsFilterTest extends TestCase
{
    public function testConstructor()
    {
        $filter = new IncludeFieldsFilter([ 'ssn']);
        
        $data = [ 'name' => 'Joe Bloe', 'ssn' => '123-435-5555' ];

        $filteredData = $filter->filter($data);

        $this->assertTrue(isset($filteredData['ssn']));
        $this->assertFalse(isset($filteredData['name']));
    }
}
