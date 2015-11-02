<?php

/**
 * @version $Id$
 *
 * @see AbstractTest 
 * @see phpRack_Adapters_Cpu
 * @requires extension com_dotnet
 */
class Adapters_CpuTest extends AbstractTest
{

    /**
     * CPU adapter
     *
     * @var phpRack_Adapters_Cpu
     */
    private $_adapter;

    protected function setUp()
    {
        parent::setUp();
        $this->_adapter = phpRack_Adapters_Cpu::factory();
    }

    protected function tearDown()
    {
        unset($this->_adapter);
        parent::tearDown();
    }
    
    public function testGetBogoMips()
    {
        try {
            $bogoMips = $this->_adapter->getBogoMips();
        } catch (Exception $e) {
            $this->_log($e);
            $this->markTestSkipped($e->getMessage());
        }
        $this->assertInternalType('float', $bogoMips);
    }

    public function testGetCpuFrequency()
    {
        try {
            $frequency = $this->_adapter->getCpuFrequency();
        } catch (Exception $e) {
            $this->_log($e);
            $this->markTestSkipped($e->getMessage());
        }
        $this->assertInternalType('float', $frequency);
    }

}
