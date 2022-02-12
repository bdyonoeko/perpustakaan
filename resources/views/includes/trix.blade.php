@push('styles')
<link rel="stylesheet" href="{{ asset('trix/trix.css') }}">
<style>
    trix-toolbar [data-trix-button-group='file-tools'] {
        display: none;
    }

</style>
@endpush

@push('scripts')
<script src="{{ asset('trix/trix.js') }}"></script>

<script>
    document.addEventListener('trix-file-accept', function (e) {
        e.preventDefault();
    })

</script>
@endpush
