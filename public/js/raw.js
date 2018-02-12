var raw_confirm='';
$( document ).ready( function() {

	var opts = {
	  lines: 13 // The number of lines to draw
	, length: 28 // The length of each line
	, width: 14 // The line thickness
	, radius: 42 // The radius of the inner circle
	, scale: 1 // Scales overall size of the spinner
	, corners: 1 // Corner roundness (0..1)
	, color: '#2980b9' // #rgb or #rrggbb or array of colors
	, opacity: 0.25 // Opacity of the lines
	, rotate: 0 // The rotation offset
	, direction: 1 // 1: clockwise, -1: counterclockwise
	, speed: 1 // Rounds per second
	, trail: 60 // Afterglow percentage
	, fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
	, zIndex: 2e9 // The z-index (defaults to 2000000000)
	, className: 'spinner' // The CSS class to assign to the spinner
	, top: '50%' // Top position relative to parent
	, left: '50%' // Left position relative to parent
	, shadow: false // Whether to render a shadow
	, hwaccel: false // Whether to use hardware acceleration
	, position: 'absolute' // Element positioning
	}

	if($('#field_atiende').length)
	{		
		$('.spin').show();								
		var target = document.getElementById('spin');
		var spinner = new Spinner(opts).spin(target);
		$.ajax({
			type: "POST",           
			url: 'https://servicio.ciatec.mx/Biblioteca/v1/WCF_Libros.svc/ConsultarEmpleados',
			contentType: "application/json;charset=utf-8",
			dataType: "json",
			success: function (response) {
				$empleados = $.parseJSON(response.d);
				console.log($empleados);
				$.each($empleados, function(key, value){	
					var newOption = new Option(value.Empleado, value.Correo, true, true);
					$("#field_atiende").append(newOption).trigger('change');									
				});
				$('.spin').hide();								
			}
		});
		
	}
	
	//$( 'textarea.editor' ).ckeditor();
	$( 'textarea.editor' ).trumbowyg({
		lang: 'es',		
		btns: [	        

	        ['formatting'],
	        'btnGrp-semantic',
	        ['superscript', 'subscript'],
	        ['link'],	   
	        ['table'],     
	        'btnGrp-justify',
	        'btnGrp-lists',	        
	        ['removeformat'],	        
	        ['foreColor', 'backColor'],
	        //['fontfamily']
	    ],	    
	    btnsAdd: ['foreColor', 'backColor', 'table'],
		plugins: {
			colors: {
				colorList: ['66d0ff', '00518c']
			}
		}
	});

	var post = new MediumEditor('.NewPost', {
		placeholder : {
			text : 'Escribe aquí tu post'
		},
		toolbar : {
			allowMultiParagraphSelection: true,
			buttons: ['bold', 'italic', 'underline', 'anchor', 'orderedlist','unorderedlist', 'h1']
		},
	});

	$('.NewPost').mediumInsert({
		editor: post,
		enabled: true,				
		addons : {
			images: {
				fileUploadOptions: {
					url: $('.NewPost').data('action'),
					acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
				},
				deleteScript : $('.NewPost').data('remove'),				
				uploadCompleted: function ($el, data) {
					console.log($el);
					console.log(data);
				},
				uploadError: function ($el, data) {
					console.log(data);
				}
			}
		}
	});	


	if ($('.raw-form select').length > 0)
	{
		$('.raw-form select').select2({
		});
	}

	$('#raw-add button[type="submit"], #raw-edit button[type="submit"], #raw-list-form button[type="submit"]').click(function(e){
		e.preventDefault();

		var redirect = $(this).attr('data-rel');
		if (redirect == 'redirect')
		{
			var redirect_path = $(this).attr('data-redirect');
		}

		if($('.Post textarea').length)
		{			
			$('.Post textarea').val($('.Post .NewPost').html());
		}

		var form = $(this).parents('form');
		var args = form.serializeArray();

		$('.spin').show();								
		var target = document.getElementById('spin');
		var spinner = new Spinner(opts).spin(target);
		
		$.ajax({
		  type: "POST",
		  url: form.attr('action'),
		  data: args,
		  dataType:'json'
		}).done(function( json ) 
		{							
			form.find('div.alert').remove();	
			$('.raw-error').html('');	
			if (json['status'] && json['status'] == 1)
			{
				form.prepend('<div class="alert alert-success">'+json['message']+'</div>');
				if (redirect == 'redirect')
				{
					window.location.href = redirect_path;
				}
				spinner.stop();
				$('.spin').hide();
				
			}				 
			else
			{
				for (key in json['errors']) 
				{
					$("#error_"+key).html('<div class="alert alert-danger">'+json['errors'][key].join('<br/>')+'</div>');
				}
				spinner.stop();
				$('.spin').hide();
			}
			
		})
		.fail(function(data){		        	
			console.log(data);
			$('.spin').hide();
			alert('Error');
		});
	});

	$('#raw-list').on('click','a.raw-delete',function(e){
		e.preventDefault();

		var $this = $(this);		
		swal({
		   title: "¿Estás seguro?",   
		   text: "¿Deseas eliminar este elemento?",   
		   type: "warning",   
		   showCancelButton: true,   
		   confirmButtonColor: "#DD6B55",   
		   confirmButtonText: "Eliminar",   
		   closeOnConfirm: false 
		}, function(){  
			var redirect = $this.attr('data-rel');
			if (redirect == 'redirect')
			{
				var redirect_path = $this.attr('data-redirect');
			}
			var list = $('#raw-list');
			var item = $this;
			
			$.ajax({
				type: "POST",
				url: item.attr('href'),
				data: {},
				dataType:'json'
			}).done(function( json )
			{
				list.parent().find('div.alert').remove();
				$('.raw-error').html('');

				if (json['status'] && json['status'] == 1)
				{					
					list.parent().prepend('<div class="alert alert-success">'+json['message']+'</div>');
					if (redirect == 'redirect')
					{
						window.location.href = redirect_path;
					}
				}
				else
				{
					swal("Error!", json['message'], "error"); 
					list.parent().prepend('<div class="alert alert-danger">'+json['message']+'</div>');
				}
				
			}); 			
		});
		
	});

	if ($('.list-order').length > 0)
	{
		$('.list-order').each(function(){
			var depth = $(this).attr('data-depth');

			if (depth == 0)
				var parent_field_class = undefined;
			else
				var parent_field_class = 'row-parent';


			$(this).tableDrag(
			{
				draggableClass: 'draggable',
				cookiePath: '/',
				weight: {
					fieldClass: 'row-weight',
					hidden: true
				},
				parent: {
					fieldClass: parent_field_class,
					sourceFieldClass: 'primary-id',
					hidden: true
				},
				group: {
					fieldClass: 'row-depth',
					depthLimit: depth
				},
			});
		});
	}

	/* Upload */
	if ($('.raw-upload').length > 0)
	{		

		$('.raw-uploaded').on('click','a.btn.delete',function(e){
			e.preventDefault();
	

			$this = $(this);
			$parent = $(this).parents('.form-group');
			if (confirm(raw_confirm))
			{
				$parent.find('.raw-uploaded').hide();//.find('table tr').remove();
				$parent.find('.raw-upload').show();	

				field_id = $parent.find('.raw-upload').data('field');				
				$('#value-'+field_id).val('');
			}
		});

		$('.raw-upload').each(function()
		{
		    var url = $(this).attr('data-url');
		    var field_id = $(this).attr('data-field');
		    var filesize = $(this).attr('data-filesize');
		    var extensions = $(this).attr('data-extensions');
		    var progress_cont = $(this).find('.progress');

		    var files = $(this).next().find('table');
		    var files_container = $(this).next();

		    var item = $(this);

		    progress_cont.hide();

		    $('#field-'+field_id).fileupload({
		        url: url,
		        dataType: 'json',
		        formData: {
		        	'field':field_id
		        },
		        start: function(e,data)
		        {		        	
		        	$("#error_"+field_id).html('');
		        	progress_cont.show();
		        },
		        done: function (e, data) {
		        	progress_cont.hide();		        	
		        	if (data.result.status == 1)
		        	{
		        		item.hide();
		        		files.html(data.result.response);
		        		files_container.show();
		        		
		        		var old = '';
		        		if ($('#old-'+field_id).val()!='')
		        			old = $('#old-'+field_id).val()+','+ $('#value-'+field_id).val();
		        		else 
		        			old = $('#value-'+field_id).val();

		        		$('#old-'+field_id).val(old);

		        		$('#value-'+field_id).val(data.result.file);
		        	}
		        	else
		        	{
		        		$("#error_"+field_id).html('<div class="alert alert-danger">'+data.result.message+'</div>');
		        	}
		        },
		        progressall: function (e, data) {		        	
		            var progress = parseInt(data.loaded / data.total * 100, 10);
		            progress_cont.find('.progress-bar').css(
		                'width',
		                progress + '%'
		            );
		        },
		        fail: function(e, data){		        	
		        },
		    }).prop('disabled', !$.support.fileInput)
		        .parent().addClass($.support.fileInput ? undefined : 'disabled');
		});
	}
	
} );