<x-guest-layout title="Login">
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-30 md:h-auto md:w-1/2">                    
                    <img aria-hidden="true" class="object-cover w-full h-full dark:hidden" src="{{ asset('images/99.jpg') }}" alt="Office" />
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <h1 class="mb-4 text-3xl font-semibold text-gray-900 dark:text-gray-200">
                            Login
                        </h1>
                        @if ($errors->any())
                        <div class="mb-4">
                            <div class="font-medium text-red-600">Whoops! Something went wrong.</div>
                            <ul class="mt-3 text-sm text-red-600 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if (session('status'))
                        <div class="mb-4 text-sm font-medium text-green-600">
                            {{ session('status') }}
                        </div>
                        @endif
                        @if (Route::has('login'))
                        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('/dashboard') }}" ></a>
                        @else
                            <a href="{{ route('login') }}" ></a>

                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" ></a>
                            @endif
                        @endauth
                        </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Email</span>
                                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" 
                                placeholder="example@gmail.com" type="email" name="email"  value="{{ old('email') }}" />
                            </label>
                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Password</span>
                                <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="*************" type="password" name="password" required autocomplete="current-password" />
                            </label>
                            <label class="block mt-4 text-sm">
                                <input type="checkbox" class="form-checkbox" name="remember"> <span class="ml-1 text-gray-700 dark:text-gray-400">{{ __('Remember me') }}</span>
                            </label>
                            <!-- You should use a button here, as the anchor is only used for the example  -->
                            <button  class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" type="submit">
                                {{ __('Login') }}
                            </button>
                        </form>
                        <p class="mt-4">
                            <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                            <a href="{{ route('register') }}" class=" text-sm font-medium text-red-600 pl-10 hover:underline underline">Register</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
