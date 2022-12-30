<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GirlStoreRequest;
use App\Http\Requests\GirlUpdateRequest;
use App\Models\Girl;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class GirlController
 * @package App\Http\Controllers\Admin
 */
class GirlController extends AbstractController
{
    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request): View|Factory|Application
    {
        $sort = $request->query('sort', '-id');
        $order = 'ASC';
        if ('-' === $sort[0]) {
            $order = 'DESC';
            $sort = substr($sort, 1);
        }
        $query = Girl::query();
        if ($request->query('id')) {
            $query->where('id', $request->query('id'));
        }
        if ($request->query('name')) {
            $query->where('name', 'like', '%' . $request->query('name') . '%');
        }

        $girls = $query
            ->orderBy($sort, $order)
            ->paginate(10);

        return view('admin.girl.index', [
            'girls' => $girls,
        ]);
    }

    /**
     * @param GirlStoreRequest $request
     * @return RedirectResponse
     */
    public function store(GirlStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $girl = new Girl();
        $girl->created_by = Auth::id();
        $girl->name = $data['name'];
        if (!$girl->save()) {
            return back();
        }

        $file = $request->file('image');
        $file?->move(
            public_path('uploads'),
            $girl->id . '.jpg'
        );

        return redirect()->route('girls.show', [
            'girl' => $girl,
        ]);
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin.girl.create');
    }

    /**
     * @param Girl $girl
     * @return Application|Factory|View
     */
    public function show(Girl $girl): View|Factory|Application
    {
        return view('admin.girl.show', [
            'girl' => $girl,
        ]);
    }

    /**
     * @param Girl $girl
     * @return Application|Factory|View
     */
    public function edit(Girl $girl): View|Factory|Application
    {
        return view('admin.girl.edit', [
            'girl' => $girl,
        ]);
    }

    /**
     * @param GirlUpdateRequest $request
     * @param Girl $girl
     * @return RedirectResponse
     */
    public function update(GirlUpdateRequest $request, Girl $girl): RedirectResponse
    {
        $data = $request->validated();

        $girl->name = $data['name'];
        if (!$girl->save()) {
            return back();
        }

        $file = $request->file('image');
        if ($file) {
            if (file_exists($girl->getFilePath())) {
                unlink($girl->getFilePath());
            }

            $file->move(
                public_path('uploads'),
                $girl->id . '.jpg'
            );
        }

        return redirect()->route('girls.show', [
            'girl' => $girl,
        ]);
    }

    /**
     * @param Girl $girl
     * @return RedirectResponse
     */
    public function destroy(Girl $girl): RedirectResponse
    {
        if (file_exists($girl->getFilePath())) {
            unlink($girl->getFilePath());
        }

        $girl->delete();

        return redirect()->route('girls.index');
    }
}
