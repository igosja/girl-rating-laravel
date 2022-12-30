<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Girl;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class SiteController
 * @package App\Http\Controllers\Admin
 */
class SiteController extends AbstractController
{
    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $girls = Girl::query()
            ->orderBy('rating', 'DESC')
            ->limit(3)
            ->getModels();

        return view('admin.site.index', [
            'girls' => $girls,
        ]);
    }
}
