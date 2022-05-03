<?php

namespace App\Models\Sanctum;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends SanctumPersonalAccessToken
{
    use HasFactory;
}
