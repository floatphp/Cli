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
     * @param void
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
        $this->newline();
        $this->out($message);
        $this->newline();
        $this->newline();
    }
}
