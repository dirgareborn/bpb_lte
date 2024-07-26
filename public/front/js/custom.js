$(document).ready(function(){
    $("#sort").on('change', function(){
        this.form.submit();
    });

    // Add To Cart
    $("#addToCart").submit(function(){
        var formData = $(this).serialize();
        // alert(formData);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'/add-to-cart',
            type:'post',
            data:formData,
            success:function(resp){
                // alert(resp);
                if(resp['status'==true]){
                    $('.print-error-msg').show();
                    $('.print-error-msg').delay(3000).fadeOut('slow');
                    $('.print-error-msg').html("<div class='alert alert-success error-message' role='alert'>"+resp['message']+"<button type='button' class='btn-xs btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");
                }else{
                    $('.print-error-msg').show();
                    $('.print-error-msg').delay(3000).fadeOut('slow');
                    $('.print-error-msg').html("<div class='alert alert-warning error-message' role='alert'>"+resp['message']+"<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");
                }
            },error:function(){
                alert("Error");
            }
        })
    });

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
                window.location.href = "/cart/delete-" + record + "/" + recordid;
            }
        });
    });
});
//
// Empty Cart
$(document).on('click','.deleteCartItem',function(){
    var cartid = $(this).data('cartid');
    var result = confirm("Apakah anda ingin menghapus dari Keranjang?");
    if(result){
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'post',
            data:{cartid:cartid},
            url:'/delete-cart-item',
            success:function(resp){
                $("#totalCartItems").html(resp.totalCartItems);
                $("#appendCartItems").html(resp.view);
                $("#appendMiniCartItems").html(resp.minicartview);
                
            },error:function(){
                alert("Error");
            }
        });
    }
})