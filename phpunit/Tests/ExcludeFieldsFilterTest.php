<?php

namespace Tests\RWC\Arrays\Filters;

use PHPUnit\Framework\TestCase;
use RWC\Arrays\ExcludeFieldsFilter;
use RWC\Arrays\FilterInterface;

class ExcludeFieldsFilterTest extends TestCase
{
    public function testConstructor()
    {
        $filter = new ExcludeFieldsFilter([ 'ssn']);

        
        $data = [ 'name' => 'Joe Bloe', 'ssn' => '123-435-5555' ];

        $filteredData = $filter->filter($data);

        $this->assertFalse(isset($filteredData['ssn']));
        $this->assertTrue(isset($filteredData['name']));
    }
}
