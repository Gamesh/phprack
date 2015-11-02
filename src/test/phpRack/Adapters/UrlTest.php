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

class Adapters_UrlTest extends AbstractTest
{
    public function testWeCanCreateUrlAndCheckItsContent()
    {
        $url = phpRack_Adapters_Url::factory('http://www.google.com');
        $accessible = $url->isAccessible();
        if (!$accessible) {
            $this->markTestIncomplete();
        }
        try {
            $url->getContent();
        } catch (Exception $e) {
            $this->_log($e);
            $this->markTestIncomplete();
        }
    }

    /**
     * @expectedException phpRack_Exception
     */
    public function testFactoryWithInvalidUrl()
    {
        phpRack_Adapters_Url::factory('http://');
    }

    public function testFactoryWithoutHttpInUrl()
    {
        $urlAdapter = phpRack_Adapters_Url::factory('www.google.com');
        $this->assertTrue($urlAdapter instanceof phpRack_Adapters_Url);
    }

    public function testFactoryWithPathAndQuery()
    {
        $urlAdapter = phpRack_Adapters_Url::factory('http://www.google.pl/webhp?hl=en');
        $this->assertTrue($urlAdapter instanceof phpRack_Adapters_Url);
    }

    /**
     * @expectedException phpRack_Exception
     */
    public function testFactoryWithInvalidOptions()
    {
        $options = array(
            'invalidOption' => false
        );
        phpRack_Adapters_Url::factory('http://www.google.com', $options);
    }
}
