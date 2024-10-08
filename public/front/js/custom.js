$(document).ready(function(){
    $("#current_pwd").keyup(function(){
        var current_pwd = $("#current_pwd").val();
        // alert(current_pwd);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'post',
            url:'/check-current-password',
            data:{current_pwd:current_pwd},
            success:function(resp){
                if(resp=="false"){
                    $("#verifyCurrentPwd").html("Password Yang anda masukkan salah");
                }else if(resp=="true"){
                    $("#verifyCurrentPwd").html("Password Yang anda masukkan Benar !");
                }
            },error:function(){
                $("#verifyCurrentPwd").html("Error !");
            }
        })
    });
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
                    $('.print-success-msg').show();
                    $('.print-success-msg').delay(3000).fadeOut('slow');
                    $('.print-success-msg').html("<div class='alert alert-success success-message' role='alert'>"+resp['message']+"<button type='button' class='btn-xs btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>");
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

//ApplyCoupon
$(document).on('click','#ApplyCoupon',function(){
	var user = $(this).attr("user");
	if(user==1){
		
	}else{
		alert("Silahkan Login untuk menggunakan Kupon");
		return false;
	}
	
	var code = $("#code").val();
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type:'post',
        data:{code:code},
        url:'/apply-coupon',
        success:function(resp){
			if(resp.status==false){
                $('.alert-danger').show();
                $('.alert-danger').delay(3000).fadeOut('slow');
                $('.alert-danger').html("<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>"+ resp['message'] + "</strong><span class='close' aria-hidden='true' onclick='this.parentElement.style.display='none';'>&times;</span></div>");
            }else if(resp.status==true){
                if(resp.couponAmount>0){
                    $(".couponAmount").text(resp.couponAmount);
                }else{
                    $(".couponAmount").text("0");
                }
                if(resp.grand_total>0){
                    $(".grandTotal").text(resp.grand_total);
                }
               
                $('.alert-success').show();
                $('.alert-success').delay(3000).fadeOut('slow');
                $('.alert-success').html("<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>"+ resp['message'] + "</strong><span class='close' aria-hidden='true' onclick='this.parentElement.style.display='none';'>&times;</span></div>");
                
                $("#totalCartItems").html(resp.totalCartItems);
                $("#appendCartItems").html(resp.view);
                $("#appendMiniCartItems").html(resp.minicartview);
                
            }
		},error:function(){
			alert("Error");
		}
	});
});

// Payment Method Show/Hide
$("#ManualCoupon").click(function(){
    $("#couponField").show();
});
$("#AutomaticCoupon").click(function(){
    $("#couponField").hide();
});

