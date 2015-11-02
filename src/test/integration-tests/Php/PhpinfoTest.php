<?php
/**
 * @version $Id$
 */

/**
 * @see phpRack_Test
 */

class Php_PhpinfoTest extends phpRack_Test
{

    public function testPhpinfoIsVisible()
    {
        $this->assert->php->phpinfo();
    }

}
