<?php
/**
 * @author     : Jakiboy
 * @package    : FloatPHP
 * @subpackage : CLI Component
 * @version    : 1.3.x
 * @copyright  : (c) 2018 - 2024 Jihad Sinnaour <mail@jihadsinnaour.com>
 * @link       : https://floatphp.com
 * @license    : MIT
 *
 * This file if a part of FloatPHP Framework.
 */

declare(strict_types=1);

namespace FloatPHP\Cli;

class Output
{
    /**
     * @access public
     * @param string $message
     * @return string
     */
    public function out($message) : void
    {
        echo $message;
    }

    /**
     * @access public
     * @return string
     */
    public function newline() : void
    {
        $this->out("\n");
    }

    /**
     * @access public
     * @param string $message
     * @return void
     */
    public function display($message) : void
    {
        $this->out($message);
        $this->newline();
    }
}
