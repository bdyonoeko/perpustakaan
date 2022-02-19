@push('modal')
{{-- deleteModal untuk konfirmasi pinjaman di halaman dashboard --}}
<div class="modal fade" id="deleteModalConfirmation" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Yakin menghapus data ini?
            </div>
            <div class="modal-footer">
                {{-- form delete --}}
                <form action="" method="post" id="deleteFormConfirmation">
                    @csrf
                    @method('delete')

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ya, Hapus</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endpush

{{-- push script deleteJS --}}
@push('scripts')
<script>
    // menangkap nilai id lalu mengeneratenya ke dalam url action form 
    $('.btn-delete').click(function () {
        let idDelete = $(this).attr('data-id');
        $('#deleteFormConfirmation').attr('action', '/adminbooking/' + idDelete);
    })

    // jika ya ditekan, maka submit form
    $('#deleteForm [type="submit"]').click(function () {
        $('#deleteForm').submit();
    })

</script>
@endpush
