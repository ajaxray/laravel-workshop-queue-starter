<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
// For state machine
// use Asantibanez\LaravelEloquentStateMachines\Traits\HasStateMachines;

class AccountApplication extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\AccountApplicationFactory> */
    use HasFactory, InteractsWithMedia; //, HasStateMachines;

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'phone',
        'email',
        'street',
        'city',
        'zip',
        'region_state',
        'country',
        'account_type',
        'category',
        'state',
    ];

    // State machine config will go here
}
