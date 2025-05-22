<div class="space-y-6">
    
    <div>
        <flux:input wire:model="form.tracking_id" :label="__('Tracking Id')" type="text"  autocomplete="form.tracking_id" placeholder="Tracking Id"/>
    </div>
    <div>
        <flux:input wire:model="form.first_name" :label="__('First Name')" type="text"  autocomplete="form.first_name" placeholder="First Name"/>
    </div>
    <div>
        <flux:input wire:model="form.last_name" :label="__('Last Name')" type="text"  autocomplete="form.last_name" placeholder="Last Name"/>
    </div>
    <div>
        <flux:input wire:model="form.birth_date" :label="__('Birth Date')" type="text"  autocomplete="form.birth_date" placeholder="Birth Date"/>
    </div>
    <div>
        <flux:input wire:model="form.phone" :label="__('Phone')" type="text"  autocomplete="form.phone" placeholder="Phone"/>
    </div>
    <div>
        <flux:input wire:model="form.email" :label="__('Email')" type="text"  autocomplete="form.email" placeholder="Email"/>
    </div>
    <div>
        <flux:input wire:model="form.street" :label="__('Street')" type="text"  autocomplete="form.street" placeholder="Street"/>
    </div>
    <div>
        <flux:input wire:model="form.city" :label="__('City')" type="text"  autocomplete="form.city" placeholder="City"/>
    </div>
    <div>
        <flux:input wire:model="form.zip" :label="__('Zip')" type="text"  autocomplete="form.zip" placeholder="Zip"/>
    </div>
    <div>
        <flux:input wire:model="form.region_state" :label="__('Region State')" type="text"  autocomplete="form.region_state" placeholder="Region State"/>
    </div>
    <div>
        <flux:input wire:model="form.country" :label="__('Country')" type="text"  autocomplete="form.country" placeholder="Country"/>
    </div>
    <div>
        <flux:input wire:model="form.account_type" :label="__('Account Type')" type="text"  autocomplete="form.account_type" placeholder="Account Type"/>
    </div>
    <div>
        <flux:input wire:model="form.category" :label="__('Category')" type="text"  autocomplete="form.category" placeholder="Category"/>
    </div>
    <div>
        <flux:input wire:model="form.national_id" :label="__('National Id')" type="text"  autocomplete="form.national_id" placeholder="National Id"/>
    </div>
    <div>
        <flux:input wire:model="form.passport_number" :label="__('Passport Number')" type="text"  autocomplete="form.passport_number" placeholder="Passport Number"/>
    </div>
    <div>
        <flux:input wire:model="form.state" :label="__('State')" type="text"  autocomplete="form.state" placeholder="State"/>
    </div>

    <div class="flex items-center gap-4">
        <flux:button variant="primary" type="submit">{{ __('Submit') }}</flux:button>
    </div>
</div>