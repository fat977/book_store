$(document).ready(function(){
    $('#categories').DataTable();
    $('#authors').DataTable();
    $('#books').DataTable();
    $('#banners').DataTable();
    $('#orders').DataTable();
    $('#users').DataTable();

    //check current status
    $("#current_password").keyup(function(){
        var current_password = $("#current_password").val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : 'post',
            url : '/admin/check-current-password',
            data : {current_password:current_password},
            success : function(res){
                if(res =="false"){
                    $("#check_password").html("<font color='red'> current password is incorrect! </font>");
                }
                else if(res =="true"){
                    $("#check_password").html("<font color='green'> current password is correct! </font>");
                }
            },
            error : function(){
                alert(error);
            }

        });
    });

    // category status
    $(document).on("click",".updateCategoryStatus",function(){
    var status = $(this).children("i").attr("status");
    var category_id = $(this).attr("category_id");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type : 'post',
        url : '/admin/update-category-status',
        data : {status:status,category_id:category_id},
        success : function(res){
            if(res['status']==0){
                $("#category-"+category_id).html('<i  class="far fa-bookmark" status="inactive"></i>');
            }
            else if(res['status']==1){
                $("#category-"+category_id).html('<i  class="fas fa-bookmark" status="active"></i>');
            }
        },
        error : function(){
            alert(error);
        }

    });
    });

    // author status
    $(document).on("click",".updateAuthorStatus",function(){
    var status = $(this).children("i").attr("status");
    var author_id = $(this).attr("author_id");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type : 'post',
        url : '/admin/update-author-status',
        data : {status:status,author_id:author_id},
        success : function(res){
            if(res['status']==0){
                $("#author-"+author_id).html('<i style="font-size: 20px" class="far fa-bookmark" status="inactive"></i>');
            }
            else if(res['status']==1){
                $("#author-"+author_id).html('<i style="font-size: 20px" class="fas fa-bookmark" status="active"></i>');
            }
        },
        error : function(){
            alert(error);
        }

    });
    });

    // book status
    $(document).on("click",".updateBookStatus",function(){
    var status = $(this).children("i").attr("status");
    var book_id = $(this).attr("book_id");
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type : 'post',
        url : '/admin/update-book-status',
        data : {status:status,book_id:book_id},
        success : function(res){
            if(res['status']==0){
                $("#book-"+book_id).html('<i style="font-size: 20px" class="far fa-bookmark" status="inactive"></i>');
            }
            else if(res['status']==1){
                $("#book-"+book_id).html('<i style="font-size: 20px" class="fas fa-bookmark" status="active"></i>');
            }
        },
        error : function(){
            alert(error);
        }

    });
    });

     // banner status
     $(document).on("click",".updateBannerStatus",function(){
        var status = $(this).children("i").attr("status");
        var banner_id = $(this).attr("banner_id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : 'post',
            url : '/admin/update-banner-status',
            data : {status:status,banner_id:banner_id},
            success : function(res){
                if(res['status']==0){
                    $("#banner-"+banner_id).html('<i style="font-size: 20px" class="far fa-bookmark" status="inactive"></i>');
                }
                else if(res['status']==1){
                    $("#banner-"+banner_id).html('<i style="font-size: 20px" class="fas fa-bookmark" status="active"></i>');
                }
            },
            error : function(){
                alert(error);
            }
    
        });
        });

    //confirm delete sweet alert
    $(document).on("click",".confirmDelete",function(){
        var module = $(this).attr("module");
        var moduleid = $(this).attr("moduleid");
      
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              window.location = "/admin/delete-"+module+"/"+moduleid;
            }

          })
    });
   
});