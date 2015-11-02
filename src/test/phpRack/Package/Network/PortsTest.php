<?php
/**
 * @version $Id$
 */

/**
 * @see AbstractTest
 */

/**
 * @see phpRack_Package_Network_Ports
 */

class phpRack_Package_Network_PortsTest extends AbstractTest
{
    /**
     * @var phpRack_Package_Network_Ports
     */
    private $_package;

    /**
     * @var phpRack_Result
     */
    private $_result;

    protected function setUp()
    {
        parent::setUp();
        $this->_result = $this->_test->assert->getResult();
        $this->_package = $this->_test->assert->network->ports;
    }

    public function testIsOpen()
    {
        try {
            $this->_package->isOpen(80, 'google.com');
            $this->assertTrue($this->_result->wasSuccessful());
        } catch (Exception $e) {
            $this->_log($e);
            $this->markTestIncomplete();
        }

        $this->_package->isOpen(9999);
        $this->assertFalse($this->_result->wasSuccessful());
    }
}
