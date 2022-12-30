<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Girl
 * @package App\Models
 *
 * @property int $id
 * @property int $created_by
 * @property string $name
 * @property int $rating
 * @property int $votes
 * @property string $created_at
 * @property string $updated_at
 */
class Girl extends Model
{
    use HasFactory;

    /**
     * @return bool|null
     */
    public function delete(): ?bool
    {
        if (file_exists($this->getFilePath())) {
            unlink($this->getFilePath());
        }
        return parent::delete();
    }

    /**
     * @return BelongsTo
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return public_path('uploads') . '/' . $this->id . '.jpg';
    }

    /**
     * @return string
     */
    public function getFileUrl(): string
    {
        if (!file_exists($this->getFilePath())) {
            return '';
        }

        return '/uploads/' . $this->id . '.jpg?v=' . filemtime($this->getFilePath());
    }
}
