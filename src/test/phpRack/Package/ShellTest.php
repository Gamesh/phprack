<?php

/**
 * @version $Id$
 */

/**
 * @see AbstractTest 
 * @see phpRack_Package_Shell 
 */
class phpRack_Package_ShellTest extends AbstractTest
{

    /**
     * @var phpRack_Package_Shell
     */
    private $_package;

    protected function setUp()
    {
        parent::setUp();
        $this->_package = $this->_test->assert->shell;
    }

    /**
     * @requires OS Linux
     */
    public function testBasicRequestWorksOnLinux()
    {
        $this->_package->exec('who am i');
    }

    /**
     * @requires OS WIN32|WINNT
     */
    public function testBasicRequestWorksOnWindows()
    {
        $this->_package->exec('echo %USERDOMAIN%\%USERNAME%');
    }

    /**
     * Tests for shell output text.
     */
    public function testRequestOutput()
    {
        $this->_package->exec('dir', '/test/');
    }

}
