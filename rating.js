function filling() {
	$('#selection').empty();
	$('#selection').append("<option value = ''>Loading ...</option>");


	$.ajax({
		type: 'POST',
		url: 'selgen.php',
		//contentType: 'text/html; charset=utf-8',
		dataType:'json',
		success: function(data) {
			console.log(data);
			$('#selection').empty();
			$('#selection').append('<option value = "">--Select Genre--</option>');
			$.each(data,function(i, item) {
				$('#selection').append('<option value ="' + data[i].idgenres + '" >' + data[i].genre + '</option>');
			});
		},
		error: function(jqXHR, textStatus, errorThrown) {
 		 	console.log(textStatus, errorThrown);
		}	
	});

	$.ajax({
		type: 'POST',
		url: 'selact.php',
		//contentType: 'text/html; charset=utf-8',
		dataType:'json',
		success: function(data) {
			console.log(data);
			$.each(data,function(i, item) {
				$('#actors').append('<input type = "checkbox" id="' + 'cb' + data[i].idactors + '" value = "'+data[i].idactors+'" name = "check_list[]">' + " " + data[i].name + " " + data[i].surname + '<br>');
			});
		},
		error: function(jqXHR, textStatus, errorThrown) {
 		 	console.log(textStatus, errorThrown);
		}	
	});

}

$(function myval(){

	$('#add_movie').validate({
		ignore: "input[type='text']:hidden",
		rules: {
			title: "required",
			year: {
				required: true,
				number: true,
				min: 1900,
				digits: true,
				max: 2015
			},
			summernote_holder: "required",
			rate: "required",
			selection_to_send: "required"
		},
		messages: {
			title: "Please enter the title of the movie",
			summernote_holder: "Please enter a short description of the movie",
			year: {
				required: "Please enter a release year of the movie",
				number: "Please enter a number (year)",
				min: "Please enter a valid year of release the movie",
				max: "Please enter a valid year of release the movie",
				digits: "Please enter a number (digits)"
			},
			selection_to_send:"Please choose a genre of the movie",
			rate: "Please rate a movie"
		},
		errorPlacement: function(error, element) {
  			if(element.attr("name") == "rate") {
    			error.appendTo( '#container_for_error');
  			} else {
    			error.insertAfter(element);
  			}
		}

	});
});


$(document).ready(function(){

	filling();
	


	$('#jRate').jRate({
		count: 10,
		startColor: "red",
		endColor: "purple",
		width: 30,
  		height: 30,
  		precision: 0.5,
  		onSet: function(rating) {
    		$('#actual_rate').val(rating*2);
  		}
	}),

	$('#summernote_field').summernote({

		height: 150,// nie wykonuje sie nic z onChnange, a wczesniej robilo
		onChange: function(contents, $editable) {
		 cleanText = $('#summernote_field').code().replace(/<\/?[^>]+(>|$)/g, "")
		 	                				.replace(/<\/p>/gi, "\n")
                							.replace(/<br\/?>/gi, "\n");
    	$('#summernote_plain').val(cleanText);
    	console.log(cleanText);
  		},

  		onpaste: function(content) {
            setTimeout(function () {
                editor.code(content.target.textContent);
            }, 10);
        }
	}),


	$('#add_movie').on('submit', function(par){
		par.preventDefault();
		var form = $(this);
		console.log(form.find("select,textarea, input").serialize());

		if($('#add_movie').valid()){
			$.ajax({
				type: 'POST',
				url: 'adding.php',
				data: form.serialize(),
				success: function(result){
					$('#add_movie')[0].reset();
					$('#summernote_field').code('');
					$('#jRate').val(0);
					alert('Great! Thanks for adding a movie! \nHave a nice day!');
				}
			});
		}else{

		}
	});
	
   });
