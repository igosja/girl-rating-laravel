<?php
declare(strict_types=1);

namespace App\Services;

use App\Interfaces\Executable;
use App\Models\Girl;
use App\Models\Vote;

/**
 * Class VoteService
 * @package App\Service
 */
class VoteService implements Executable
{
    private const COEFFICIENT_JUNIOR = 25;
    private const COEFFICIENT_MIDDLE = 15;
    private const COEFFICIENT_SENIOR = 10;

    private const JUNIOR_LIMIT = 15;
    private const MIDDLE_LIMIT = 2400;

    /**
     * @var Vote $vote
     */
    private Vote $vote;

    /**
     * @var Girl $girl
     */
    private Girl $girl;

    /**
     * @param Vote $vote
     * @return void
     */
    public function setVote(Vote $vote): void
    {
        $this->vote = $vote;
    }

    /**
     * @param Girl $girl
     * @return void
     */
    public function setGirl(Girl $girl): void
    {
        $this->girl = $girl;
    }

    /**
     * @return bool
     */
    public function execute(): bool
    {
        if ($this->vote->girl_winner_id) {
            return false;
        }

        if (!in_array($this->girl->id, [$this->vote->girl_one_id, $this->vote->girl_two_id])) {
            return false;
        }

        $this->updateVote();
        $this->updateGirls();

        return true;
    }

    /**
     * @return void
     */
    private function updateVote(): void
    {
        $this->vote->girl_winner_id = $this->girl->id;
        $this->vote->save();
    }

    /**
     * @return void
     */
    private function updateGirls(): void
    {
        /**
         * @var Girl $girlOne
         * @var Girl $girlTwo
         */
        $girlOne = $this->vote->girlOne()->first();
        $girlTwo = $this->vote->girlTwo()->first();

        $girlOneNewRating = $this->getNewRating($girlOne);
        $girlTwoNewRating = $this->getNewRating($girlTwo);

        $girlOne->rating = $girlOneNewRating;
        $girlOne->votes++;
        $girlOne->save();

        $girlTwo->rating = $girlTwoNewRating;
        $girlTwo->votes++;
        $girlTwo->save();
    }

    /**
     * @param Girl $girl
     * @return int
     */
    private function getNewRating(Girl $girl): int
    {
        return (int) round(
            $girl->rating
            + $this->getCoefficient($girl)
            * ($this->getScoredPoints($girl) - $this->getExpectedPoints($girl))
        );
    }

    /**
     * @param Girl $girl
     * @return int
     */
    private function getCoefficient(Girl $girl): int
    {
        if ($girl->votes <= self::JUNIOR_LIMIT) {
            return self::COEFFICIENT_JUNIOR;
        }

        if ($girl->rating <= self::MIDDLE_LIMIT) {
            return self::COEFFICIENT_MIDDLE;
        }

        return self::COEFFICIENT_SENIOR;
    }

    /**
     * @param Girl $girl
     * @return int
     */
    private function getScoredPoints(Girl $girl): int
    {
        if ($this->vote->girl_winner_id === $girl->id) {
            return 1;
        }
        return 0;
    }

    /**
     * @param Girl $girl
     * @return float
     */
    private function getExpectedPoints(Girl $girl): float
    {
        return 1 / (1 + 10 ** (($girl->rating - $this->getOpponentRating($girl)) / 400));
    }

    /**
     * @param Girl $girl
     * @return int
     */
    private function getOpponentRating(Girl $girl): int
    {
        /**
         * @var Girl $opponent
         */
        $opponent = $this->vote->girlOne()->first();
        if ($this->vote->girl_one_id === $girl->id) {
            $opponent = $this->vote->girlTwo()->first();
        }

        return $opponent->rating;
    }
}
