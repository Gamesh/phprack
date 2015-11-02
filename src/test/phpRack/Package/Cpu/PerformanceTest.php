<?php

/**
 * @version $Id$
 */

/**
 * @see AbstractTest
 * @requires extension com_dotnet
 */
class phpRack_Package_Cpu_PerformanceTest extends AbstractTest
{

    /**
     * @var phpRack_Package_Cpu_Performance
     */
    private $_package;

    protected function setUp()
    {
        parent::setUp();
        $this->_package = $this->_test->assert->cpu->performance;
    }

    public function testAtLeast()
    {
        $this->_package->atLeast(1.0);
    }

    public function testAtLeastWithVeryBigValue()
    {
        $this->_package->atLeast(1000000000.0);
    }

}
