/*price range*/


//console.log();

$('.catalog').dcAccordion({
    speed: 300
});

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
    
//    $('#category-parent_id').on('change', function(){
//        var id = $('#category-parent_id').val();
//        
//        console.log($('#category-parent_id').val());
//        
//        $.ajax({
//            url: '/admin/category/update',
//            type: 'GET',
//            data: {id: id},
//            success: function(res){
//                if(!res) alert('Error!!!');
//                console.log(id);
//            },
//            error: function(){
//                alert('Error');
//            }
//        });
//        
//    });
    
    
     function getCart(e){
         e.preventDefault();
          $.ajax({
            url: '/cart/show',
            type: 'GET',
            success: function(res){
                if(!res) alert('Error!!!');
                showCart(res);
            },
            error: function(){
                alert('Error');
            }
        });
     }
     
     $('#header-cart').on('click', getCart);
    
     $('#cart .modal-body').on('click', '.del-item', function(){
         var id = $(this).data('id');
         
         /**
          * Передаем данные на сервер
          */
         $.ajax({
            url: '/cart/del-item',
            data: {id: id},
            type: 'GET',
            success: function(res){
                if(!res) alert('Error!!!');
                showCart(res);
            },
            error: function(){
                alert('Error');
            }
        });
     });
    
     $('.clear-cart').on('click', clearCart);
    
     function clearCart(){
         
          $.ajax({
            url: '/cart/clear',
            type: 'GET',
            success: function(res){
                if(!res) alert('Error!!!');
                showCart(res);
            },
            error: function(){
                alert('Error');
            }
        });
        
     }
    
     function showCart(cart){
         $('#cart .modal-body').html(cart);
         $('#cart').modal();
     }
     
    /**
    * Передаем данные на сервер
    */
    $('.add-to-cart').on('click', function(e){
        e.preventDefault();
        var id = $(this).data('id'),
           qty = $('#qty').val();
        
        $.ajax({
            url: '/cart/add',
            data: {
                id: id,
                qty: qty
            },
            type: 'GET',
            success: function(res){
                if(!res) alert('Error!!!');
                showCart(res);
            },
            error: function(){
                alert('Error');
            }
        });
    });

    
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});
