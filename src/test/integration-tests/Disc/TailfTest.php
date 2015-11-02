<?php
/**
 * @version $Id$
 */

/**
 * @see phpRack_Test
 */

class Disc_TailfTest extends phpRack_Test
{
    public function testLiveTail()
    {
        $fileName = '../test/phpRack/Package/Disc/_files/1000lines.txt';
        $this->assert->disc->file->tailf($fileName, 20, 5);
    }
}
