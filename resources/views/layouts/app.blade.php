<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none">
    <div id="app">
        <nav class="py-8 bg-white border-b-2 border-gray-800">
            <div class="container mx-auto px-6 md:px-0">
                <div class="flex items-center justify-between">
                    <div class="mr-6">
                        <a href="{{ url('/') }}" class="text-lg text-gray-700 font-medium no-underline">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>

                    <search inline-template>
                        <div class="relative w-2/6">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg viewBox="0 0 20 20" class="h-6 w-6 fill-current text-gray-500"><path
                                        d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path></svg>
                            </span>
                                <input type="text"
                                       v-model="searchString"
                                       @keyup="search"
                                       name="search"
                                       placeholder="Search here"
                                       class="block w-full placeholder-gray-600 bg-white text-gray-800 rounded-full border border-gray-400
                                       pr-4 pl-10 py-3 text-md font-normal font-light focus:outline-none focus:text-gray-800">
                        </div>
                    </search>

                    <div class="text-right flex justify-end items-center text-xs text-gray-600">
                        @guest
                            <a class="no-underline hover:bg-gray-900 hover:text-gray-200 active:bg-gray-900 active:text-gray-100 bg-gray-800 text-gray-200 font-extrabold border rounded-full border-4 border-gray-700 py-2 px-3 text-sm" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a class="no-underline hover:bg-white hover:text-gray-700 active:bg-gray-400 active:text-white text-gray-600 font-semibold border rounded-full border-4 border-gray-600 py-2 px-3 text-sm ml-4" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <div class="block mr-2">
                                <a href="{!! route('words.create') !!}">
                                    <button class="focus:outline-none rounded-full bg-transparent border border-gray-400 ml-3 hover:bg-gray-100 active:bg-gray-200">
                                        <svg class="h-8 w-8 fill-current text-gray-600"
                                             viewBox="0 0 24 24">
                                            <path class="heroicon-ui" d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/>
                                        </svg>
                                    </button>
                                </a>
                            </div>
                            <dropdown>
                                <template v-slot:trigger>
                                    <img class="h-8 w-8 rounded-full border-2 object-cover cursor-pointer hover:border-gray-500 active:border-gray-700"
                                         src="{!! auth()->user()->avatar ? auth()->user()->avatar : 'images/default.png' !!}"
                                         alt="Avatar">
                                </template>

                                <li class="dropdown-menu-item">
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </dropdown>
                            <h5 class="ml-1">{!! auth()->user()->name !!}</h5>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
