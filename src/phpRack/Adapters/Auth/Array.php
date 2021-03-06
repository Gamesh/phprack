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
 */

/**
 * @see phpRack_Adapters_Auth_Abstract
 */

/**
 * Authentication array adapter
 *
 * @package Adapters
 * @subpackage Auth
 */
class phpRack_Adapters_Auth_Array extends phpRack_Adapters_Auth_Abstract
{
    /**
     * Authenticate and return an auth result
     *
     * @return phpRack_Runner_Auth_Result
     * @see phpRack_Adapters_Auth_Abstract::authenticate()
     */
    public function authenticate()
    {
        if (strlen($this->_request['hash']) != 32) {
            // This situation is a clear indicator of something wrong
            // in phpRack configuration. "hash" should contain MD5 hash.
            return $this->_validated(
                false,
                "Invalid password hash: '{$this->_request['hash']}'"
            );
        }

        $htpasswd =& $this->_options['htpasswd'];
        foreach (array_keys($htpasswd) as $login) {
            if ($login == $this->_request['login']) {
                $user = $login;
            }
        }
        if (!isset($user)) {
            return $this->_validated(false, 'Invalid user name');
        }

        $password = $htpasswd[$user];
        if (md5($password) != $this->_request['hash']) {
            return $this->_validated(false, 'Invalid password provided');
        }

        // everything is fine
        return $this->_validated(true);
    }
}
