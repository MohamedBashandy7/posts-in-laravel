<x-layout title="{{ env('APP_NAME') }}">
    <x-header/>
    <div class="container">
        {{-- <h1>Current Route: {{ request()->route()->getName() }}</h1> <!-- طباعة اسم الـ route الحالي --> --}}
        @if (request()->routeIs('posts.index'))
            <h1>All Posts</h1>
        @else
            <h1>{{ $name ?? ''}} Posts {{ $posts->total() }}</h1>
        @endif
        <x-posts :posts="$posts"/> 
        @if (!$posts->isEmpty())
            <x-paginate :paginate="$posts"/>
        @endif
    </div>
</x-layout>