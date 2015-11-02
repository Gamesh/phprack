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
 * @package Tests
 * @subpackage packages 
 * @author jusurb
 */

/**
 * PDO related assertions.
 *
 * @package Tests
 * @subpackage packages
 */
class PhpRack_Package_Db_Pdo extends phpRack_Package
{
     /**
     * MySQL adapter
     *
     * @var phpRack_Adapters_Db_Pdo
     * @see __construct()
     */
    private $_adapter;

    /**
     * Construct the class
     *
     * @param phpRack_Result
     * @return void
     * @see phpRack_Package::__construct()
     */
    public function __construct(phpRack_Result $result)
    {
        parent::__construct($result);
        $this->_adapter = new phpRack_Adapters_Db_Pdo();
    }
    
    /**
     * Check that we can connect to db server
     *
     * This method converts connection parameters to JDBC URL, and uses
     * DB adapter in order to establish a real connection with DB. We
     * url-encode all parameters, since JDBC URL is just an URL after all.
     *
     * @param string Adapter (mysql, sqlite, sqlite3, pgsql...)
     * @param string Host
     * @param integer Port
     * @param string User name
     * @param string User password
     * @return $this
     * @see phpRack_Adapters_Db_Pdo
     * @link http://php.net/manual/en/pdo.drivers.php PDO Drivers
     */
    public function connect($adapter, $host, $port, $username, $password)
    {
        $jdbcUrl = "jdbc:{$adapter}://{$host}:{$port}"
            . '?username=' . urlencode($username)
            . '&password=' . urlencode($password);

        try {
            $this->_adapter->connect($jdbcUrl);
            $this->_success("Connected successfully to {$this->_adapter->getAdapterName()} server '{$host}':'{$port}'");
        } catch(phpRack_Exception $e) {
            assert($e instanceof phpRack_Exception); // for ZCA only
            $this->_failure("Can't connect to '{$adapter}' server '{$host}':'{$port}', login: '{$username}'");
        }

        return $this;
    }
}
