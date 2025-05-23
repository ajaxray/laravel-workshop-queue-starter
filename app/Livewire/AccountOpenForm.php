<?php

namespace App\Livewire;

use App\Jobs\VerifyNID;
use Livewire\Component;
use App\Models\AccountApplication;
use App\Stats\Submitted;
use Illuminate\Support\Facades\Mail;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app.guest')]
class AccountOpenForm extends Component
{
    use WithFileUploads;

    public $first_name, $last_name, $birth_date, 
        $phone, $email, 
        $street, $city, $zip, $region_state, 
        $account_type, $category,
        $national_id, $passport_number;

    public $country = 'Bangladesh';
    public $photo;
    public $documents = [];
    public $_answer; // Simple Captcha
    

    protected function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'phone' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'region_state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'account_type' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'national_id' => 'nullable|string|max:19',
            'passport_number' => 'required_without:national_id|string|max:25',
            'photo' => 'required|image|max:2048',
            'documents.*' => 'file|mimes:jpg,jpeg,png,pdf|max:4096',
            '_answer' => 'required|simple_captcha',
        ];
    }

    public function submit()
    {
        $this->validate();

        $application = $this->createAccountApplication();
        $this->handleUploads($application);

        // VerifyNID::dispatch($application);

        Mail::to($this->email)->send(new \App\Mail\AccountApplicationSubmitted($application));

        session()->flash('success', 'Your application has been submitted! Your tracking number is ' . $trackingNumber . '.');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.account-open-form');
    }

    private function createAccountApplication(): AccountApplication
    {
        return AccountApplication::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'birth_date' => $this->birth_date,
            'phone' => $this->phone,
            'email' => $this->email,
            'street' => $this->street,
            'city' => $this->city,
            'zip' => $this->zip,
            'region_state' => $this->region_state,
            'country' => $this->country,
            'account_type' => $this->account_type,
            'category' => $this->category,
            'national_id' => $this->national_id,
            'passport_number' => $this->passport_number,
            'state' => Submitted::class,
        ]);
    }

    private function handleUploads(AccountApplication $application): void
    {
        // Handle photo upload (single)
        if ($this->photo) {
            $application->addMediaFromRequest('photo')
                ->usingName('Photo')
                ->toMediaCollection('photo', 'private');
        }

        // Handle documents upload (multiple)
        if ($this->documents) {
            $application->addMultipleMediaFromRequest(['documents'])
                ->each(function ($fileAdder) {
                    $fileAdder->toMediaCollection('documents', 'private');
                });
        }
    }
}
