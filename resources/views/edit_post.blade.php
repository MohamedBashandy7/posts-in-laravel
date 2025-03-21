<x-layout title="Edit Post | {{ env('APP_NAME') }}">
    <x-header />
    <div class="container">
        <x-auth_form :form-fields="$formFields" :route="$route" :button="$submit_button" :post="$post" />
    </div>
</x-layout>
