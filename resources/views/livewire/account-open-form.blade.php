<div class="max-w-2xl w-full mx-auto py-10">
    <form wire:submit.prevent="submit" class="space-y-6 bg-white p-8 rounded shadow">
        <h2 class="text-2xl font-bold mb-4">Open a New Bank Account</h2>
        @if (session()->has('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block font-medium mb-1">First Name</label>
                <flux:input type="text" wire:model.defer="first_name" class="w-full" />
                @error('first_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Last Name</label>
                <flux:input type="text" wire:model.defer="last_name" class="w-full" />
                @error('last_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Birth Date</label>
                <flux:input type="date" wire:model.defer="birth_date" class="w-full" />
                @error('birth_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Phone</label>
                <flux:input type="text" wire:model.defer="phone" class="w-full" />
                @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Email</label>
                <flux:input type="email" wire:model.defer="email" class="w-full" />
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Street</label>
                <flux:input type="text" wire:model.defer="street" class="w-full" />
                @error('street') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">City</label>
                <flux:input type="text" wire:model.defer="city" class="w-full" />
                @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">ZIP</label>
                <flux:input type="text" wire:model.defer="zip" class="w-full" />
                @error('zip') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Region/State</label>
                <flux:input type="text" wire:model.defer="region_state" class="w-full" />
                @error('region_state') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Country</label>
                <flux:input type="text" wire:model.defer="country" class="w-full" value="Bangladesh" readonly />
                @error('country') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Account Type</label>
                <flux:select wire:model.defer="account_type" class="w-full" placeholder="Select Account Type">
                    <option value="">Select Account Type</option>
                    <option value="Preferred Banking">Preferred Banking</option>
                    <option value="Standard">Standard</option>
                    <option value="Business">Business</option>
                </flux:select>
                @error('account_type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Category</label>
                <flux:select wire:model.defer="category" class="w-full" placeholder="Select Category">
                    <option value="">Select Category</option>
                    <option value="Individual">Individual</option>
                    <option value="Joint">Joint</option>
                    <option value="Corporate">Corporate</option>
                </flux:select>
                @error('category') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">National ID</label>
                <flux:input type="text" wire:model.defer="national_id" class="w-full" />
                @error('national_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block font-medium mb-1">Passport Number</label>
                <flux:input type="text" wire:model.defer="passport_number" class="w-full" />
                @error('passport_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>
        <div>
            <label class="block font-medium mb-1">Photo (passport size, png or jpg)</label>
            <flux:input type="file" wire:model="photo" accept="image/*" class="w-full" />
            @error('photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div class="flex flex-row gap-2">
            <div>
                <label class="block font-medium mb-1">Documents (Multiple Images and PDFs)</label>
                <flux:input type="file" wire:model="documents" multiple accept="image/*,application/pdf" class="w-full" />
                @error('documents.*') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="mt-2 text-sm bg-amber-100 w-1/2 p-2 ml-2 rounded">                
                Required Documents:
                <ul class="list-disc list-inside">
                    <li>Passport or National ID</li>
                    <li>Utility Bill</li>
                    <li>Proof of Address</li>
                </ul>
            </div>
        </div>

        <hr class="my-4">

        <div class="flex gap-4 justify-between">
            <div>
                <label class="font-medium mb-1">{{ getCaptchaQuestion() }}</label>
                <flux:input type="text" name="_answer" wire:model="_answer" class="w-24! inline-block" />
                @error('_answer') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
            </div>
            <div class="flex-1">&nbsp;</div>
            <div class="flex-1">
                <flux:button type="submit" color="accent" class="w-full bg-blue-600! text-white!">Submit Application</flux:button>
            </div>
        </div>
    </form>

</div>