<section class="w-full">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Show') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Account Application') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="py-6">
        <div class="max-w-full mx-auto space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <p class="mt-2 text-xl text-gray-700">Details of {{ __('Account Application') }} #{{ $accountApplication->tracking_id }}</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <flux:button variant="primary"  :href="route('account-applications.index')">{{ __('Back') }}</flux:butt>
                        </div>
                    </div>

                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="inline-block min-w-full py-2 align-middle">
                                <div class="mt-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                        <!-- Personal Information -->
                                        <section class="bg-white rounded-lg shadow p-6 mb-4">
                                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Personal Information</h3>
                                            <dl class="divide-y divide-gray-100">
                                                <div class="py-2">
                                                    <dt class="text-sm font-medium leading-6 text-gray-900">First Name</dt>
                                                    <dd class="mt-1 text-sm leading-6 text-gray-700">{{ $accountApplication->first_name }}</dd>
                                                </div>
                                                <div class="py-2">
                                                    <dt class="text-sm font-medium leading-6 text-gray-900">Last Name</dt>
                                                    <dd class="mt-1 text-sm leading-6 text-gray-700">{{ $accountApplication->last_name }}</dd>
                                                </div>
                                                <div class="py-2">
                                                    <dt class="text-sm font-medium leading-6 text-gray-900">Birth Date</dt>
                                                    <dd class="mt-1 text-sm leading-6 text-gray-700">{{ $accountApplication->birth_date }}</dd>
                                                </div>
                                                <div class="py-2">
                                                    <dt class="text-sm font-medium leading-6 text-gray-900">National Id</dt>
                                                    <dd class="mt-1 text-sm leading-6 text-gray-700">{{ $accountApplication->national_id }}</dd>
                                                </div>
                                                <div class="py-2">
                                                    <dt class="text-sm font-medium leading-6 text-gray-900">Passport Number</dt>
                                                    <dd class="mt-1 text-sm leading-6 text-gray-700">{{ $accountApplication->passport_number }}</dd>
                                                </div>
                                            </dl>
                                        </section>

                                        <!-- Contact Information -->
                                        <section class="bg-white rounded-lg shadow p-6 mb-4">
                                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Contact Information</h3>
                                            <dl class="divide-y divide-gray-100">
                                                <div class="py-2">
                                                    <dt class="text-sm font-medium leading-6 text-gray-900">Phone</dt>
                                                    <dd class="mt-1 text-sm leading-6 text-gray-700">{{ $accountApplication->phone }}</dd>
                                                </div>
                                                <div class="py-2">
                                                    <dt class="text-sm font-medium leading-6 text-gray-900">Email</dt>
                                                    <dd class="mt-1 text-sm leading-6 text-gray-700">{{ $accountApplication->email }}</dd>
                                                </div>
                                            </dl>
                                        </section>

                                        <!-- Address -->
                                        <section class="bg-white rounded-lg shadow p-6 mb-4">
                                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Address</h3>
                                            <dl class="divide-y divide-gray-100">
                                                <div class="py-2">
                                                    <dt class="text-sm font-medium leading-6 text-gray-900">Street</dt>
                                                    <dd class="mt-1 text-sm leading-6 text-gray-700">{{ $accountApplication->street }}</dd>
                                                </div>
                                                <div class="py-2">
                                                    <dt class="text-sm font-medium leading-6 text-gray-900">City</dt>
                                                    <dd class="mt-1 text-sm leading-6 text-gray-700">{{ $accountApplication->city }}</dd>
                                                </div>
                                                <div class="py-2">
                                                    <dt class="text-sm font-medium leading-6 text-gray-900">Zip</dt>
                                                    <dd class="mt-1 text-sm leading-6 text-gray-700">{{ $accountApplication->zip }}</dd>
                                                </div>
                                                <div class="py-2">
                                                    <dt class="text-sm font-medium leading-6 text-gray-900">Region State</dt>
                                                    <dd class="mt-1 text-sm leading-6 text-gray-700">{{ $accountApplication->region_state }}</dd>
                                                </div>
                                                <div class="py-2">
                                                    <dt class="text-sm font-medium leading-6 text-gray-900">Country</dt>
                                                    <dd class="mt-1 text-sm leading-6 text-gray-700">{{ $accountApplication->country }}</dd>
                                                </div>
                                            </dl>
                                        </section>

                                        <!-- Application Details -->
                                        <section class="bg-white rounded-lg shadow p-6 mb-4">
                                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Application Details</h3>
                                            <dl class="divide-y divide-gray-100">
                                                <div class="py-2">
                                                    <dt class="text-sm font-medium leading-6 text-gray-900">Account Type</dt>
                                                    <dd class="mt-1 text-sm leading-6 text-gray-700">{{ $accountApplication->account_type }}</dd>
                                                </div>
                                                <div class="py-2">
                                                    <dt class="text-sm font-medium leading-6 text-gray-900">Category</dt>
                                                    <dd class="mt-1 text-sm leading-6 text-gray-700">{{ $accountApplication->category }}</dd>
                                                </div>
                                                <div class="py-2">
                                                    <dt class="text-sm font-medium leading-6 text-gray-900">State</dt>
                                                    <dd class="mt-1 text-sm leading-6 text-gray-700">{{ $accountApplication->state }}</dd>
                                                </div>
                                                <div class="py-2">
                                                    <dt class="text-sm font-medium leading-6 text-gray-900">Tracking ID</dt>
                                                    <dd class="mt-1 text-sm leading-6 text-gray-700">{{ $accountApplication->tracking_id }}</dd>
                                                </div>
                                            </dl>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Documents Section -->
                    <div class="mt-8">
                        <section class="bg-white rounded-lg shadow p-6 mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Documents</h3>
                            <div class="flex flex-wrap gap-6 items-start">
                                <!-- Photo Thumbnail -->
                                @php $photoMedia = $accountApplication->getFirstMedia('photo'); @endphp
                                @if ($photoMedia)
                                    <a href="{{ route('media.account-application.show', [$accountApplication, $photoMedia->id]) }}" target="_blank" class="block">
                                        <img src="{{ route('media.account-application.show', [$accountApplication, $photoMedia->id, 'thumb']) }}" alt="Photo" class="object-cover rounded shadow border" />
                                        <div class="text-xs text-center mt-1">Customer Photo</div>
                                    </a>
                                @endif

                                <!-- Document Thumbnails -->
                                @foreach ($accountApplication->getMedia('documents') as $media)
                                    @if (Str::startsWith($media->mime_type, 'image/'))
                                        <a href="{{ route('media.account-application.show', [$accountApplication, $media->id]) }}" target="_blank" class="block">
                                            <img src="{{ route('media.account-application.show', [$accountApplication, $media->id, 'thumb']) }}" alt="Document" class="object-cover rounded shadow border" />
                                            <div class="text-xs text-center mt-1">{{ $media->name }}</div>
                                        </a>
                                    @elseif ($media->mime_type === 'application/pdf')
                                        <a href="{{ route('media.account-application.show', [$accountApplication, $media->id]) }}" target="_blank" class="block text-center w-48 h-48">
                                            <div class="w-48 h-48 flex items-center justify-center bg-gray-100 rounded shadow border">
                                                {{-- <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg> --}}
                                                <flux:icon.document-text class="size-24 text-red-500" />
                                            </div>
                                            <div class="text-xs mt-1 truncate w-24">{{ $media->name }}</div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </section>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>