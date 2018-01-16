<?php

namespace Tests\RWC\Arrays\Filters;

use PHPUnit\Framework\TestCase;
use RWC\Arrays\ChainedFilter;
use RWC\Arrays\FilterInterface;

class ChainedFilterTest extends TestCase
{
    public function testChainedFilterConstructorSetsNoFiltersByDefault()
    {
        $filter = new ChainedFilter();

        $this->assertCount(0, $filter->getFilters());
    }

    public function testConstructorSetsFilters()
    {
        $filter = new ChainedFilter([ $this->getFilter('foo') ]);

        $this->assertCount(1, $filter->getFilters());

        $filter = new ChainedFilter([
            $this->getFilter('foo'),
            $this->getFilter('bar')
        ]);

        $this->assertCount(2, $filter->getFilters());
    }

    public function testExtractFilterRunsCorrectOrder()
    {
        $data = [ 'key' => 'value', 'filtered' => false ];

        $this->assertEquals('value', $data['key']);

        $filter = new ChainedFilter();
        $filteredData = $filter->filter($data);
        $this->assertEquals($filteredData['filtered'], false);

        $filter->addFilter($this->getFilter('foo'));
        $filteredData = $filter->filter($data);
        $this->assertEquals($filteredData['filtered'], 'foo');

        $filter->addFilter($this->getFilter('bar'));
        $filteredData = $filter->filter($data);
        $this->assertEquals($filteredData['filtered'], 'bar');
    }

    public function getFilter($filteredValue = 'filtered')
    {
        return new class($filteredValue) implements FilterInterface {
            protected $filteredValue;

            public function __construct($filteredValue)
            {
                $this->filteredValue = $filteredValue;
            }

            public function filter(array $data) : array
            {
                $data['filtered'] = $this->filteredValue;

                return $data;
            }
        };
    }
}
