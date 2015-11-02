<?php
/**
 * @version $Id$
 */

/**
 * @see phpRack_Test
 */

class LongTest extends phpRack_Test
{

    public function testConnectionMonitorAndTestStop()
    {
         /**
         * @see phpRack_Adapters_ConnectionManager
         */

        for ($i = 0; $i < 20; $i++) {
            sleep(1);
            phpRack_Adapters_ConnectionMonitor::getInstance()->ping();
        }

        $this->assert
            ->isTrue(true)
            ->onSuccess('Long test: always true');
    }

}
