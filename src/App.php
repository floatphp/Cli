<?php
/**
 * @author     : Jakiboy
 * @package    : FloatPHP
 * @subpackage : CLI Component
 * @version    : 1.2.x
 * @copyright  : (c) 2018 - 2024 Jihad Sinnaour <mail@jihadsinnaour.com>
 * @link       : https://floatphp.com
 * @license    : MIT
 *
 * This file if a part of FloatPHP Framework.
 */

declare(strict_types=1);

namespace FloatPHP\Cli;

class App
{
    /**
     * Setup CLI App.
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
