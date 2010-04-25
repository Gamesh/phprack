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
 * @copyright Copyright (c) phpRack.com
 * @version $Id$
 * @category phpRack
 */


/**
 * OS adapter used to get information where script is executed
 *
 * @package Adapters
 */
class phpRack_Adapters_Os
{
    /**
     * System constants used for simplify comparisions
     */
    const WINDOWS = 'Windows';
    const LINUX = 'Linux';
    const DARWIN = 'Darwin';

    /**
     * Recognize OS and return its name as string (Windows, Linux, etc)
     *
     * @return string
     * @see phpRack_Adapters_Cpu::factory()
     * @see #17 I don't like the way we manage DEFAULT here. Not all systems are Linux,
     *      if we don't know them. Would be much better to detect LINUX only, and throw
     *      an Exception if some other system is found, which is unknown for us.
     */
    public static function get()
    {
        switch (true) {
            /* windows */
            case (substr(PHP_OS, 0, 3) === 'WIN'):
                return self::WINDOWS;
                
            /* Mac OS and Mac OS X */
            case (substr(PHP_OS, 0, 6) === 'Darwin'):
                return self::DARWIN;
                
            /* all other systems */
            default:
                return self::LINUX;
        }
    }
    
    /**
     * Is it *NIX system?
     *
     * Everything which is NOT windows is Unix. Very rough assumption, but this
     * is enough for now.
     *
     * @return boolean
     */
    public static function isUnix() 
    {
        return (self::get() != self::WINDOWS);
    }
}
