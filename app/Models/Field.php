<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\FieldType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Field extends Model
{
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function getFieldTypeEnum(): FieldType
    {
        return FieldType::from($this->field_type);
    }

    public function getCssClasses(): string
    {
        return $this->getFieldTypeEnum()->cssClasses();
    }

    public function getIcon(): string
    {
        return $this->getFieldTypeEnum()->icon();
    }
}
