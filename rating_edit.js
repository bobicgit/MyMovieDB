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
// zmienna genre_edit_id jest deklarowana w pliku movie_update.php w osobnym skrypcie js
// jest to zmienna z id gatunku edytowanego filmu.
			$.each(data,function(i, item) {
// -1 ze wzgledu na numeracje iteracji petli each (od 0) a rekordy id w bazie od 1.
				if (i==genre_edit_id-1){
					$('#selection').append('<option value ="' + (genre_edit_id) + '" selected="selected" >' + data[genre_edit_id-1].genre +
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
//	WYSWIETLANIE CHECKBOXOW AKTOROW Z ZAZNACZONYMI WCZESNIEJ CHECKBOXAMI. 
//pobieram zmienna z php ktora jest stringiem i zamieniam ja na tablice. NIE DZIALA
	var array_of_actors_id_edit = string_of_actors_id_edit.split(",");
	var array_of_actors_id_edit2 = array_of_actors_id_edit.reverse();
	

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
				$.each(data,function(i, item) {
					
					$('#actors').append('<input type = "checkbox" id="' + 'cb' + data[i].idactors + 
					'" value = "'+data[i].idactors+'" name = "check_list[]" checked>' + " " + data[i].name + " "
					 + data[i].surname + '<br>');
				});
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

  		onpaste: function(content) {
            setTimeout(function () {
                editor.code(content.target.textContent);
            }, 10);
        }
	});
	
   });
