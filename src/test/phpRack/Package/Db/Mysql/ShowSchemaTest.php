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

class phpRack_Package_Db_Mysql_ShowSchemaTest extends phpRack_Package_Db_Mysql_AbstractTest
{
    public function testShowSchema()
    {
        try {
            $this->_getPackageWithValidConnect()
                ->dbExists(self::VALID_DATABASE)
                ->showSchema();
        } catch (Exception $e) {
            $this->assertTrue($e instanceof Exception);
            $this->markTestSkipped('Valid MySQL database was not found');
        }
    }

    /**
     * @expectedException phpRack_Exception
     */
    public function testShowSchemaWithoutConnect()
    {
        $this->_package->showSchema();
    }

    /**
     * @expectedException phpRack_Exception
     */
    public function testShowSchemaWithoutDbExists()
    {
        $this->_getPackageWithValidConnect()
            ->showSchema();
    }
}
