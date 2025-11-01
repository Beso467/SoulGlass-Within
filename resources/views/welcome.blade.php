<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Coming Soon</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-950 text-gray-100 font-sans antialiased flex flex-col justify-center items-center min-h-screen px-4">

```
<div class="text-center max-w-xl">
    <h1 class="text-5xl font-bold tracking-widest mb-6">Coming Soon</h1>

    <p class="text-gray-400 text-lg mb-8">
        “Sometimes the little details hide the most knowledge.”
    </p>

    <div class="border-2 border-dotted border-gray-500 rounded-xl p-6 hover:shadow-lg transition-shadow duration-500">
        <p class="text-gray-300">
            Stay tuned — we’re polishing the mirror of your soul.
        </p>
    </div>

    @if (Route::has('login'))
        <div class="mt-12">
            @auth
                <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-colors duration-300">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-300">
                    Login
                </a>
            @endauth
        </div>
    @endif
</div>
```

</body>
</html>
