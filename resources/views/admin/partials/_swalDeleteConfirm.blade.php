<script type="text/javascript">
    $(document).on("click", ".confirmDelete", function() {
        var record = $(this).attr('record');
        var recordid = $(this).attr('recordid');
        Swal.fire({
            title: "Apakah anda yakin?",
            text: "Anda tidak dapat mengembalikan data yang sudah dihapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, Hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Terhapus",
                    text: "Data sudah dihapus",
                    icon: "success"
                });
                window.location.href = "/admin/delete-" + record + "/" + recordid;
            }
        });
    });
</script>