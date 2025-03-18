<x-layout title="Register | {{ env('APP_NAME') }}">
    <x-header/>
    <h1 class="text-center mt-5">Register</h1>
    <x-auth_form :form-fields="$formFields" :route="$route" :button="$submit_button"/>
</x-layout>