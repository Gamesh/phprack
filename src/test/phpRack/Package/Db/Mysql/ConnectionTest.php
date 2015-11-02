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

class phpRack_Package_Db_Mysql_ConnectionTest extends phpRack_Package_Db_Mysql_AbstractTest
{
    public function testConnect()
    {
        $this->_package->connect(
            self::INVALID_HOST,
            self::INVALID_PORT,
            self::INVALID_USERNAME,
            self::INVALID_PASSWORD
        );
        $this->assertFalse($this->_result->wasSuccessful());
    }

    public function testCloseConnection()
    {
        $this->_package->closeConnection();
    }
}
