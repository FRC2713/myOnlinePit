<!DOCTYPE html>
<html>
<head>
    @livewireStyles
    @vite('resources/css/app.css')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>myOnlinePit</title>
</head>

<body>
<nav class="bg-white border-gray-200">
    <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4 md:px-6 py-2.5">
        <a href="/" class="flex items-center">
            <span class="self-center text-xl font-semibold whitespace-nowrap">
                <img src="{{ url("/img/logo.svg") }}"/>
            </span>
        </a>
    </div>
</nav>
<nav class="bg-gray-50">
    <div class="max-w-screen-xl px-4 py-3 mx-auto md:px-6">
        <div class="flex items-center">
            <ul class="flex flex-row mt-0 mr-6 space-x-8 text-sm font-medium">
                <li>
                    <a href="{{ route('nextmatch') }}" class="text-gray-900 hover:underline" aria-current="page">Pit
                        List</a>
                </li>
                <li>
                    <a href="{{ route('settings') }}" class="text-gray-900 hover:underline">Settings</a>
                </li>
                <li>
                    <a href="{{ route('pastlists') }}" class="text-gray-900 hover:underline">Past Lists</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl px-4 md:px-6 py-2.5 mt-4">
    <div class="p-6 w-full shadow-md rounded-md">
        @yield('content')
    </div>
</div>
@livewireScripts
</body>
</html>
