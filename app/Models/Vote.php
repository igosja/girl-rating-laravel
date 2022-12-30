<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Vote
 * @package App\Models
 *
 * @property int $id
 * @property int $girl_one_id
 * @property int $girl_two_id
 * @property int $girl_winner_id
 * @property string $created_at
 * @property string $updated_at
 */
class Vote extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function girlOne(): BelongsTo
    {
        return $this->belongsTo(Girl::class, 'girl_one_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function girlTwo(): BelongsTo
    {
        return $this->belongsTo(Girl::class, 'girl_two_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function girlWinner(): BelongsTo
    {
        return $this->belongsTo(Girl::class, 'girl_winner_id', 'id');
    }
}
