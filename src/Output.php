<?php
/**
 * @author     : Jakiboy
 * @package    : FloatPHP
 * @subpackage : CLI Component
 * @version    : 1.1.0
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
    public function out($message)
    {
        echo $message;
    }

    /**
     * @access public
     * @return string
     */
    public function newline()
    {
        $this->out("\n");
    }

    /**
     * @access public
     * @param string $message
     * @return void
     */
    public function display($message)
    {
        $this->out($message);
        $this->newline();
    }
}
