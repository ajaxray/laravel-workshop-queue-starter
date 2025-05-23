<?php

namespace App\Livewire\Forms;

use App\Models\AccountApplication;
use Livewire\Form;

class AccountApplicationForm extends Form
{
    protected ?AccountApplication $accountApplicationModel;
    
    public $tracking_id = '';
    public $first_name = '';
    public $last_name = '';
    public $birth_date = '';
    public $phone = '';
    public $email = '';
    public $street = '';
    public $city = '';
    public $zip = '';
    public $region_state = '';
    public $country = '';
    public $account_type = '';
    public $category = '';
    public $national_id = '';
    public $passport_number = '';
    public $state = '';

    public function rules(): array
    {
        return [
			'tracking_id' => 'required|string',
			'first_name' => 'required|string',
			'last_name' => 'required|string',
			'birth_date' => 'required',
			'phone' => 'required|string',
			'email' => 'required|string',
			'street' => 'required|string',
			'city' => 'required|string',
			'zip' => 'required|string',
			'region_state' => 'required|string',
			'country' => 'required|string',
			'account_type' => 'required|string',
			'category' => 'required|string',
			'national_id' => 'string',
			'passport_number' => 'string',
			'state' => 'required|string',
        ];
    }

    public function setAccountApplicationModel(AccountApplication $accountApplicationModel): void
    {
        $this->accountApplicationModel = $accountApplicationModel;
        
        $this->tracking_id = $this->accountApplicationModel->tracking_id;
        $this->first_name = $this->accountApplicationModel->first_name;
        $this->last_name = $this->accountApplicationModel->last_name;
        $this->birth_date = $this->accountApplicationModel->birth_date;
        $this->phone = $this->accountApplicationModel->phone;
        $this->email = $this->accountApplicationModel->email;
        $this->street = $this->accountApplicationModel->street;
        $this->city = $this->accountApplicationModel->city;
        $this->zip = $this->accountApplicationModel->zip;
        $this->region_state = $this->accountApplicationModel->region_state;
        $this->country = $this->accountApplicationModel->country;
        $this->account_type = $this->accountApplicationModel->account_type;
        $this->category = $this->accountApplicationModel->category;
        $this->national_id = $this->accountApplicationModel->national_id;
        $this->passport_number = $this->accountApplicationModel->passport_number;
        // $this->state = $this->accountApplicationModel->state;
    }

    public function getAccountApplicationModel(): AccountApplication
    {
        return $this->accountApplicationModel;
    }

    public function store(): void
    {
        $this->accountApplicationModel->create($this->validate());

        $this->reset();
    }

    public function update(): void
    {
        $this->accountApplicationModel->update($this->validate());

        $this->reset();
    }
}
