<div class="card w-50 mx-auto mt-4">
    <div class="card-body">
        <form action="{{ $route }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-message />
            @if ($button === 'Update')
                @method('PUT')
            @endif
            @foreach ($formFields as $field)
                @if ($field['name'] === 'body')
                    <div class="mb-3">
                        <label for="{{ $field['id'] }}" class="form-label">{{ $field['label'] }}</label>
                        <textarea class="form-control" id="{{ $field['id'] }}" name="{{ $field['name'] }}" rows="3">{{ $field['value'] ?? old($field['name']) }}</textarea>
                    </div>
                @else
                    <div class="mb-3">
                        <label for="{{ $field['id'] }}" class="form-label">{{ $field['label'] }}</label>
                        <input type="{{ $field['type'] }}" class="form-control" id="{{ $field['id'] }}"
                            name="{{ $field['name'] }}" value="{{ $field['value'] ?? old($field['name']) }}"
                            aria-describedby="{{ $field['help'] }}">
                        <div id="{{ $field['help'] }}" class="form-text">{{ $field['helpText'] }}</div>
                    </div>

                    @error($field['name'])
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                @endif
            @endforeach
            @if ($button === 'Update' || $button === 'Create')
                <div class="mb-3">
                    <label for="imageUpload" class="form-label">رفع صورة</label>
                    <input class="form-control" type="file" id="imageUpload" name="image" accept="image/*">
                </div>
            @endif
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
