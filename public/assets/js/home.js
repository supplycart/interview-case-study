$(document).ready(function(){
	$('.category').on('click',function(){
		var categoryId = $(this).data('id');

		$.ajax({
			url:'/category/'+categoryId,
			success:function(data){
				console.log(data)
			}
		})
	})
})