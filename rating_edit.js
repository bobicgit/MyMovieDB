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

// pobieram zmienna z php string_of_actors_id_edit i sprawdzam, czy jest pustym lancuchem, czy nie. Jesli tak
// tworze pusta tablice, ktora bede wykorzystywac w petli podczas wyswietlania odpowiednich checkboxow (w
//	tym przypadku aby zadne nie byly zaznaczone). Jesli nie jest to pusty lancuch, to zamieniam go na
// tablice z wartosciami, ktora tez bedzie wykorzystana podczas wysweitlania zaznaczonych chackboxow.
	if (string_of_actors_id_edit === '') {
		var array_of_actors_id_edit2 = [];

	}else {
		var array_of_actors_id_edit = string_of_actors_id_edit.split(",");
		var array_of_actors_id_edit2 = array_of_actors_id_edit.reverse();
		console.log(array_of_actors_id_edit2);
	}
//	WYSWIETLANIE CHECKBOXOW AKTOROW Z ZAZNACZONYMI WCZESNIEJ CHECKBOXAMI. 

	$.ajax({
		type: 'POST',
		url: 'selact.php',
		//contentType: 'text/html; charset=utf-8',
		dataType:'json',
		success: function(data) {
			console.log(data);
			
				console.log(data.length);
				var j = 0;
				var i = 0;
				for(i ; i<data.length ; i++){

							$('#actors').append('<input type = "checkbox" id="' + 'cb' + data[i].idactors + 
							'" value = "'+data[i].idactors+'" name = "new_check_list[]"  >' + " " + data[i].name + " "
							+ data[i].surname + '<br>');
// po dodaniu wszystkich checkboxow, sprawdzam, ktore idaktorow sa takie same jak w tablicy pobranej z php
// jesli sa, to zmieniam atrybut inputa, aby wyswietlal sie zaznaczony.
					for(j=0 ; j<array_of_actors_id_edit2.length ; j++){
						if (data[i].idactors == array_of_actors_id_edit2[j]){
							
							$('#cb'+data[i].idactors+'').attr('checked', true);
						}
					}
				}
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
