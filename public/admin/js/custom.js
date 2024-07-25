$(document).ready(function(){
    $("#current_pwd").keyup(function(){
        var current_pwd = $("#current_pwd").val();
        // alert(current_pwd);
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'post',
            url:'/admin/check-current-password',
            data:{current_pwd:current_pwd},
            success:function(resp){
                if(resp=="false"){
                    $("#verifyCurrentPwd").html("Current Password is Incorrect !");
                }else if(resp=="true"){
                    $("#verifyCurrentPwd").html("Current Password is Correct !");
                }
            },error:function(){
                alert("Error");
            }
        })
    });
    //update status cms page
    $(document).on("click",".updateCmsPageStatus", function(){
        var status = $(this).children("i").attr("status");
        var page_id = $(this).attr("page_id");
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'post',
            url:'/admin/update-cms-page-status',
            data:{status:status,page_id:page_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#page-"+page_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>" )
                }else if(resp['status']==1){
                    $("#page-"+page_id).html("<i class='fas fa-toggle-on' style='color:#007bff' status='Active'></i>" )
                }
            },error:function(){
                alert("Error");
            }
        })
    });
    //update status admin
    $(document).on("click",".updateSubAdminStatus", function(){
        var status = $(this).children("i").attr("status");
        var subadmin_id = $(this).attr("subadmin_id");
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'post',
            url:'/admin/update-subadmin-status',
            data:{status:status,subadmin_id:subadmin_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#subadmin-"+subadmin_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>" )
                }else if(resp['status']==1){
                    $("#subadmin-"+subadmin_id).html("<i class='fas fa-toggle-on' style='color:#007bff' status='Active'></i>" )
                }
            },error:function(){
                alert("Error");
            }
        })
    });

    //update status category
    $(document).on("click",".updateCategoryStatus", function(){
        var status = $(this).children("i").attr("status");
        var category_id = $(this).attr("category_id");
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'post',
            url:'/admin/update-category-status',
            data:{status:status,category_id:category_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#category-"+category_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>" )
                }else if(resp['status']==1){
                    $("#category-"+category_id).html("<i class='fas fa-toggle-on' style='color:#007bff' status='Active'></i>" )
                }
            },error:function(){
                alert("Error");
            }
        })
    });

    //update status product
    $(document).on("click",".updateProductStatus", function(){
        var status = $(this).children("i").attr("status");
        var product_id = $(this).attr("product_id");
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'post',
            url:'/admin/update-product-status',
            data:{status:status,product_id:product_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#product-"+product_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>" )
                }else if(resp['status']==1){
                    $("#product-"+product_id).html("<i class='fas fa-toggle-on' style='color:#007bff' status='Active'></i>" )
                }
            },error:function(){
                alert("Error");
            }
        })
    });

    //update status banner
    $(document).on("click",".updateBannerStatus", function(){
        var status = $(this).children("i").attr("status");
        var banner_id = $(this).attr("banner_id");
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:'post',
            url:'/admin/update-banner-status',
            data:{status:status,banner_id:banner_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#banner-"+banner_id).html("<i class='fas fa-toggle-off' style='color:grey' status='Inactive'></i>" )
                }else if(resp['status']==1){
                    $("#banner-"+banner_id).html("<i class='fas fa-toggle-on' style='color:#007bff' status='Active'></i>" )
                }
            },error:function(){
                alert("Error");
            }
        })
    });

    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $(function () {
        // Summernote
        $('#summernote').summernote()
    
        // CodeMirror
        CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
          mode: "htmlmixed",
          theme: "monokai"
        });
      })
    
});
