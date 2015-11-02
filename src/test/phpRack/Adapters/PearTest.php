<?php
/**
 * @version $Id$
 */

/**
 * @see AbstractTest
 */

/**
 * @see phpRack_Adapters_Url
 */

class Adapters_PearTest extends AbstractTest
{
    /**
     * MySQL adapter
     *
     * @var phpRack_Adapters_Pear
     */
    private $_adapter;

    protected function setUp()
    {
        parent::setUp();
        $this->_adapter = new phpRack_Adapters_Pear();
    }

    protected function tearDown()
    {
        unset($this->_adapter);
        parent::tearDown();
    }

    public function testGetPackageName()
    {
        try {
            $package = $this->_adapter->getPackage('PEAR');
            $this->assertEquals('PEAR', $package->getName());
        } catch (Exception $e) {
            $this->markTestSkipped($e->getMessage());
        }
    }

    public function testGetPackageVersion()
    {
        try {
            $package = $this->_adapter->getPackage('PEAR');
            $package->getVersion();
        } catch (Exception $e) {
            $this->markTestSkipped($e->getMessage());
        }
    }

    public function testGetAllPackages()
    {
        try {
            $this->_adapter->getAllPackages();
        } catch (Exception $e) {
            $this->markTestSkipped($e->getMessage());
        }
    }

    public function testGetPackageRawInfo()
    {
        try {
            $package = $this->_adapter->getPackage('PEAR');
            $package->getRawInfo();
        } catch (Exception $e) {
            $this->markTestSkipped($e->getMessage());
        }
    }
}
