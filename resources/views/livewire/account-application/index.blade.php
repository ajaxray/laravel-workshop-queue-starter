<section class="w-full">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Account Applications') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">A list of all the {{ __('Account Applications') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="py-6">
        <div class="max-w-full mx-auto space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div>
                            <flux:select wire:model.live="stateFilter" placeholder="Filter by State">
                                @foreach ($stateOptions as $value => $label)
                                    <flux:select.option value="{{ $value }}">{{ $label }}</flux:select.option>
                                @endforeach
                            </flux:select>
                        </div>
                        <div class="flex-1"></div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <flux:button variant="primary"  :href="route('account-applications.create')">{{ __('Add New') }}</flux:butt>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <table class="w-full divide-y divide-gray-300">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">No</th>
                                        
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Tracking Id</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Name</th>
									{{-- <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">DOB</th> --}}
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Phone</th>
									{{-- <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Email</th> --}}
									{{-- <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Street</th> --}}
									{{-- <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">City</th> --}}
									{{-- <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Zip</th> --}}
									{{-- <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Region State</th> --}}
									{{-- <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Country</th> --}}
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Account Type</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Category</th>
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">National Id</th>
									{{-- <th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Passport Number</th> --}}
									<th scope="col" class="py-3 pl-4 pr-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">State</th>

                                        <th scope="col" class="px-3 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500"></th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach ($accountApplications as $accountApplication)
                                        <tr class="even:bg-gray-50" wire:key="{{ $accountApplication->id }}">
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-semibold text-gray-900">{{ ++$i }}</td>
                                            
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">#{{ $accountApplication->tracking_id }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $accountApplication->first_name }} {{ $accountApplication->last_name }}</td>
										{{-- <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $accountApplication->birth_date }}</td> --}}
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $accountApplication->phone }}</td>
										{{-- <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $accountApplication->email }}</td> --}}
										{{-- <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $accountApplication->street }}</td> --}}
										{{-- <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $accountApplication->city }}</td> --}}
										{{-- <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $accountApplication->zip }}</td> --}}
										{{-- <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $accountApplication->region_state }}</td> --}}
										{{-- <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $accountApplication->country }}</td> --}}
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $accountApplication->account_type }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $accountApplication->category }}</td>
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $accountApplication->national_id }}</td>
										{{-- <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $accountApplication->passport_number }}</td> --}}
										<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <flux:badge color="{{ $accountApplication->state->color() }}">{{ $accountApplication->state->label() }}</flux:badge>

                                        </td>

                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">
                                                <a wire:navigate href="{{ route('account-applications.show', $accountApplication->id) }}" class="text-gray-600 font-bold hover:text-gray-900 mr-2">{{ __('Show') }}</a>
                                                {{-- <a wire:navigate href="{{ route('account-applications.edit', $accountApplication->id) }}" class="text-indigo-600 font-bold hover:text-indigo-900  mr-2">{{ __('Edit') }}</a> --}}
                                                <button
                                                    class="text-red-600 font-bold hover:text-red-900"
                                                    type="button"
                                                    wire:click="delete({{ $accountApplication->id }})"
                                                    wire:confirm="Are you sure you want to delete?"
                                                >
                                                    {{ __('Delete') }}
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <div class="mt-4 px-4">
                                    {!! $accountApplications->withQueryString()->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>