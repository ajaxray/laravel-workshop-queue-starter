<?php

namespace App\Livewire\AccountApplications;

use App\Livewire\Forms\AccountApplicationForm;
use App\Models\AccountApplication;
use Livewire\Component;

class Show extends Component
{
    public AccountApplicationForm $form;

    public function mount(AccountApplication $accountApplication)
    {
        $this->form->setAccountApplicationModel($accountApplication);
    }

    public function render()
    {
        return view('livewire.account-application.show', ['accountApplication' => $this->form->accountApplicationModel]);
    }
}
