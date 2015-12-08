// FUNCTION THAT FILLS SELECTBOX WITH NAMES OF GENRES FROM DATABASE AND CREATING
// A CHECKBOXES WITH NAME AND SURNAME OF ACTORS, ALSO FROM DATABASE.
// I IS MADE BY AJAX, DYNAMICLLY.

function filling(){
	$('#selection').empty();
	$('#selection').append("<option value = ''>Loading ...</option>");

	$.ajax({
		type: 'POST',
		url: 'selgen.php',
		dataType:'json',
		success: function(data) {
			console.log(data);

// VARIABLE genre_edit_id IS DECLARD IN movie_update.php FILE IN SEPERATED JS SCRIPT.
// IT DESCRIBES THE ID OF THE GENRE OF EDITING MOVIE

			$('#selection').empty();
			$('#selection').append('<option value = "">--Select Genre--</option>');
			$.each(data,function(i, item) {

// -1 BECOUSE OF ITERATION IN EACH LOOP

				if (i==genre_edit_id-1){
					$('#selection').append('<option value ="' + (genre_edit_id) + '" selected="selected" >' + data[genre_edit_id-1].genre +
				 	'</option>');
				}else{
					$('#selection').append('<option value ="' + data[i].id + '" >' + data[i].genre +
				 	'</option>');
				}
			});
		},
		error: function(jqXHR, textStatus, errorThrown) {
 		 	console.log(textStatus, errorThrown);
		}	
	});

// GETTING THE VARIABLE string_of_actors_id_edit FROM movie_update.php AND CHECKING IF IT IS AN EMPT STRING
// IF IT IS AN EMPTY ARRAY IS CREATING, NO ACTORS WAS CHOSEN. IF THE STRING IS NOT EMPTY, THEN IT IS 
// TRANSFORMED TO ARRAY WITH THOSE VALUES. ARRAY WILL BE USE IN DISPLAYING CHOECKBOXES.

	if (string_of_actors_id_edit === '') {
		var array_of_actors_id_edit2 = [];

	}else {
		var array_of_actors_id_edit = string_of_actors_id_edit.split(",");
		var array_of_actors_id_edit2 = array_of_actors_id_edit.reverse();
		console.log(array_of_actors_id_edit2);
	}

// DISPLAYING A CHECKBOXES WITH ACTORS THAT WAS CHOSEN BEFORE

	$.ajax({
		type: 'POST',
		url: 'selact.php',
		dataType:'json',
		success: function(data) {
			console.log(data);
			console.log(data.length);
			var j = 0;
			var i = 0;
				for(i ; i<data.length ; i++){

					$('#actors').append('<input type = "checkbox" id="' + 'cb' + data[i].id + 
					'" value = "'+data[i].id+'" name = "new_check_list[]"  >' + " " + data[i].name + " "
					+ data[i].surname + '<br>');

// AFTER DISPLAYING ALL OF CHECKBOXES, THERE IS ANOTHER for LOOP FOR CHECKING WHICH OF IDS OF ACTORS ARE THE 
// SAME AS IN CREATED ARRAY. WHEN IT IS THE SAME I AM CHANGING AN ARTIBUTE OF INPUT FOR CHECKED, TO DISPLAY 
// IT PROPERLY

					for(j=0 ; j<array_of_actors_id_edit2.length ; j++){
						if (data[i].id == array_of_actors_id_edit2[j]){
							$('#cb'+data[i].id+'').attr('checked', true);
						}
					}
				}
		},
		error: function(jqXHR, textStatus, errorThrown) {
 		 	console.log(textStatus, errorThrown);
		}	
	});
}

// FUNCTION OF VALIDATION OF THE FORM USING jQUERY VALIDATIN PLUGIN

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
  				error.insertBefore(element);
    			
  			} else {
    			error.insertBefore(element);
  			}
		}
	});
});


$(document).ready(function(){

	filling();
	
	$('#new_actual_rate').val(rating_edit);
	$('#jRate').jRate({
		count: 10,
		startColor: "red",
		endColor: "purple",
		width: 30,
  		height: 30,
  		precision: 0.5,
  		rating: rating_edit/2,
  		onSet: function(rating) {
    		$('#new_actual_rate').val(rating*2);
  		}
	}),

	$('#summernote_field').summernote({

		height: 150,// nie wykonuje sie nic z onChnange, a wczesniej robilo
		onInit: function(contents, $editable) {
		$('#summernote_field').code(description_edit);
    	$('#summernote_plain').val(description_edit);
    	//console.log(description_edit);
  	},
		onChange: function(contents, $editable) {
		cleanText = $('#summernote_field').code();
    	$('#summernote_plain').val(cleanText);
    	console.log(cleanText);
  	},

  	onpaste: function(content) {
      setTimeout(function () {
        editor.code(content.target.textContent);
      }, 10);
    }
	}),
	
		$('.confirmation').on('click', function(){
		return confirm('Are you sure?');
	});
	
});
