<?php

namespace App\Http\Middleware;

use Closure;

use App\Models\MainMenu;
use App\Models\SubMenu;

class ActiveMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $reqPath = explode('/', $request->path());
        $mainMenuId = MainMenu::where('mm_name', $reqPath[0])->first()['id'];
        $subMenuId = SubMenu::where([
            ['mm_id', '=', $mainMenuId],
            ['sm_name', '=', $reqPath[1]],
        ])->first()['id'];
        $activeMenu = $mainMenuId.'-'.$subMenuId;
        $request->session()->put('activeMenu', $activeMenu);

        return $next($request);
    }
}
