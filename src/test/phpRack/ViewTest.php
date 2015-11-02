<?php
/**
 * @version $Id$
 */

/**
 * @see AbstractTest
 */

/**
 * @see phpRack_Runner
 */

/**
 * @see phpRack_View
 */

class ViewTest extends AbstractTest
{

    public function testRenderingReturnsValidHtml()
    {
        global $phpRackConfig;
        $runner = new phpRack_Runner($phpRackConfig);

        $view = new phpRack_View();
        $view->assign(array('runner' => $runner));

        $html = $view->render();
        $this->assertFalse(empty($html), "Empty HTML, why?");
    }

}
