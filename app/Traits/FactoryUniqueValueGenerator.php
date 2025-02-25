<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait FactoryUniqueValueGenerator
{
    public function generateUniqueId(): int
    {
        $lastId = $this->model::query()->latest('id')->first();
        $lastIdValue = $lastId ? $lastId->id : 0;
        return $lastIdValue + 1;
    }

    public function generateUniqueEmail(): string
    {
        $email = fake()->unique()->safeEmail();
        $emailExists = $this->model::query()->where('email', $email)->exists();
        return $emailExists ? Str::random(6) .'-'. $email : $email;
    }
}
