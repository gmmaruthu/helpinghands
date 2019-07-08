// Custom JS

$(document).ready(function(){
    $('#addbookForm').on('submit', function(e){
        
        var book_title = $('#book_title').val();
        var book_author = $('#book_author').val();
	
		if(book_title == ''){
			$('.book_title').html('Book title is required');
			return false;
		}else{
			$('.book_title').html('');	
		}
		if(book_author == ''){
			$('.book_author').html('Book author is required');
			return false;
		}else{
			$('.book_author').html('');	
		}
    });
	
	$('#searchbookForm').on('submit', function(e){
		var searchbooks = $('#searchbooks').val();
		if(searchbooks == ''){
			$('.searchbooks').html('Please select a book');
			return false;
		}else{
			$('.searchbooks').html('');	
		}
	});	
	$('#requestForm').on('submit', function(e){
		var requestcomment = $('#requestcomment').val();
		var searchbooks = $('#searchbooks').val();
		$('#requestbookid').val(searchbooks);
		if(requestcomment == ''){
			$('.requestcomment').html('This field is required');
			return false;
		}else{
			$('.requestcomment').html('');	
		}
	});	
	
	$('#requestbookForm').on('submit', function(e){
		var requeststatus = $('#requeststatus').val();
		if(requeststatus == ''){
			$('.requeststatus').html('This field is required');
			return false;
		}else{
			$('.requeststatus').html('');	
		}
		
		if(requeststatus == '1'){
			var acceptlocation = $('#acceptlocation').val();
			$('.acceptlocation').html('This field is required');
			if(acceptlocation == ''){
				$('.acceptlocation').html('This field is required');
				return false;
			}else{
				$('.acceptlocation').html('');	
			}
			
			var acceptdate = $('#acceptdate').val();
			if(acceptdate == ''){
				$('.acceptdate').html('This field is required');
				return false;
			}else{
				$('.acceptdate').html('');	
			}
			
			var accepttime = $('#accepttime').val();
			if(accepttime == ''){
				$('.accepttime').html('This field is required');
				return false;
			}else{
				$('.accepttime').html('');	
			}
			
			var accepttime = $('#accepttime').val();
			if(accepttime == ''){
				$('.accepttime').html('This field is required');
				return false;
			}else{
				$('.accepttime').html('');	
			}
			
			
		}else{
			var rejectreason = $('#rejectreason').val();
			if(rejectreason == ''){
				$('.rejectreason').html('This field is required');
				return false;
			}else{
				$('.rejectreason').html('');	
			}
		}
	});	
	
	
	$('#requeststatus').change(function () {
		var requeststatus = $('#requeststatus').val();
		if(requeststatus == '1'){
			$('#accept_request').css('display','block');
			$('#reject_request').css('display','none');
		}else{
			$('#accept_request').css('display','none');
			$('#reject_request').css('display','block');
		}
	}); 
});
