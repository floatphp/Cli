<?php
/**
 * @author     : Jakiboy
 * @package    : FloatPHP
 * @subpackage : CLI Component
 * @version    : 1.5.x
 * @copyright  : (c) 2018 - 2025 Jihad Sinnaour <me@jihadsinnaour.com>
 * @link       : https://floatphp.com
 * @license    : MIT
 *
 * This file is a part of FloatPHP Framework.
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
	 * @return void
	 */
	public function __construct()
	{
		$this->output = new Output();
	}

	/**
	 * @access public
	 * @return object
	 */
	public function getOutput() : object
	{
		return $this->output;
	}

	/**
	 * @access public
	 * @param string $command
	 * @param callable $callable
	 * @return void
	 */
	public function registerCommand($command, $callable) : void
	{
		$this->registry[$command] = $callable;
	}

	/**
	 * @access public
	 * @param string $command
	 * @return mixed
	 */
	public function getCommand($command) : mixed
	{
		return $this->registry[$command] ?? null;
	}

	/**
	 * @access public
	 * @param array $argv
	 * @return void
	 */
	public function run($argv = []) : void
	{
		$name = isset($argv[1]) ? $argv[1] : false;
		if ( ($command = $this->getCommand($name)) ) {
			call_user_func($command, $argv);

		} else {
			$this->getOutput()->display("FloatPHP : Command '{$name}' not found.");
		}
	}
}
