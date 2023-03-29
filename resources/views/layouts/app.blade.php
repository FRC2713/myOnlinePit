<!DOCTYPE html>
<html>
<head>
    @livewireStyles
    @vite('resources/css/app.css')
    <title>myOnlinePit</title>
</head>

<body>
<h1 class="text-4xl p-6">myOnlinePit</h1>
@yield('content')
@livewireScripts
</body>
</html>
