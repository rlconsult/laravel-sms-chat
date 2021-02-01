@extends('filament::layouts.base')

@section('title', $title)

@section('content')
    <main class="flex h-screen items-center justify-center p-4">
        <div class="w-full max-w-sm space-y-6">
            <header class="text-center">
                <h2 class="font-light font-thin text-2xl md:text-3xl leading-tight text-red-700">{{ $title ?? config('app.name') }}</h2>
            </header>

            {{ $slot }}

            <footer class="flex items-center justify-center">
                <x-filament::branding-footer />
            </footer>
        </div>
    </main>
@overwrite
