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
