<?php

namespace Tests\RWC\Arrays\Filters;

use PHPUnit\Framework\TestCase;
use RWC\Arrays\KeyReplacementFilter;
use RWC\Arrays\FilterInterface;

class KeyReplacementFilterTest extends TestCase
{
    public function testConstructor()
    {
        $filter = new KeyReplacementFilter(['ID' => 'id']);

        

        $data = [
            'ID' => 12,
            'NotInMap' => 'not in map'
        ];

        $filteredData = $filter->filter($data);

        $this->assertFalse(isset($filteredData['ID']));
        $this->assertTrue(isset($filteredData['id']));
        $this->assertTrue(isset($filteredData['NotInMap']));
        $this->assertEquals($filteredData['NotInMap'], $data['NotInMap']);
    }
}
