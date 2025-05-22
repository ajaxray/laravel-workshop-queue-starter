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
        'tracking_id',
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
        'national_id',
        'passport_number',
        'state',
    ];

    // State machine config will go here

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Generate tracking id
            if (empty($model->tracking_id)) {
                do {
                    $trackingId = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
                } while (self::where('tracking_id', $trackingId)->exists());

                $model->tracking_id = $trackingId;
            }
        });
    }

    public function registerMediaConversions(?\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(\Spatie\Image\Enums\Fit::Crop, 200, 200)
            ->quality(80);
    }
}
