<?php

namespace App\Http\Middleware;

use App\Models\ActivityLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActivityLogger
{
    protected array $skipRoutes = ['login', 'logout', 'dashboard'];
    protected array $logMethods = ['POST', 'PUT', 'PATCH', 'DELETE'];

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (auth()->check() && in_array($request->method(), $this->logMethods)) {
            $this->log($request);
        }

        return $response;
    }

    protected function log(Request $request): void
    {
        try {
            $routeName = $request->route()?->getName() ?? '';
            $segments  = explode('.', $routeName);
            $module    = ucfirst($segments[1] ?? 'System');
            $action    = $this->detectAction($request->method(), $segments[2] ?? '');

            ActivityLog::create([
                'user_id'     => auth()->id(),
                'action'      => $action,
                'module'      => $module,
                'description' => $action . ' ' . $module . ' via ' . $request->method(),
                'ip_address'  => $request->ip(),
                'user_agent'  => $request->userAgent(),
            ]);
        } catch (\Throwable $e) {
            // Jangan gagalkan request hanya karena log gagal
        }
    }

    protected function detectAction(string $method, string $routeAction): string
    {
        return match (true) {
            $method === 'POST' && $routeAction === 'store'   => 'create',
            $method === 'PUT'  && $routeAction === 'update'  => 'update',
            $method === 'PATCH'                              => 'update',
            $method === 'DELETE'                             => 'delete',
            str_contains($routeAction, 'verifikasi')         => 'verify',
            str_contains($routeAction, 'validasi')           => 'validate',
            str_contains($routeAction, 'publish')            => 'publish',
            str_contains($routeAction, 'toggle')             => 'toggle',
            default                                          => strtolower($method),
        };
    }
}