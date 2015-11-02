<?php

/**
 * @version $Id$
 *
 * @see phpRack_Test
 */

/**
 * @requires extension com_dotnet
 */
class Cpu_PerformanceTest extends PhpRack_Test
{

    public function testServerIsFast()
    {
        if (!extension_loaded('com_dotnet')) {
            $this->_log('Skipped. required com_dotnet extension is not loaded.');
        } else {
            // CPU performance is higher than 3000 BogoMips
            $this->assert->cpu->performance
                    ->atLeast(3000);
        }
    }

}
