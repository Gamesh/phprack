<?php

/**
 * @version $Id$
 */
/**
 * @see AbstractTest
 */

/**
 * @see phpRack_Package_Db_Mysql_AbstractTest
 * @requires extension mysql
 */
class phpRack_Package_Db_Mysql_DbExistsTest extends phpRack_Package_Db_Mysql_AbstractTest
{

    public function testDbExists()
    {
        try {
            $this->_getPackageWithValidConnect()
                    ->dbExists(self::INVALID_DATABASE);
            $this->assertFalse($this->_result->wasSuccessful());
        } catch (Exception $e) {
            $this->assertTrue($e instanceof Exception);
            $this->markTestSkipped('Valid MySQL server was not found');
        }
    }

    /**
     * @expectedException phpRack_Exception
     */
    public function testDbExistsWithoutConnect()
    {
        $this->_package->dbExists(self::VALID_DATABASE);
    }

}
