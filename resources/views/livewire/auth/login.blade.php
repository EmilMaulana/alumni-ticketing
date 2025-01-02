<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div
        class="gap-y-16 grid grid-cols-1 lg:grid-cols-2 max-w-7xl mx-auto gap-x-10 xl:gap-x-28 px-6 pt-10 sm:px-10 sm:py-20 xl:py-20 items-center">
        <div class="bg-white px-6 py-6 sm:p-10 rounded-2xl">
            <form wire:submit.prevent="login">
                <div class="flex flex-col gap-y-7">
                    <h3 class="xl:text-4xl md:text-3xl text-2xl text-indigo-950 font-bold leading-relaxed">
                        Sign In
                    </h3>
                    <div>
                        <p class="font-semibold text-indigo-950 text-base mb-2">
                            Email Address
                        </p>
                        <input wire:model="form.email" id="email"
                            class="w-full py-3 rounded-full pl-5 pr-10 border border-gray-300 text-indigo-950 font-semibold">
                        <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                    </div>
                    <div class="justify-end flex flex-col">
                        <p class="font-semibold text-indigo-950 text-base mb-2">
                            Password
                        </p>
                        <input wire:model="form.password" id="password"
                            class="w-full py-3 rounded-full pl-5 pr-10 border border-gray-300 text-indigo-950 font-semibold"
                            type="password" name="password" required autocomplete="current-password">
                        <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                    </div>
                    <!-- Remember Me -->
                    <div class="block">
                        <label for="remember" class="inline-flex items-center">
                            <input wire:model="form.remember" id="remember" type="checkbox"
                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <div class="flex flex-col gap-y-4">
                        <button type="submit"
                            class="w-full text-center px-7 rounded-full text-base py-3 font-semibold text-white bg-violet-700">
                            Sign In
                        </button>
                    </div>
                </div>
            </form>            
        </div>
        <img src="{{ asset('images/login-amico.svg') }}" alt="" class="w-full h-auto object-cover">
    </div>
</div>
