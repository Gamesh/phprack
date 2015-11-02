<?php
/**
 * @version $Id$
 */

/**
 * @see phpRack_Test
 */

class PauseDisableTest extends phpRack_Test
{
    protected function _init()
    {
        $this->setAjaxOptions(
            array(
                'pauseWhenFocusLost' => false, // true by default
            )
        );
    }
    public function testShowLog()
    {
        $fileName = '../test/phpRack/Package/Disc/_files/1000lines.txt';
        $this->assert->disc->file->tailf($fileName);
    }

}
