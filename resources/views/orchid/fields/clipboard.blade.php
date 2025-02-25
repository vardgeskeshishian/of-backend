@component($typeForm, get_defined_vars())
    <div class="input-group">
        <input type="text" id="{{ $name }}" value="{{ $value }}" class="form-control" placeholder="{{ __('general.token') }}">
        <div class="btn btn-outline-secondary" onclick="copyToClipboard('{{ $name }}')">{{ __('general.copy') }}</div>
    </div>

    <script>
        async function copyToClipboard(elementId) {
            try {
                const copyText = document.getElementById(elementId);
                await navigator.clipboard.writeText(copyText.value);
                alert('{{ __('general.token_is_copied') }}')
            } catch (err) {
                console.error("Failed to copy text: ", err);
            }
        }
    </script>
@endcomponent
