<?php
/**
 * @version $Id$
 */

/**
 * @see AbstractTest
 */

/**
 * @see phpRack_Package_Disc_File_AbstractTest
 */

class phpRack_Package_Disc_File_PathTest extends phpRack_Package_Disc_File_AbstractTest
{
    public function testRelativePaths()
    {
        $fileName = 'test/phpRack/Package/Disc/_files/5lines.txt';
        $fileNames = array(
            '../' . $fileName,
            './../' . $fileName,
            '/../' . $fileName
        );

        foreach ($fileNames as $fileName) {
            $this->_package->cat($fileName);
            $this->assertTrue($this->_result->wasSuccessful());

            $this->_package->head($fileName, 2);
            $this->assertTrue($this->_result->wasSuccessful());

            $this->_package->tail($fileName, 2);
            $this->assertTrue($this->_result->wasSuccessful());
        }
    }
}
