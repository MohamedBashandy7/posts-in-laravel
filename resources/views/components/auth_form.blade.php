<div class="card w-50 mx-auto mt-4">
    <div class="card-body">
        <form action="{{ $route }}" method="POST">
            @csrf
            <x-message/>
            @foreach ($formFields as $field)
            @if ($field['name'] === 'body')
                <div class="mb-3">
                    <label for="{{ $field['id'] }}" class="form-label">{{ $field['label'] }}</label>
                    <textarea class="form-control" id="{{ $field['id'] }}" name="{{ $field['name'] }}" rows="3">{{ old($field['name']) }}</textarea>
                </div>
            @else
                <div class="mb-3">
                    <label for="{{ $field['id'] }}" class="form-label">{{ $field['label'] }}</label>
                    <input type="{{ $field['type'] }}" class="form-control" id="{{ $field['id'] }}" name="{{ $field['name'] }}" 
                           value="{{ old($field['name']) }}" aria-describedby="{{ $field['help'] }}">
                    <div id="{{ $field['help'] }}" class="form-text">{{ $field['helpText'] }}</div>
                </div>
                @error($field['name'])
                <div class="text-danger">{{ $message }}</div>
                @enderror
            @endif
            @endforeach

            @if ($button === 'Login') 
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                    <label class="form-check-label" for="rememberMe">Remember Me</label>
                </div>
            @endif

            @error('error')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            <div class="text-center">
                <button type="submit" class="btn btn-primary">{{ $button }}</button>
            </div>
        </form>
    </div>
</div>