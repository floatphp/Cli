<?php
/**
 * @author    : JIHAD SINNAOUR
 * @package   : FloatPHP
 * @subpackage: CLI Component
 * @version   : 1.0.0
 * @category  : PHP framework
 * @copyright : (c) 2017 - 2021 JIHAD SINNAOUR <mail@jihadsinnaour.com>
 * @link      : https://www.floatphp.com
 * @license   : MIT License
 *
 * This file if a part of FloatPHP Framework
 */

namespace FloatPHP\Cli;

class App
{
    /**
     * @param void
     * @return void
     */
    public function __construct()
    {
        global $argv;
        $console = new Console();
        $console->registerCommand('help', function($argv) use($console) {
            $console->help();
        });
        $console->registerCommand('add-page', function($argv) use($console) {
            $console->addPage($argv);
        });
        $console->run($argv);
    }
}
