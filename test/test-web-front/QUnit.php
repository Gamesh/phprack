<?php
if (!is_dir('instrumented-js')) {
    exit("'instrumented-js' directory does NOT exists. Please execute phing first");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>phpRack Test Suite</title>

    <head>
        <link rel="stylesheet" href="QUnit/qunit.css" type="text/css" />

        <script type="text/javascript">
            <?php echo file_get_contents("../../phpRack/layout/js/jquery-1.4.2.min.js")?>
        </script>

        <script type="text/javascript">
            var phpParams = {
                calls: [],
                ok: 'OK',
                failure: 'FAILURE',
                requestUri: 'QUnit/response/simple.js',
                ajaxTag: 'test',
                ajaxToken: 'token',
            };
        </script>
    
        <script type="text/javascript">
            <?php echo file_get_contents("instrumented-js/index.js")?>
        </script>
    
        <script type="text/javascript" src="QUnit/qunit.js"></script>
    
        <?php
        $jsTestsPath = "QUnit/test/";
        /**
         * @see phpRack_Adapters_Files_DirectoryFilterIterator
         */
        require_once '../../phpRack/Adapters/Files/DirectoryFilterIterator.php';
        $iterator = phpRack_Adapters_Files_DirectoryFilterIterator::factory($jsTestsPath);
        $iterator->setExclude('/.svn/')
            ->setExtensions('js');
        ?>
        <?php foreach ($iterator as $file): ?>
            <script type="text/javascript"
                src="<?php echo str_replace('\\', '/', $file->getPathname()); ?>">
            </script>
        <?php endforeach; ?>
    </head>

    <body>
        <h1 id="qunit-header">phpRack Test Suite</h1>
        <h2 id="qunit-banner"></h2>
        <div id="qunit-testrunner-toolbar"></div>
        <h2 id="qunit-userAgent"></h2>
        <ol id="qunit-tests"></ol>
        <button style="margin: 5px 0px;" onclick='window.open("instrumented-js/jscoverage.html");'>
            Coverage report
        </button>
    </body>

</html>