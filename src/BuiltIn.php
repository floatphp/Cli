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

use FloatPHP\Classes\Filesystem\File;
use FloatPHP\Classes\Filesystem\Stringify;

class BuiltIn
{
    /**
     * @access public
     * @param void
     * @return string
     */
    public function help()
    {
        $this->getOutput()->display('add-page [name] [route] [action] [params] [parent] [method]');
        $this->getOutput()->display('add-model [name]');
        $this->getOutput()->display('add-route [slug] [method]');
        exit();
    }

    /**
     * @access public
     * @param array $args
     * @return string
     */
    public function addPage($args)
    {
        // Parse name parameter
        if ( !($name = $this->parseVars($args)) ) {
            $this->getOutput()->display("FloatPHP : Command 'add-page' require 'name' parameter");
            exit();
        }

        // Parse route parameter
        if ( !($route = $this->parseVars($args, 3)) ) {
            $this->getOutput()->display("FloatPHP : Command 'add-page' require 'route' parameter");
            exit();
        }

        // Parse action parameter
        if ( !($action = $this->parseVars($args, 4)) ) {
            $this->getOutput()->display("FloatPHP : Command 'add-page' require 'action' parameter");
            exit();
        }

        // Parse params parameter
        $params = $this->parseVars($args, 5) ? $this->parseVars($args, 5) : '';

        // Parse parent parameter
        $parent = $this->parseVars($args, 6) ? $this->parseVars($args, 6) : 'front';
        $parent = Stringify::lowercase($parent);
        if ( $parent !== 'front' && $parent !== 'backend' ) {
            $this->getOutput()->display("FloatPHP : Command 'add-page' require valid 'parent' parameter");
            $this->getOutput()->display("Use : (front|backend)");
            exit();
        }

        // Parse method parameter
        $method = $this->parseVars($args, 7) ? $this->parseVars($args, 7) : 'GET';
        $method = Stringify::uppercase($method);
        $methods = ['GET','HEAD','POST','PUT','DELETE','CONNECT','OPTIONS','TRACE','PATCH'];
        if ( !in_array($method, $methods) && !Stringify::contains($method, '|') ) {
            $this->getOutput()->display("FloatPHP : Command 'add-page' require valid 'method' parameter");
            $this->getOutput()->display("Use : (GET, POST, PATCH, DELETE, GET|POST)");
            exit();
        }

        $vars = [
            'name'   => $name,
            'route'  => $route, 
            'action' => $action,
            'params' => $params,
            'parent' => $parent, 
            'method' => $method
        ];

        // Create controller
        $this->generateController($this->buildVars($vars));
        $this->generateRoute($this->buildVars($vars));
        $this->generateView(Stringify::lowercase($name));
    }

    /**
     * @access public
     * @param array $args
     * @return string
     */
    public function addModel($args)
    {
        // Parse name parameter
        if ( !($name = $this->parseVars($args)) ) {
            $this->getOutput()->display("FloatPHP : Command 'add-model' require 'name' parameter");
            exit();
        }

        // Create model
        $this->generateModel($name);
    }

    /**
     * @access private
     * @param array $args
     * @return void
     */
    private function generateController($args)
    {
        $content = new File(dirname(__FILE__).'/bin/controller');
        $content->read();
        $replace = [
            '{slug}'      => $args['slug'], 
            '{name}'      => $args['name'], 
            '{routeName}' => $args['routeName'], 
            '{route}'     => $args['route'], 
            '{method}'    => $args['method'], 
            '{action}'    => $args['action'], 
            '{parent}'    => $args['parent'], 
            '{params}'    => $args['params']
        ];
        $content = Stringify::replaceArray($replace, $content->getContent());
        $target = new File("{$this->getAppRoot()}/App/Controllers/{$args['name']}Controller.php");
        $target->write($content);
    }

    /**
     * @access private
     * @param array $args
     * @return void
     */
    private function generateRoute($args)
    {
        $this->addRoute([
            'method'     => $args['method'],
            'route'      => $args['route'],
            'controller' => "{$args['name']}Controller@{$args['action']}",
            'name'       => $args['routeName']
        ]);
    }

    /**
     * @access private
     * @param array $args
     * @return void
     */
    private function generateModel($name)
    {
        $view = new File("{$this->getAppRoot()}/{$this->getViewPath()}{$name}{$this->getViewExtension()}");
        $view->write("{$name} template");
    }

    /**
     * @access private
     * @param array $args
     * @return void
     */
    private function generateView($name)
    {
        $view = new File("{$this->getAppRoot()}/{$this->getViewPath()}{$name}{$this->getViewExtension()}");
        $view->write("{$name} template");
    }

    /**
     * @access private
     * @param array $args
     * @return array
     */
    private function buildVars($args)
    {
        $args['slug'] = Stringify::lowercase(Stringify::numberStrip($args['name']));
        $args['name'] = Stringify::capitalize($args['slug']);
        $args['routeName'] = $args['slug'] . Stringify::capitalize($args['action']);
        $args['route'] = Stringify::lowercase($args['route']);
        $args['route'] = "/{$args['route']}/";
        $args['action'] = Stringify::lowercase($args['action']);
        $args['parent'] = Stringify::capitalize($args['parent']);
        $args['method'] = Stringify::uppercase($args['method']);
        if ($args['params']) {
            $args['params'] = '$'.$args['params'];
            $args['params'] = Stringify::replace(',',',$',$args['params']);
        }
        return $args;
    }

    /**
     * @access private
     * @param array $args
     * @param int $pos
     * @return mixed
     */
    private function parseVars($args, $pos = 2)
    {
        return isset($args[$pos]) ? $args[$pos] : false;
    }
}
