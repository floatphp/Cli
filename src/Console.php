<?php
/**
 * @author     : JIHAD SINNAOUR
 * @package    : FloatPHP
 * @subpackage : CLI Component
 * @version    : 1.0.2
 * @category   : PHP framework
 * @copyright  : (c) 2017 - 2023 Jihad Sinnaour <mail@jihadsinnaour.com>
 * @link       : https://www.floatphp.com
 * @license    : MIT
 *
 * This file if a part of FloatPHP Framework.
 */

declare(strict_types=1);

namespace FloatPHP\Cli;

class Console extends BuiltIn
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
	 * @param string $command
	 * @param callable $callable
	 * @return void
	 */
    public function registerCommand($command, $callable)
    {
        $this->registry[$command] = $callable;
    }

	/**
	 * @access public
	 * @param string $command
	 * @return bool
	 */
    public function getCommand($command)
    {
        return $this->registry[$command] ?? null;
    }

	/**
	 * @access public
	 * @param array $argv
	 * @return void
	 */
    public function run($argv = [])
    {
        $name = isset($argv[1]) ? $argv[1] : false;
        if ( ($command = $this->getCommand($name)) ) {
            call_user_func($command, $argv);
            
        } else {
            $this->getOutput()->display("FloatPHP : Command '{$name}' not found.");
        }
    }
}
