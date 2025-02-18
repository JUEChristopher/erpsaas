<?php

namespace App\Interfaces\Utility;

use Illuminate\Database\Eloquent\Model;

interface DocumentNumber
{
    public function getNextNumber(?Model $model, ?string $type, int|string $number, string $prefix, int|string $digits, bool|null $padded = true): string;

    public function incrementNumber(Model $model, string $type): void;
}
