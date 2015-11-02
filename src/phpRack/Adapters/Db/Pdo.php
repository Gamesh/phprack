<?php

/**
 * phpRack: Integration Testing Framework
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt. It is also available
 * through the world-wide-web at this URL: http://www.phprack.com/LICENSE.txt
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@phprack.com so we can send you a copy immediately.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @copyright Copyright (c) 2009-2012 phpRack.com
 * @version $Id$
 * @category phpRack
 * @package Adapters
 * @author gamesh
 */
class phpRack_Adapters_Db_Pdo extends phpRack_Adapters_Db_Abstract
{

    const DRIVER_SPECIFIC_ERROR_MESSAGE = 2;
    /**
     * @var PDO
     * @see connect()
     */
    private $_connection;

    /**
     * Connect to the server
     *
     * @param string JDBC URL to connect to the server
     * @return void
     * @see http://java.sun.com/docs/books/tutorial/jdbc/basics/connecting.html
     * @throws phpRack_Exception If PDO extension is not loaded
     * @throws phpRack_Exception If pdo_mysql extension is not loaded
     * @throws phpRack_Exception If any of the required params are missed in the URL
     * @throws phpRack_Exception if unable to establish connection
     */
    public function connect($url)
    {
        $parts = $this->_parseJdbcUrl($url);
        if (!extension_loaded('pdo')) {
            throw new phpRack_Exception('PDO extension is not loaded.');
        }
        if (!in_array(strtolower($parts['adapter']), PDO::getAvailableDrivers(), true)) {
            throw new phpRack_Exception('PDO MySQL (pdo_mysql) extension is not loaded.');
        }
        $username = $parts['params']['username'];
        $password = $parts['params']['password'];
        $url = vsprintf('%s:dbname=%s;host=%s',
                array(
            $parts['adapter'],
            $parts['database'],
            $parts['host'],
        ));
        if (isset($parts['port'])) {
            $url .=';port=' . (int) $parts['port'];
        }
        try {
            $this->_connection = new PDO($url, $username, $password,
                    array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ));
        } catch (PDOException $e) {
            throw new phpRack_Exception("Can't connect to {$parts['adapter']} server: {$parts['host']}");
        }
    }

    /**
     * @throws phpRack_Exception if connection was not yet established
     * @return PDO
     */
    protected function getConnection()
    {
        if (!$this->_connection) {
            throw new phpRack_Exception('connect() method should be called before');
        }
        return $this->_connection;
    }

    public function query($sql)
    {
        try {
            $statement = $this->_connection->query($sql);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $result;
        } catch (PDOException $e) {
            if ($statement === false) {
                $error = $this->getConnection()->errorInfo();
            } else {
                $error = $statement->errorInfo();
            }

            throw new phpRack_Exception('Query error: ' . $error[self::DRIVER_SPECIFIC_ERROR_MESSAGE]);
        }
    }

    /**
     * @return string
     */
    public function getAdapterName()
    {
        return $this->_connection->getAttribute(PDO::ATTR_DRIVER_NAME);
    }

}
