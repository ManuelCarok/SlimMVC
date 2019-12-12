<?php

class JwtMiddleware {

    public function __invoke($request, $response, $next)
    {
        $response = $next($request, $response);
        
        return $response;
    }

}