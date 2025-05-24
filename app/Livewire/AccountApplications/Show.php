<?php

namespace App\Livewire\AccountApplications;

use App\Jobs\VerifyNID;
use App\Livewire\Forms\AccountApplicationForm;
use App\Models\AccountApplication;
use App\Stats\Submitted;
use App\Stats\AccountState;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class Show extends Component
{
    public AccountApplication $accountApplication;
    public $selectedState = '';
    public $showConfirmModal = false;

    public function mount(AccountApplication $accountApplication)
    {
        $this->accountApplication = $accountApplication;
    }

    public function getNextStatesProperty()
    {
        // Get valid next states using transitionableStates()
        return $this->accountApplication->state->transitionableStates();
    }

    public function confirmTransition()
    {
        if (!$this->selectedState) return;
        $this->showConfirmModal = true;
    }

    public function performTransition()
    {
        if (!$this->selectedState) return;
        $this->accountApplication->state->transitionTo($this->selectedState);
        $this->accountApplication->refresh();
        $this->showConfirmModal = false;
        $this->selectedState = '';
        \Masmerise\Toaster\Toaster::success('State changed successfully!');
    }

    public function render()
    {
        return view('livewire.account-application.show', [
            'accountApplication' => $this->accountApplication,
            'nextStates' => $this->nextStates,
        ]);
    }

    public function startProcess()
    {        
        if ($this->accountApplication->state->is(Submitted::class)) {
            VerifyNID::dispatch($this->accountApplication);
            Toaster::success('Queued for NID Verification');
            $this->redirect(route('account-applications.index'));
        } else {
            Toaster::error('Application is not in Submitted state');
        }
    }
}
