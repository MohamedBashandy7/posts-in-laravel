<x-layout title="Login | {{ env('APP_NAME') }}">
    <x-header/>
    <h1 class="text-center mt-5">Login</h1>
    <x-auth_form :button="$submit_button" :form-fields="$formFields" :route="$route" />
</x-layout>