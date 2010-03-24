<?php
/**
 * phpRack: Integration Testing Framework
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt. It is also available 
 * through the world-wide-web at this URL: http://www.phprack.com/license
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@phprack.com so we can send you a copy immediately.
 *
 * @copyright Copyright (c) phpRack.com
 * @version $Id: Package.php 82 2010-03-16 13:46:41Z yegor256@yahoo.com $
 * @category phpRack
 */

/**
 * @see phpRack_Adapters_Db_Abstract
 */
require_once PHPRACK_PATH . '/Adapters/Db/Abstract.php';

/**
 * MySQL adapter
 *
 * The class is using native PHP mysql_ methods, without any specific
 * extensions like PDO or Mysqli.
 *
 * @package Adapters
 * @subpackage Db
 */
class phpRack_Adapters_Db_Mysql extends phpRack_Adapters_Db_Abstract
{
    
    /**
     * Connect to the server
     *
     * @param string JDBC URL to connect to the server
     * @return void
     * @see http://java.sun.com/docs/books/tutorial/jdbc/basics/connecting.html
     * @throws Exception If something wrong happens there
     * @see mysql_connect()
     */
    public function connect($url)
    {
        assert(is_string($url));
        // ...
    }
    
    /**
     * Execute SQL query on the server
     *
     * @param string SQL query
     * @return string Raw result from the server, in text
     * @throws Exception If something wrong happens there
     * @see mysql_query()
     */
    public function query($sql)
    {
        assert(is_string($sql));
        // ...
    }
        
}
