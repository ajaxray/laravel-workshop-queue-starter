<?php

namespace App\Livewire\AccountApplications;

use App\Models\AccountApplication;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use App\Stats\AccountState;
use App\Stats\Submitted;
use App\Stats\NIDVerified;
use App\Stats\PhotoChecked;
use App\Stats\NSFWChecked;
use App\Stats\DocumentClassified;
use App\Stats\ManualReview;
use App\Stats\Approved;
use App\Stats\Rejected;

class Index extends Component
{
    use WithPagination;

    public $stateFilter = '';

    public function updatingStateFilter()
    {
        $this->resetPage();
    }

    public function getStateOptionsProperty()
    {
        return [
            '' => 'All States',
            Submitted::class => (new Submitted(null))->label(),
            NIDVerified::class => (new NIDVerified(null))->label(),
            PhotoChecked::class => (new PhotoChecked(null))->label(),
            NSFWChecked::class => (new NSFWChecked(null))->label(),
            DocumentClassified::class => (new DocumentClassified(null))->label(),
            ManualReview::class => (new ManualReview(null))->label(),
            Approved::class => (new Approved(null))->label(),
            Rejected::class => (new Rejected(null))->label(),
        ];
    }

    public function render(): View
    {
        $query = AccountApplication::query();
        if ($this->stateFilter) {
            $query->where('state', $this->stateFilter);
        }
        $accountApplications = $query->paginate();

        return view('livewire.account-application.index', compact('accountApplications'))
            ->with('i', $this->getPage() * $accountApplications->perPage())
            ->with('stateOptions', $this->stateOptions);
    }

    public function delete(AccountApplication $accountApplication)
    {
        $accountApplication->delete();

        return $this->redirectRoute('account-applications.index', navigate: true);
    }
}
