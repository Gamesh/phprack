<?php
/**
 * @version $Id$
 */

/**
 * @see AbstractTest
 */
require_once 'src/test/AbstractTest.php';

/**
 * @see phpRack_Package_Db_Mysql_AbstractTest
 */
require_once PHPRACK_PATH . '/../test/phpRack/Package/Db/Mysql/AbstractTest.php';

class phpRack_Package_Db_Mysql_QueryTest extends phpRack_Package_Db_Mysql_AbstractTest
{
    public function testQuery()
    {
        try {
            $this->_getPackageWithValidConnect()
                ->dbExists(self::VALID_DATABASE)
                ->query('SELECT 1');
            $this->assertTrue($this->_result->wasSuccessful());
        } catch (Exception $e) {
            $this->markTestSkipped($e->getMessage());
        }
    }

    public function testQueryWithInvalidQuery()
    {
        try {
            $this->_getPackageWithValidConnect()
                ->dbExists(self::VALID_DATABASE)
                ->query('NOTEXISTEDFUNCTION 1');
            $this->assertFalse($this->_result->wasSuccessful());
        } catch (Exception $e) {
            $this->markTestSkipped($e->getMessage());
        }
    }

    /**
     * @expectedException phpRack_Exception
     */
    public function testQueryWithoutConnect()
    {
        $this->_package->query('SELECT 1');
    }
}
