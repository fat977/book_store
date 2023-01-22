//const { parseInt } = require("lodash");
$(document).ready(function(){
	loadCart();
	loadWishlist();
   $('.banner-carousel').owlCarousel({
		loop:true,
		margin:10,
		nav:true,
		autoplay:true,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:3
			},
			1000:{
				items:1
			}
		}
	});

	$('.recommended-carousel').owlCarousel({
		//loop:true,
		margin:10,
		nav:true,
		dots:true,
		autoplay:true,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:3
			},
			1000:{
				items:3
			}
		}
	});

	//increment quantity
	$('.cart_quantity_up').click(function(e){
		e.preventDefault();
		var inc_value = $(this).closest('.book_data').find('.cart_quantity_input').val();
		var quantity_error = "The quantity should be 2 or less.";
		var value = parseInt(inc_value,10);
		value = isNaN(value) ? 0:value;
		if(value<2){
			value++;
			//$('.cart_quantity_input').val(value);
			$(this).closest('.book_data').find('.cart_quantity_input').val(value);
		}else{
			//alert("The quantity should be 2 or less");
			$('#quantity_error').html(quantity_error);
			setTimeout(function(){
				$("#quantity_error").css({'display':'none'});
			},6000);	
		}	
	});

	//no increment >1
	$('.cart_quantity_up_1').click(function(e){
	//$(document).on('click','.cart_quantity_up_1',function(e){
		e.preventDefault();
		var inc_value = $(this).closest('.book_data').find('.cart_quantity_input').val();
		var quantity_error = "Available only 1.";
		var value = parseInt(inc_value,10);
		value = isNaN(value) ? 0:value;
		if(value<1){
			value++;
			//$('.cart_quantity_input').val(value);
			$(this).closest('.book_data').find('.cart_quantity_input').val(value);
		}else{
			//alert("The quantity should be 2 or less");
			$('#quantity_error').html('');
			$('#quantity_error').html(quantity_error);
			setTimeout(function(){
				$("#quantity_error").css({'display':'none'});
			},3000);
		}	
	});

	//decrement quantity
	$('.cart_quantity_down').click(function(e){
	//$(document).on('click','.cart_quantity_down',function(e){
		e.preventDefault();
		var dec_value = $(this).closest('.book_data').find('.cart_quantity_input').val();
		var value = parseInt(dec_value,10);
		value = isNaN(value) ? 0:value;
		if(value > 1){
			value--;
			//$('.cart_quantity_input').val(value);
			$(this).closest('.book_data').find('.cart_quantity_input').val(value);
		}
	});

	// Add To Cart
	$('.addToCart').click(function(e){
		e.preventDefault();
		var book_id = $(this).closest('.book_data').find('.book_id').val();
		var book_qty = $(this).closest('.book_data').find('.cart_quantity_input').val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				'book_id':book_id,
				'book_qty':book_qty
			},
			url:'/add-to-cart',
			method:'POST',
			success:function(resp){
				//Swal(resp.status);
				 if(resp.type=="success"){
					$("#cart-success").attr('style','color:#0f5132; background-color:#d1e7dd; padding:20px; border-color: #badbcc');
					$("#cart-success").html(resp.message);
					setTimeout(function(){
						$("#cart-success").css({'display':'none'});
					},6000);	
					loadCart();		
			    }else if(resp.type=="error"){
					$("#cart-error").attr('style','color:#842029; background-color:#f8d7da; padding:20px; border-color: #f5c2c7');
					$("#cart-error").html(resp.message);
					setTimeout(function(){
						$("#cart-error").css({'display':'none'});
					},6000);	
				}
				
			},error:function(){
				alert("Error");
			}
			
		});
	});

	// Add To downloads
	$('.addToDownloads').click(function(e){
		e.preventDefault();
		var book_id = $(this).closest('.book_data').find('.book_id').val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				'book_id':book_id,
			},
			url:'/add-to-download',
			method:'POST',
			success:function(resp){
				//Swal(resp.status);
				 if(resp.type=="success"){
					$("#cart-success").attr('style','color:#0f5132; background-color:#d1e7dd; padding:20px; border-color: #badbcc');
					$("#cart-success").html(resp.message);
					$('.addToDownloads').css({'display':'none'})
					//setTimeout(function(){
						$("#cart-success").css({'display':'none'});
						var timeleft = 10;
						var downloadTimer = setInterval(function(){
							 if(timeleft <= 0){
								 clearInterval(downloadTimer);
								 //document.getElementById("countdown").innerHTML = "Finished";
								 $('.new_link').css({'display':'block'})
							 } else {
								 document.getElementById("countdown").innerHTML = "Get the link in " +timeleft + "seconds";
								 setTimeout(function() {
									$('#countdown').fadeOut('fast');
								}, 10000);
							 }
							 timeleft -= 1;
						 }, 1000);
					//},3000);	
				}
				
			},error:function(){
				alert("Error");
			}
			
		});
	});

	// Add To book_like
	$('.addToLike').click(function(e){
		e.preventDefault();
		var book_id = $(this).closest('.book_data').find('.book_id').val();
		alert(book_id);
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				'book_id':book_id,
			},
			url:'/add-to-like',
			method:'POST',
			success:function(resp){
				//Swal(resp.status);
				if(resp.type=="success"){
					$("#cart-success").attr('style','color:#0f5132; background-color:#d1e7dd; padding:20px; border-color: #badbcc');
					$("#cart-success").html(resp.message);	
					$("#count").attr('style','color:#0f5132; background-color:#d1e7dd; padding:20px; border-color: #badbcc');
					$('#count').html(resp.likeItem);		
					setTimeout(function(){
						$('#cart-success').css({'display':'none'})
					},3000);	
				}else if(resp.type=="error"){
					$("#cart-error").attr('style','color:#842029; background-color:#f8d7da; padding:20px; border-color: #f5c2c7');
					$("#cart-error").html(resp.message);
					setTimeout(function(){
						$("#cart-error").css({'display':'none'});
					},6000);	
				}else if(resp){
					$("#count").attr('style','color:#0f5132; background-color:#d1e7dd; padding:20px; border-color: #badbcc');
					$('#count').html(resp.likeItem);	
				}
				
			},error:function(){
				alert("Error");
			}
			
		});
	});



	 // book book_like
	$(document).on("click",".updateBookLike",function(){
		var book_like = $(this).children("i").attr("book_like");
		var book_id = $(this).attr("book_id");
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			type : 'post',
			url : '/update-book-like',
			data : {book_like:book_like,book_id:book_id},
			success : function(res){
				if(res['book_like']==0){
					$("#book-"+book_id).html('<i style="font-size: 20px; color: #b4afaf;" class="far fa-heart" book_like="inactive"></i>');
				}
				else if(res['book_like']==1){
					$("#book-"+book_id).html('<i style="font-size: 20px; color: red;" class="fas fa-heart" book_like="active"></i>');
					$('.book_like').html(response.book_like);
				}
				else if(res.type=="error"){
					$("#error").attr('style','color:#842029; background-color:#f8d7da; padding:20px; border-color: #f5c2c7');
					$("#error").html(res.message);	
					setTimeout(function(){
						$("#error").css({'display':'none'});
					},6000);				
				}
			},
			error : function(){
				alert(error);
			}
	
		});
	}); 

	function loadCart(){
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url:'/load-cart-count',
			method:'GET',
			success:function(response){
				$('.cart-count').html('');
				$('.cart-count').html(response.count);
			}
			
		});
	}

	function loadWishlist(){
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url:'/load-wishlist-count',
			method:'GET',
			success:function(response){
				$('.wishlist-count').html('');
				$('.wishlist-count').html(response.count);
			}
			
		});
	}

	//sort
	$('#sort').on('change',function(){
		var sort_by = $('#sort').val();
		//var sort_by = $(this).closest('.mmm').find('#sort').val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				'sort_by':sort_by,
			},
			url:'/sort-by',
			method:'GET',
			success:function(resp){
				//alert(resp.books);
				$('.search_result').html(resp);
				$('.search_result').html(jQuery(resp).find('.content').html());
			},error:function(){
				alert("Error");
			}
			
		});
	});

	//search
	var availableTags = [];
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		url:'/book-list',
		method:'GET',
		success:function(response){
			startAutocomplete(response);
		},error:function(){
			alert("Error");
		}
	
	});

	function startAutocomplete(availableTags){
		$( "#search_book" ).autocomplete({
			source: availableTags
		});
	}  

	// Add To Wishlist
	$('.addToWishlist').click(function(e){
		e.preventDefault();
		var book_id = $(this).closest('.book_data').find('.book_id').val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				'book_id':book_id,
			},
			url:'/add-to-wishlist',
			method:'POST',
			success:function(resp){
				if(resp.type=="success"){
					$("#wishlist-success").attr('style','color:#0f5132; background-color:#d1e7dd; padding:20px; border-color: #badbcc');
					$("#wishlist-success").html(resp.message);	
					
					setTimeout(function(){
						$("#wishlist-success").css({'display':'none'});
					},6000);
					loadWishlist();	
			    }else if(resp.type=="error"){
					$("#wishlist-error").attr('style','color:#842029; background-color:#f8d7da; padding:20px; border-color: #f5c2c7');
					$("#wishlist-error").html(resp.message);
					setTimeout(function(){
						$("#wishlist-error").css({'display':'none'});
					},6000);
				}
				
			},error:function(){
				alert("Error");
			}
			
		});
	});

	//delete from cart
	//$('.cart_quantity_delete').click(function(e){
	$(document).on('click','.cart_quantity_delete',function(e){
		e.preventDefault();
		var book_id = $(this).closest('.book_data').find('.book_id').val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				'book_id':book_id,
			},
			url:'delete-cart-item',
			method:'POST',
			success:function(response){
				loadCart();
				$('.CartItems').load(location.href +" .CartItems");
				//window.location.reload();
				//alert(response.status);
			}
			
		});
	});

	//delete review
	//$('.cart_quantity_delete').click(function(e){
		$(document).on('click','.delete-review',function(e){
			e.preventDefault();
			var book_id = $(this).closest('.book_data').find('.book_id').val();
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data:{
					'book_id':book_id,
				},
				url:'/delete-review',
				method:'POST',
				success:function(response){
					//$('.Reviews').load(location.href +" .Reviews");
					window.location.reload();
					//alert(response.status);
				}
				
			});
		});

	//delete from wishlist
	//$('.remove_item').click(function(e){
	$(document).on('click','.remove_item',function(e){
		e.preventDefault();
		var book_id = $(this).closest('.book_data').find('.book_id').val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				'book_id':book_id,
			},
			url:'delete-wishlist-item',
			method:'POST',
			success:function(response){
				loadWishlist();
				$('.WishlistItems').load(location.href +" .WishlistItems");
				//window.location.reload();
				//alert(response.status); 
			}
			
		});
	});

	//change quantity
	//$('.change_quantity').click(function(e){
	$(document).on('click','.change_quantity',function(){
		//e.preventDefault();
		var book_id = $(this).closest('.book_data').find('.book_id').val();
		var book_qty = $(this).closest('.book_data').find('.cart_quantity_input').val();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				'book_id':book_id,
				'book_qty':book_qty,
			},
			url:'update-cart-item',
			method:'POST',
			success:function(response){
				//alert(response);
				window.location.reload();
				//$(".totalCartItems").html(response.totalCartItems);

			}
		
			
		});
	});

	// register form validation
	$("#registerForm").submit(function(){
		var formdata =$(this).serialize();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:formdata,
			url:'/user/register',
			method:'POST',
			success:function(resp){
				if(resp.type=="error"){
					$.each(resp.errors,function(i,error){
						$("#register-"+i).attr('style','color:red');
						$("#register-"+i).html(error);
					
						setTimeout(function(){
							$("#register-"+i).css({'display':'none'});
						},3000);
				});
				}else if(resp.type=="success"){
					//alert(resp.message);
					$("#register-success").attr('style','color:green');
					$("#register-success").html(resp.message);
				}
				
			},error:function(){
				alert("Error");
			}
		
		});
	});

   // login form validation
	$("#loginForm").submit(function(){
		var formdata =$(this).serialize();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:formdata,
			url:'/user/login',
			type:'POST',
			success:function(resp){
				if(resp.type=="error"){
					$.each(resp.errors,function(i,error){
						$("#login-"+i).attr('style','color:red');
						$("#login-"+i).html(error);
					
						setTimeout(function(){
							$("#login-"+i).css({'display':'none'});
						},3000);
				});
				}else if(resp.type=="incorrect"){
					$("#login-error").attr('style','color:red');
					$("#login-error").html(resp.message);
				}else if(resp.type=="success"){
					window.location.href= resp.url;
				}else if(resp.type=="inactive"){
					$("#login-error").attr('style','color:red');
					$("#login-error").html(resp.message);
				}
				
			},error:function(){
				alert("Error");
			}
		
		 });
	});

    // account form validation
	$("#accountForm").submit(function(){
		//$(".loader").show();
		var formdata =$(this).serialize();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:formdata,
			url:'/user/account',
			type:'POST',
			success:function(resp){
				if(resp.type=="error"){
					$.each(resp.errors,function(i,error){
						$("#account-"+i).attr('style','color:red');
						$("#account-"+i).html(error);
					
						setTimeout(function(){
							$("#account-"+i).css({'display':'none'});
						},3000);
				});
				}else if(resp.type=="success"){
					$("#account-success").attr('style','color:green');
					$("#account-success").html(resp.message);
				}
				
			},error:function(){
				alert("Error");
			}
		
		 });
	});

	// password form validation
	$("#passwordForm").submit(function(){
		var formdata =$(this).serialize();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:formdata,
			url:'/user/update-password',
			type:'POST',
			success:function(resp){
				if(resp.type=="error"){
					$.each(resp.errors,function(i,error){
						$("#password-"+i).attr('style','color:red');
						$("#password-"+i).html(error);
					
						setTimeout(function(){
							$("#password-"+i).css({'display':'none'});
						},3000);
					});
				
				}else if(resp.type=="incorrect"){
					$("#password-error").attr('style','color:red');
					$("#password-error").html(resp.message);
				
					setTimeout(function(){
						$("#password-error").css({'display':'none'});
					},3000);
				
			    }else if(resp.type=="success"){
					$("#password-success").attr('style','color:green');
					$("#password-success").html(resp.message);
				}
				
			},error:function(){
				alert("Error");
			}
		
		 });
	});

	// forgot password
	$("#forgotForm").submit(function(){
		var formdata =$(this).serialize();
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:formdata,
			url:'/user/forgot-password',
			type:'POST',
			success:function(resp){
				if(resp.type=="error"){
					//$(".loader").hide();
					$.each(resp.errors,function(i,error){
						$("#forgot-"+i).attr('style','color:red');
						$("#forgot-"+i).html(error);
					
						setTimeout(function(){
							$("#forgot-"+i).css({'display':'none'});
						},3000);
				});
				}else if(resp.type=="success"){
					//alert(resp.message);
					//$(".loader").hide();
					$("#forgot-success").attr('style','color:green');
					$("#forgot-success").html(resp.message);
				}
				
			},error:function(){
				alert("Error");
			}
		
		 });
	});

});