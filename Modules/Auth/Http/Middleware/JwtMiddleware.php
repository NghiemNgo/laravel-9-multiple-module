<?php

namespace Modules\Auth\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Http\Response;

class JwtMiddleware extends BaseMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json([
                    'code' => Response::HTTP_UNAUTHORIZED,
                    'message' => __('auth::messages.token_invalid')
                ]);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json([
                    'code' => Response::HTTP_UNAUTHORIZED,
                    'message' => __('auth::messages.token_expired')
                ]);
            }else{
                return response()->json([
                    'code' => Response::HTTP_UNAUTHORIZED,
                    'message' => __('auth::messages.token_absent')
                ]);
            }
        }
        return $next($request);
    }
    
}