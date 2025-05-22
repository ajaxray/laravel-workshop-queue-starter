<?php

namespace App\Livewire\AccountApplications;

use App\Models\AccountApplication;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render(): View
    {
        $accountApplications = AccountApplication::paginate();

        return view('livewire.account-application.index', compact('accountApplications'))
            ->with('i', $this->getPage() * $accountApplications->perPage());
    }

    public function delete(AccountApplication $accountApplication)
    {
        $accountApplication->delete();

        return $this->redirectRoute('account-applications.index', navigate: true);
    }
}
