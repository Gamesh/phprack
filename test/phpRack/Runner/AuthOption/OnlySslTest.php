<?php

/**
 * @see AbstractTest
 */
require_once 'AbstractTest.php';


class Runner_AuthOption_OnlySslTest extends AbstractTest
{
    protected function setUp()
    {
        global $phpRackConfig;
        $authOptions = array(
            'auth' => array(
                'username' => uniqid(),
                'password' => uniqid(),
                'onlySSL' => true,
            )
        );
        /**
         * @see phpRack_Runner
         */
        require_once PHPRACK_PATH . '/Runner.php';
        $this->_runner = new phpRack_Runner(
            array_merge($phpRackConfig, $authOptions)
        );
    }

    protected function tearDown()
    {
        unset($this->_runner);
    }

    public function testWithHttpsConnection()
    {
        global $_SERVER;
        $_SERVER['HTTPS'] = 'on';
        $this->assertTrue($this->_runner->isEnoughSecurityLevel());
    }

    public function testWithHttpConnection()
    {
        global $_SERVER;
        unset($_SERVER['HTTPS']);
        $this->assertFalse($this->_runner->isEnoughSecurityLevel());
    }
}
