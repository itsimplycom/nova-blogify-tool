<?php

namespace Its\NovaBlogifyTool\Http\Middleware;

use Its\NovaBlogifyTool\NovaBlogifyTool;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return resolve(NovaBlogifyTool::class)->authorize($request) ? $next($request) : abort(403);
    }
}
