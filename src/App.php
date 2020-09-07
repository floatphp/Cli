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

class App extends Console
{
    /**
     * @param void
     * @return void
     */
    public function __construct()
    {
        $this->registerCommand('help', function ($argv) use ($this) {
            $this->getPrinter()->display("usage: minicli hello [ your-name ]");
        });
        $this->runCommand($argv);
    }
}
