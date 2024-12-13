<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDatabaseForModel
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, ...$models)
    {
        foreach ($models as $model) {
            $classModel = 'App\\Models\\' . ucfirst($model);
            if (!class_exists($classModel) || ! $classModel::query()->exists()) {
                return redirect()->route('no-access', ['model' => $model]);
            }
        }
        return $next($request);
    }

}
