<?php
/**
 * @version $Id$
 */

/**
 * @see phpRack_Test
 */

class ReloadTest extends phpRack_Test
{
    public function testReloadAjaxOption()
    {
        $time = date('H:i:s');
        $this->assert->fail("Current time: '{$time}'");

        $this->setAjaxOptions(
            array(
                'reload' => 5, // every 5 seconds, if possible
            )
        );

    }

}
