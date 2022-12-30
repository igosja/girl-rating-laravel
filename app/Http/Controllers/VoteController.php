<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Girl;
use App\Models\Vote;
use App\Services\VoteCreateService;
use App\Services\VoteService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

/**
 * Class VoteController
 * @package App\Http\Controllers
 */
class VoteController extends AbstractController
{
    /**
     * @param VoteCreateService $voteCreateService
     * @return RedirectResponse
     */
    public function index(VoteCreateService $voteCreateService): RedirectResponse
    {
        $vote = Vote::query()
            ->where('girl_winner_id', null)
            ->where('created_at', '<', time() - 24 * 60 * 60)
            ->first();
        if ($vote) {
            return redirect()->route('vote_view', [
                'vote' => $vote,
            ]);
        }

        $voteCreateService->execute();

        return redirect()->route('vote_view', [
            'vote' => $voteCreateService->getVote(),
        ]);
    }

    /**
     * @param Vote $vote
     * @return Application|Factory|View|RedirectResponse
     */
    public function view(Vote $vote): View|Factory|RedirectResponse|Application
    {
        if ($vote->girl_winner_id) {
            return redirect()->route('vote');
        }

        return view('vote.view', [
            'vote' => $vote,
        ]);
    }

    /**
     * @param Vote $vote
     * @param Girl $girl
     * @param VoteService $voteService
     * @return RedirectResponse
     */
    public function vote(Vote $vote, Girl $girl, VoteService $voteService): RedirectResponse
    {
        if ($vote->girl_winner_id) {
            return redirect()->route('vote');
        }

        $voteService->setGirl($girl);
        $voteService->setVote($vote);

        if (!$voteService->execute()) {
            return redirect()->route('vote_view', [
                'vote' => $vote,
            ]);
        }

        return redirect()->route('vote');
    }
}
