<?php

namespace App\Stats;

use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class AccountState extends State
{
    abstract public function label(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Submitted::class)
            ->registerState([
                Submitted::class,
                NIDVerified::class,
                PhotoChecked::class,
                NSFWChecked::class,
                DocumentClassified::class,
                ManualReview::class,
                Approved::class,
                Rejected::class,
            ])
            ->allowTransition(Submitted::class, NIDVerified::class)
            ->allowTransition(NIDVerified::class, PhotoChecked::class)
            ->allowTransition(NIDVerified::class, Rejected::class)
            ->allowTransition(PhotoChecked::class, NSFWChecked::class)
            ->allowTransition(PhotoChecked::class, ManualReview::class)
            ->allowTransition(NSFWChecked::class, DocumentClassified::class)
            ->allowTransition(NSFWChecked::class, ManualReview::class)
            ->allowTransition(DocumentClassified::class, ManualReview::class)
            ->allowTransition(DocumentClassified::class, Approved::class)
            ->allowTransition(ManualReview::class, NIDVerified::class)
            ->allowTransition(ManualReview::class, PhotoChecked::class)
            ->allowTransition(ManualReview::class, NSFWChecked::class)
            ->allowTransition(ManualReview::class, DocumentClassified::class)
            ->allowTransition(ManualReview::class, Approved::class)
            ->allowTransition(ManualReview::class, Rejected::class);
    }

    public function color(): string
    {
        return match ($this::class) {
            Submitted::class => 'lime',
            ManualReview::class => 'yellow',
            Approved::class => 'green',
            Rejected::class => 'red',
            default => 'gray',
        };
    }

    public function is(string $stateClass): bool
    {
        return static::class === $stateClass;
    }
} 