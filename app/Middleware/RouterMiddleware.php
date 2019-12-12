<?php

namespace Middleware;

class RouterMiddleware {

    public function __invoke($request, $response, $next)
    {
        $route = $request->getAttribute('route'); 
        $routeName = $route->getName(); 
        $groups = $route->getGroups(); 
        $methods = $route->getMethods(); 
        $arguments = $route->getArguments(); 

        //print "Route Info: " . print_r($route, true); 
        //print "Route Name: " . print_r($routeName, true)."<br>";
        //print "Route Groups: " . print_r($groups, true); 
        //print "Route Methods: " . print_r($methods, true)."<br>"; 
        //print "Route Arguments: " . print_r($arguments, true);

        // echo array_reduce([2, 5, 8, 1, 4, 11, 12], function ($isBigger, $num) {
        //     return $isBigger || $num > 10;
        // });

        $response = $next($request, $response);
        
        return $response;
    }

}