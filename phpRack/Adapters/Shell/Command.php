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
 * @version $Id$
 * @category phpRack
 */

 /**
 * @see phpRack_Adapters_ConnectionManager
 */
require_once PHPRACK_PATH . '/Adapters/ConnectionMonitor.php';

/**
 * Shell command adapter used to execute external commands and programs
 *
 * @package Adapters
 * @author netcoderpl@gmail.com
 */
class phpRack_Adapters_Shell_Command
{
    /**
     * Shell command to execute
     *
     * @var string
     * @see __construct()
     * @see run()
     */
    private $_command;

    /**
     * Process resource returned by proc_open() used for process identification
     *
     * @var string
     * @see run()
     * @see __destruct()
     */
    private $_process;

    /**
     * Pipe ids, used for select with which process pipe we want to communicate
     *
     * @see run()
     */
    const PIPE_STD_IN  = 0;
    const PIPE_STD_OUT = 1;
    const PIPE_STD_ERR = 2;

    /**
     * Shell command constructor
     *
     * @param string Command to execute
     * @return void
     */
    private function __construct($command)
    {
        $this->_command = $command;
    }

    /**
     * Shell command factory, to simplify calls
     *
     * @param string Command to execute
     * @return phpRack_Adapters_Shell_Command
     */
    public static function factory($command)
    {
        return new self($command);
    }

    /**
     * Execute shell command. Use asynchronous pipes to communicate
     * with child process
     *
     * @return string Command execution output
     * @throws Exception if from some reason command can't be executed
     * @throws Exception if command process was terminated
     * @see phpRack_Package_Php::lint()
     */
    public function run()
    {
        $descriptors = array(
            self::PIPE_STD_IN  => array('pipe', 'r'), // child process stdin
            self::PIPE_STD_OUT => array('pipe', 'w'), // child process stdout
            self::PIPE_STD_ERR => array('pipe', 'w')  // child process stderr
        );

        $pipes = array();
        // execute command and get its proccess resource
        $this->_process = proc_open($this->_command, $descriptors, $pipes, getcwd());

        // if there was some problems with command execution
        if (!is_resource($this->_process)) {
            throw new Exception("Can't execute shell command '{$this->_command}'");
        }

        $output = '';

        // close stdin to avoid child process waiting for data
        fclose($pipes[self::PIPE_STD_IN]);
        unset($pipes[self::PIPE_STD_IN]);

        // set non blockiing mode for pipes
        foreach ($pipes as $pipe) {
            stream_set_blocking($pipe, false);
        }

        while (true) {
            $readPipes = array();

            // check that we readed everything from pipes
            foreach ($pipes as $pipe) {
                if (!feof($pipe)) {
                    $readPipes[] = $pipe;
                }
            }

            // we have nothing more to read
            if (empty($readPipes)) {
                break;
            }

            // set to null because we only use pipes to read
            $write  = null;
            $except = null;

            /**
             * Maximum time for which stream_select() function will lock script
             * execution.
             *
             * This short timeout allow as to return to main script and check
             * connection status
             */
            $waitTimeout = 1; // 1 second

            /**
             * Check that we have some data to read from child process pipes
             *
             * If there are some new data to read, this function will return
             * imediatelly.
             *
             * If there are NO new data to read, after 1 second it return with
             * $changedStreamsCount = 0
             *
             * $readPipes is passed, by reference and after call will contain
             * ONLY pipes with new data to read
             */
            $changedStreamsCount = stream_select($readPipes, $write, $except, $waitTimeout);

            // if child process was terminated
            if ($changedStreamsCount === false) {
                throw new Exception('Proccess was terminated');
            }

            // check client connection is still opened
            phpRack_Adapters_ConnectionMonitor::getInstance()->ping();

            // read data from pipes and attach them to output
            foreach ($readPipes as $pipe) {
                $output .= fread($pipe, 1024);
            }
        }

        // close pipes to avoid deadlock during proc_close()
        fclose($pipes[self::PIPE_STD_OUT]);
        fclose($pipes[self::PIPE_STD_ERR]);

        // close proccess and cleanup
        proc_close($this->_process);
        $this->_process = null;

        return $output;
    }

    /**
     * Shell command destructor
     *
     * @return void
     */
    public function __destruct()
    {
        // if run() method was executed successfully
        if ($this->_process === null) {
            return;
        }

        // get process status
        $processStatus = proc_get_status($this->_process);
        if ($processStatus === false) {
            return;
        }

        // if process is still running, terminate it with SIGKILL
        if ($processStatus['running']) {
            proc_terminate($this->_process, 9);
        }
    }
}