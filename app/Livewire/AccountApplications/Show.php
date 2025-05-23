<?php

namespace App\Livewire\AccountApplications;

use App\Jobs\VerifyNID;
use App\Livewire\Forms\AccountApplicationForm;
use App\Models\AccountApplication;
use Livewire\Component;

class Show extends Component
{
    public AccountApplication $accountApplication;

    public function mount(AccountApplication $accountApplication)
    {
        $this->accountApplication = $accountApplication;
    }

    public function render()
    {
        return view('livewire.account-application.show', ['accountApplication' => $this->accountApplication]);
    }

    public function startProcess()
    {
        VerifyNID::dispatch($this->accountApplication);
        $this->dispatch('success', message: 'Process started successfully');        
    }
}
