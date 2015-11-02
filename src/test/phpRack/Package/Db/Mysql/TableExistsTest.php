<?php
/**
 * @version $Id$
 */

/**
 * @see AbstractTest
 */

/**
 * @see phpRack_Package_Db_Mysql_AbstractTest
 */

class phpRack_Package_Db_Mysql_TableExistsTest extends phpRack_Package_Db_Mysql_AbstractTest
{
    public function testTableExists()
    {
        try {
            $this->_getPackageWithValidConnect()
                ->dbExists(self::VALID_DATABASE)
                ->tableExists(self::INVALID_TABLE);
            $this->assertFalse($this->_result->wasSuccessful());
        } catch (Exception $e) {
            $this->assertTrue($e instanceof Exception);
            $this->markTestSkipped('Valid MySQL database was not found');
        }
    }

    /**
     * @expectedException phpRack_Exception
     */
    public function testTableExistsWithoutConnect()
    {
        $this->_package->tableExists(self::VALID_TABLE);
    }

    /**
     * @expectedException phpRack_Exception
     */
    public function testTableExistsWithoutDbExists()
    {
        $this->_getPackageWithValidConnect()
            ->tableExists(self::INVALID_TABLE);
    }
}
