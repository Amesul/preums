<!DOCTYPE html>
<html
        lang="{{ str_replace("_", "-", app()->getLocale()) }}"
        class="dark h-full w-full bg-transparent"
>
<head>
    @include("partials.head")
</head>
<body class="flex min-h-screen justify-center bg-transparent align-middle">
<livewire:donations-widget />
</body>
</html>
