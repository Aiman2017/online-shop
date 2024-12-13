<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $data = Cache::remember('data', 30, function () {
            return $this->getUserStatistics();
        });

        Log::info('Cached data:', $data);

        return view(
            'admin.index',
            [
                'title' => 'Home Page',
                'data' => $data,
            ]
        );
    }

    private function getUserStatistics(): array
    {
        $userData = $this->getMonthlyUserCounts();

        $totalUsers = $userData->sum('count');
        return [
            'count' => $userData->pluck('count'),
            'month' => $userData->pluck('month'),
            'notVerified' => $this->calculateVerificationPercentage($totalUsers),
            'newUsers' => $this->calculateNewUserPercentage($totalUsers),
            'totalUsers' => $totalUsers,
        ];
    }

    private function getMonthlyUserCounts(): Collection|array
    {
        return User::query()->selectRaw('count(id) as count, DATE_FORMAT(created_at, "%Y-%m-%d") as month')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();
    }

    private function calculateVerificationPercentage(int $totalUsers): float
    {
        $verifiedCount = User::query()->whereNotNull('email_verified_at')->count();
        return $totalUsers > 0 ? round(($verifiedCount / $totalUsers) * 100, 1) : 0;
    }

    private function calculateNewUserPercentage(int $totalUsers): float
    {
        $newUser = User::query()->where('created_at', '>', now()->subMonths())->count();

        return $totalUsers > 0 ? round(($newUser / $totalUsers) * 100) : 0;
    }

    public function noAccess(string $model = 'category'): View
    {
        $modelClass = 'App\\Models\\'.ucfirst($model);

        if (!class_exists($modelClass)) {
            abort(404, "Model $model not found.");
        }

        $tableName = (new $modelClass())->getTable();

        $link = route('admin.'.$tableName.'.create');

        $message = 'The '.ucfirst($tableName).' is empty. You should create '.ucfirst(
                $model
            ).' first. <a href="'.$link.'">Create '.ucfirst($model).'</a>';

        session()->flash('error', $message);

        return view('admin.components.no-access');
    }

    public function clearCache(): RedirectResponse
    {
        cache()->flush();
        return redirect()->back();
    }

}
