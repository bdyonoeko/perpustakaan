@push('styles')
<link href="{{ asset('templates/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('templates/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('templates/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('templates/js/demo/datatables-demo.js') }}"></script>
@endpush
