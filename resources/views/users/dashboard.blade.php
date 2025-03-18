<x-layout title="Dashboard | {{ env('APP_NAME') }}">
    <x-header/>
    @if(request()->routeIs('dashboard'))
        <x-auth_form :form-fields="$formFields" :route="$route" :button="$submit_button"/>
    @endif
    <div class="container">
        <x-posts :posts="$posts"/>
        <x-paginate :paginate="$posts"/>
    </div>
</x-layout>