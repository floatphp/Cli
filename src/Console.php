<?php
/**
 * @author    : JIHAD SINNAOUR
 * @package   : FloatPHP
 * @subpackage: cli Component
 * @version   : 1.1.0
 * @category  : PHP framework
 * @copyright : (c) JIHAD SINNAOUR <mail@jihadsinnaour.com>
 * @link      : https://www.floatphp.com
 * @license   : MIT License
 *
 * This file if a part of FloatPHP Framework
 */

namespace floatPHP\Cli;

class Console
{
	/**
	 * @access protected
	 * @var object $output
	 * @var array $registry
	 */
    protected $output;
    protected $registry = [];

	/**
	 * @param void
	 * @return void
	 */
    public function __construct()
    {
        $this->output = new Output();
    }

	/**
	 * @access public
	 * @param void
	 * @return object
	 */
    public function getOutput()
    {
        return $this->output;
    }

	/**
	 * @access public
	 * @param string $name
	 * @param callable $callable
	 * @return void
	 */
    public function registerCommand($name, $callable)
    {
        $this->registry[$name] = $callable;
    }

	/**
	 * @access public
	 * @param string $command
	 * @return boolean
	 */
    public function getCommand($command)
    {
        return isset($this->registry[$command]) ? $this->registry[$command] : null;
    }

	/**
	 * @access public
	 * @param array $argv
	 * @return void
	 */
    public function runCommand($argv = [])
    {
        $name = 'help';
        if ( isset($argv[1]) ) {
            $name = $argv[1];
        }
        $command = $this->getCommand($name);
        if ($command) {
            $this->getOutput()->display("FloatPHP Error : Command '{$name}' not found.");
            exit();
        }
        call_user_func($command, $argv);
    }
}
