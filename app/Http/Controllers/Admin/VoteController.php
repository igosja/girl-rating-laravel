<?php
declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Vote;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Class VoteController
 * @package App\Http\Controllers\Admin
 */
class VoteController extends AbstractController
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
        $query = Vote::query();
        if ($request->query('id')) {
            $query->where('id', $request->query('id'));
        }
        if ($request->query('girl_one_id')) {
            $query->where('girl_one_id', $request->query('girl_one_id'));
        }
        if ($request->query('girl_two_id')) {
            $query->where('girl_two_id', $request->query('girl_two_id'));
        }
        if ($request->query('girl_winner_id')) {
            $query->where('girl_winner_id', $request->query('girl_winner_id'));
        }

        $votes = $query
            ->orderBy($sort, $order)
            ->paginate(10);

        return view('admin.vote.index', [
            'votes' => $votes,
        ]);
    }

    /**
     * @param Vote $vote
     * @return Application|Factory|View
     */
    public function show(Vote $vote): View|Factory|Application
    {
        return view('admin.vote.show', [
            'vote' => $vote,
        ]);
    }
}
