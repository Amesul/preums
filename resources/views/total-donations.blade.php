<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}" class="dark">
    <head>
        @include("partials.head")
    </head>
    <body class="flex min-h-screen justify-center align-middle">
        <livewire:donations-widget />
    </body>
</html>
