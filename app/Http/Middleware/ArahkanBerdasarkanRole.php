<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ArahkanBerdasarkanRole
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (!$user) return $next($request);

        // Kasir hanya boleh akses halaman kasir & pesanan
        if ($user->peran === 'kasir') {
            $allowed = ['/admin/kasir', '/admin/pesanan'];
            $path = '/' . ltrim($request->path(), '/');
            $isAllowed = collect($allowed)->contains(fn($p) => str_starts_with($path, $p));

            if (!$isAllowed && $path !== '/admin/logout') {
                return redirect('/admin/kasir');
            }
        }

        return $next($request);
    }
}