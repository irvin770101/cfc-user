<?php

namespace KSD\Member\Http\Middleware;

use KSD\Member\Exceptions\MemberNotAuthorisedException;
use Closure;

class AuthMember
{
    use \KSD\Member\Traits\MemberValidator;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->isMemberValid()) {
            return $next($request);
        }
        throw new MemberNotAuthorisedException();
    }
}
