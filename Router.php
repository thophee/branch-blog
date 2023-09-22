<?php
namespace App;

class Router
{

    private static $routes = array();
    private static $pathNotFound = null;
    private static $methodNotAllowed = null;


    public static function add($expression, $function, $method = 'get')
    {
        self::$routes[] = array(
            'expression' => $expression,
            'function' => $function,
            'method' => $method
        );
    }

    public static function pathNotFound($function)
    {
        self::$pathNotFound = $function;
    }

    public static function methodNotAllowed($function)
    {
        self::$methodNotAllowed = $function;
    }

    public static function run($basePath = '', $multimatch = false)
    {
        $basePath = rtrim($basePath, '/');

        $parsed_url = parse_url($_SERVER['REQUEST_URI']);

        $path = '/';

        // If there is a path available
        if (isset($parsed_url['path'])) {
            if ($basePath . '/' != $parsed_url['path']) {
                $path = rtrim($parsed_url['path'], '/');
            } else {
                $path = $parsed_url['path'];


            }

            $path = urldecode($path);

            $method = $_SERVER['REQUEST_METHOD'];

            $path_match_found = false;

            $route_match_found = false;

            foreach (self::$routes as $route) {
                if ($basePath != '' && $basePath != '/') {
                    $route['expression'] = '(' . $basePath . ')' . $route['expression'];
                }

                $route['expression'] = '^' . $route['expression'];

                $route['expression'] = $route['expression'] . '$';


                if (preg_match('(' . $route['expression'] . ')', $path, $matches)) {
                    $path_match_found = true;

                    foreach ((array)$route['method'] as $allowedMethod) {

                        if (strtolower($method) == strtolower($allowedMethod)) {
                            array_shift($matches); // Always remove first element. This contains the whole string

                            if ($basePath != '' && $basePath != '/') {
                                array_shift($matches); // Remove basepath
                            }
                            $parameters = new RouteParameters(Router::getParameters($method), $matches);
                            if ($return_value = call_user_func_array($route['function'], array($parameters))) {
                                return $return_value;
                            }
                            $route_match_found = true;
                            break;
                        }
                    }
                }

                if ($route_match_found && !$multimatch) {
                    break;
                }

            }

            if (!$route_match_found) {
                // But a matching path exists
                if ($path_match_found) {
                    if (self::$methodNotAllowed) {
                        if ($return_value = call_user_func_array(self::$methodNotAllowed, array($path, $method))) {
                            return $return_value;
                        }
                    }
                } else {
                    if (self::$pathNotFound) {
                        if ($return_value = call_user_func_array(self::$pathNotFound, array($path))) {
                            return $return_value;
                        }
                    }
                }

            }
        }
    }
    public static function getParameters($method) {
        if($method == "GET") {
            return $_GET;
        }
        if($method == "POST") {
            return $_POST;
        }
        return array();
    }

}