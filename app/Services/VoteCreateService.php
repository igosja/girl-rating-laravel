<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\Executable;
use App\Models\Girl;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class VoteCreateService
 * @package App\Service
 */
class VoteCreateService implements Executable
{
    /**
     * @var Collection|array
     */
    private array|Collection $girls = [];

    /**
     * @var Vote|null $vote
     */
    private ?Vote $vote = null;

    /**
     * @return bool
     */
    public function execute(): bool
    {
        $this->loadGirls();
        $this->createVote();
        return true;
    }

    /**
     * @return Vote
     */
    public function getVote(): Vote
    {
        return $this->vote;
    }

    /**
     * @return void
     */
    private function loadGirls(): void
    {
        $this->girls = Girl::query()
            ->inRandomOrder()
            ->limit(2)
            ->get();
    }

    /**
     * @return void
     */
    private function createVote(): void
    {
        $this->vote = new Vote();
        $this->vote->girl_one_id = $this->girls[0]->id;
        $this->vote->girl_two_id = $this->girls[1]->id;
        $this->vote->save();
    }
}
