<?php
/**
 * @version $Id$
 */

/**
 * @see AbstractTest
 */

/**
 * @see phpRack_Adapters_Db_Mysql
 */

abstract class phpRack_Adapters_Db_Mysql_AbstractTest extends AbstractTest
{
    /**
     * MySQL adapter
     *
     * @var phpRack_Adapters_Db_Mysql
     */
    protected $_adapter;

    protected function setUp()
    {
        parent::setUp();
        $this->_adapter = new phpRack_Adapters_Db_Mysql();
    }

    protected function tearDown()
    {
        unset($this->_adapter);
        parent::tearDown();
    }

}
