<x-guest-layout>
    <x-authentication-card>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <x-input type="hidden" name="role" value="{{ \App\Models\User::SCHOOL }}" id="" />
            <div>
                <x-input label="Name" id="name" type="text" autofocus autocomplete="name" placeholder="your name"
                    name="name" corner-hint="Ex: John" :value="old('name')" required />
                {{-- <x-label for="name" value="{{ __('Name') }}" />
                <x-input class="block mt-1 w-full"
                    /> --}}
            </div>

            <div class="mt-4">
                <x-input label="{{ __('Email') }}" id="email" type="email" corner-hint="Ex: JhonDoe@mail.com"
                    required name="email" :value="old('email')" />
                {{-- <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" /> --}}
            </div>

            <div class="mt-4">
                <x-input id="password" type="password" label="{{ __('Password') }}" name="password" required
                    autocomplete="new-password" />
                {{-- <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" /> --}}
            </div>

            <div class="mt-4">
                <x-input type="password" id="password_confirmation" label="{{ __('Confirm Password') }}"
                    name="password_confirmation" required autocomplete="new-password" />
                {{-- <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" /> --}}
            </div>

            <div class="mt-4">
                <label for="msisdn" class="flex font-medium text-sm text-gray-700 dark:text-gray-300 gap-2">
                    {{ __('MSISDN') }}<sub class="text-xs font-bold text-yellow-400">{{ __('[Bkash number]') }}</sub>
                </label>
                <x-input id="msisdn" class="block mt-1 w-full" type="text" name="msisdn" autocomplete="msisdn" />
            </div>

            <div class="mt-4">
                <label for="trx_id" class="flex font-medium text-sm text-gray-700 dark:text-gray-300 gap-2">
                    {{ __('Transection ID') }}<sub
                        class="text-xs font-bold text-yellow-400">{{ __('[Bkash transection ID]') }}</sub>
                </label>
                <x-input id="trx_id" class="block mt-1 w-full" type="text" name="trx_id" autocomplete="trx_id" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4 gap-x-3">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                {{-- <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button> --}}

                <x-button type="submit" pink label="{{ __('Register') }}" />
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
