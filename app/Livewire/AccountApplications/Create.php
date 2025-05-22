<?php

namespace App\Livewire\AccountApplications;

use App\Livewire\Forms\AccountApplicationForm;
use App\Models\AccountApplication;
use Livewire\Component;

class Create extends Component
{
    public AccountApplicationForm $form;

    public function mount(AccountApplication $accountApplication)
    {
        $this->form->setAccountApplicationModel($accountApplication);
    }

    public function save()
    {
        $this->form->store();

        return $this->redirectRoute('account-applications.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.account-application.create');
    }
}
