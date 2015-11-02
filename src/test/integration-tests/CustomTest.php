<?php
/**
 * @version $Id$
 */

/**
 * @see phpRack_Test
 */

class CustomTest extends phpRack_Test
{

    public function testCustomAssertionsAreValid()
    {
        $this->assert->fail("This test is just failed, always");
    }

}
