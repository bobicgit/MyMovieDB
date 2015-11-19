// Funkcja wypelniajaca pole select nazwami gatunkow z bazy danych oraz wykonujaca checkboxy
// z imieniem oraz nazwiskiem aktora, rowniez z bazy danych. 

function filling(){
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

			//console.log(data[genre_edit_id-1].genre);
			$.each(data,function(i, item) {
				
				if (i==genre_edit_id-1){
					$('#selection').append('<option value ="' + (genre_edit_id-1) + '" selected="selected" >' + data[genre_edit_id-1].genre +
				 	'</option>');
				}else{
					$('#selection').append('<option value ="' + data[i].idgenres + '" >' + data[i].genre +
				 	'</option>');
				}

			});

		},
		error: function(jqXHR, textStatus, errorThrown) {
 		 	console.log(textStatus, errorThrown);
		}	
	});

//pobieram zmienna z php ktora jest stringiem i zamieniam ja na tablice.
	var array_of_actors_id_edit = string_of_actors_id_edit.split(",");
	var array_of_actors_id_edit2 = array_of_actors_id_edit.reverse();
	//console.log(array_of_actors_id_edit[0]);
	$.ajax({
		type: 'POST',
		url: 'selact.php',
		//contentType: 'text/html; charset=utf-8',
		dataType:'json',
		success: function(data) {
			console.log(data);
			console.log(array_of_actors_id_edit2[0]);
			console.log(array_of_actors_id_edit2[1]);
			console.log(data.length);
			//$.each(data,function(i, item) {


				for(j=0;j<data.length;j++){

					for(k=0;k<array_of_actors_id_edit2.length;k++){
						if(data[j].idactors == array_of_actors_id_edit2[k]){

							$('#actors').append('<input type = "checkbox" id="' + 'cb' + data[j].idactors + 
							'" value = "'+data[j].idactors+'" name = "check_list[]" checked = "checked">'
						 	+ " " + data[j].name + " "+ data[j].surname + '<br>');

						}
					}

					// if(data[j].idactors !== array_of_actors_id_edit2)
					// 		$('#actors').append('<input type = "checkbox" id="' + 'cb' + data[j].idactors + 
					// 		'" value = "'+data[j].idactors+'" name = "check_list[]" >'
					// 	 	+ " " + data[j].name + " "+ data[j].surname + '<br>');					
						console.log(array_of_actors_id_edit2);
				}
					


						//console.log('s');

					


					

					

				//});
			
				
		},
		

		error: function(jqXHR, textStatus, errorThrown) {
 		 	console.log(textStatus, errorThrown);
		}	
	});

}

//Funkcja służąca do walidacji formularza
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
				max: 2016
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
	
	//console.log(rating_edit);


	$('#jRate').jRate({
		count: 10,
		startColor: "red",
		endColor: "purple",
		width: 30,
  		height: 30,
  		precision: 0.5,
  		rating: rating_edit/2,
  		onSet: function(rating) {
    		$('#actual_rate').val(rating*2);
  		}
	}),

	$('#summernote_field').summernote({

		height: 150,// nie wykonuje sie nic z onChnange, a wczesniej robilo
		onInit: function(contents, $editable) {
		 cleanText = $('#summernote_field').code(description_edit);
    	$('#summernote_plain').val(cleanText);
    	//console.log(description_edit);
  		},

  		onpaste: function(content) {
            setTimeout(function () {
                editor.code(content.target.textContent);
            }, 10);
        }
	});


	// $('#add_movie').on('submit', function(par){
	// 	par.preventDefault();
	// 	var form = $(this);
	// 	console.log(form.find("select,textarea, input").serialize());

	// 	if($('#add_movie').valid()){
	// 		$.ajax({
	// 			type: 'POST',
	// 			url: 'adding.php',
	// 			data: form.serialize(),
	// 			success: function(result){
	// 				$('#add_movie')[0].reset();
	// 				$('#summernote_field').code('');
	// 				$('#jRate').val(0);
	// 				alert('Great! Thanks for adding a movie! \nHave a nice day!');
	// 			}
	// 		});
	// 	}else{

	// 	}
	// });
	
   });
