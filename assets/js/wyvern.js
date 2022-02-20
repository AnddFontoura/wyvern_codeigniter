
function dialogActive(title,text,type,link_redirect)
{
	swal({
		title: title,
		text: text,
		type: type,
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Sim, continuar'
	}).then((result) => {
	if (result.value)
	{
		var request = $.ajax({
			url: link_redirect,
			method: "POST",
			data: { id : "id" },
			dataType: "json"
		});

		//console.log(request);

		request.done(function() {
			swal({
				title: 'Pronto!',
				text: 'A alteração foi realizada com sucesso',
				type: 'success',
				buttons: true,
			})
			.then((buttonClick) => {
				if (buttonClick) {
				  location.reload();
				}
			});
		});

		request.fail(function( ) {
			swal(
			  'Erro',
			  'Algum problema aconteceu, certifique-se de que a conexão com a internet esteja OK e que você esteja logado no sistema.',
			  'error'
			)
		});

	} else if (result.dismiss === 'cancel') {
		swal(
		  'Operação Cancelada',
		  'Nenhuma alteração foi realizada.',
		  'error'
		)
	}
	})

}

function formCategoria(link_redirect)
{
	event.preventDefault();

	var data = new FormData();

	data.append ( "categoryName" , $('#categoryName').val());
	data.append ( "categoryActive" , $( "select#categoryActive option:checked" ).val());
	data.append ( "categoryDescription" , CKEDITOR.instances.editor1.getData());
	data.append ( "categoryImage" , $('#categoryImage')[0].files[0] );


	//console.log($('#categoryImage')[0].files[0]);

	/* Faz a leitura das entradas de dado para conferência.
	for (var pair of data.entries()) {
		console.log(pair[0]+ ', ' + pair[1]);
	}
	*/

	var request = $.ajax({
		url: link_redirect,
		method: "POST",
		data: data,
		dataType: "json",

		/* Upload Process */
		cache: false,
		processData: false,  // tell jQuery not to process the data
		contentType: false,   // tell jQuery not to set contentType


		beforeSend: function() {
			swal({
				title: 'Aguarde',
				text: 'Gravando seus dados',
				type: 'warning',
				showConfirmButton: false
			})
		},

		success: function(data){

			if ( typeof data['errors'] !== 'undefined' )
			{
				swal({
					title: 'Problema Encontrado',
					text: data['errors'],
					type: 'error'
				})
			} else {
				swal({
					title: 'Pronto!',
					text: 'Seu dado foi incluido com sucesso. Sinta-se a vontade para incluir novas categorias',
					type: 'success',
					buttons: true,
				})
				.then((buttonClick) => {
					if (buttonClick) {
					  location.reload();
					}
				});
			}
		},

		error: function(data) {
			swal(
			  'Erro',
			  'Algum problema aconteceu, certifique-se de que a conexão com a internet esteja OK e que você esteja logado no sistema.',
			  'error'
			)
		}
	});

	//console.log(request);

}

function formServiceOrder(link_redirect)
{
	event.preventDefault();

	var data = new FormData();

	data.append ( "customerId" , $("select#customerId option:checked").val());
	data.append ( "statusId" , $( "select#statusId option:checked" ).val());
	data.append ( "serviceDescription" , CKEDITOR.instances.editor1.getData());
	data.append ( "serviceStart" , $('#serviceStart').val());
	data.append ( "serviceEnd" , $('#serviceEnd').val());
	data.append ( "servicePrice" , $('#servicePrice').val());


	//console.log($('#categoryImage')[0].files[0]);

	/* Faz a leitura das entradas de dado para conferência.  */
	for (var pair of data.entries()) {
		console.log(pair[0]+ ', ' + pair[1]);
	}
	//*/

	var request = $.ajax({
		url: link_redirect,
		method: "POST",
		data: data,
		dataType: "json",

		/* Upload Process */
		cache: false,
		processData: false,  // tell jQuery not to process the data
		contentType: false,   // tell jQuery not to set contentType


		beforeSend: function() {
			swal({
				title: 'Aguarde',
				text: 'Gravando seus dados',
				type: 'warning',
				showConfirmButton: false
			})
		},

		success: function(data){

			if ( typeof data['errors'] !== 'undefined' )
			{
				swal({
					title: 'Problema Encontrado',
					text: data['errors'],
					type: 'error'
				})
			} else {
				swal({
					title: 'Pronto!',
					text: 'Seu dado foi incluido com sucesso. Sinta-se a vontade para incluir novas categorias',
					type: 'success',
					buttons: true,
				})
				.then((buttonClick) => {
					if (buttonClick) {
					  location.reload();
					}
				});
			}
		},

		error: function(data) {
			swal(
			  'Erro',
			  'Algum problema aconteceu, certifique-se de que a conexão com a internet esteja OK e que você esteja logado no sistema.',
			  'error'
			)
		}
	});

	//console.log(request);

}

function formPlan(link_redirect)
{
	event.preventDefault();

	var data = new FormData();

	data.append ( "planName" , $('#planName').val());
	data.append ( "planPrice" , $('#planPrice').val());
	data.append ( "planActive" , $( "select#planActive option:checked" ).val());
	data.append ( "planDescription" , CKEDITOR.instances.editor1.getData());
	data.append ( "planTypeId" , $( "select#planTypeId option:checked" ).val());


	//console.log($('#categoryImage')[0].files[0]);

	/* Faz a leitura das entradas de dado para conferência. *
	for (var pair of data.entries()) {
		console.log(pair[0]+ ', ' + pair[1]);
	}
	*/

	var request = $.ajax({
		url: link_redirect,
		method: "POST",
		data: data,
		dataType: "json",

		/* Upload Process */
		cache: false,
		processData: false,  // tell jQuery not to process the data
		contentType: false,   // tell jQuery not to set contentType


		beforeSend: function() {
			swal({
				title: 'Aguarde',
				text: 'Gravando seus dados',
				type: 'warning',
				showConfirmButton: false
			})
		},

		success: function(data){

			if ( typeof data['errors'] !== 'undefined' )
			{
				swal({
					title: 'Problema Encontrado',
					text: data['errors'],
					type: 'error'
				})
			} else {
				swal({
					title: 'Pronto!',
					text: 'Seu dado foi incluido com sucesso. Sinta-se a vontade para incluir novas categorias',
					type: 'success',
					buttons: true,
				})
				.then((buttonClick) => {
					if (buttonClick) {
					  location.reload();
					}
				});
			}
		},

		error: function(data) {
			swal(
			  'Erro',
			  'Algum problema aconteceu, certifique-se de que a conexão com a internet esteja OK e que você esteja logado no sistema.',
			  'error'
			)
		}
	});

	//console.log(request);

}

function formCustomer(link_redirect)
{
	event.preventDefault();

	var data = new FormData();

	data.append ( "customerName" , $('#customerName').val());
	data.append ( "customerEmail" , $('#customerEmail').val());
	data.append ( "customerLogin" , $('#customerLogin').val());
	data.append ( "customerPassword" , $('#customerPassword').val());
	data.append ( "customerDocument" , $('#customerDocument').val());
	data.append ( "customerRG" , $('#customerRG').val());
	data.append ( "customerType" , $( "select#customerType option:checked" ).val());
	data.append ( "customerAllowEmail" , $( "select#customerAllowEmail option:checked" ).val());
	data.append ( "customerStatus" , $( "select#customerStatus option:checked" ).val());


	//console.log($('#categoryImage')[0].files[0]);

	/* Faz a leitura das entradas de dado para conferência. *
	for (var pair of data.entries()) {
		console.log(pair[0]+ ', ' + pair[1]);
	}
	*/

	var request = $.ajax({
		url: link_redirect,
		method: "POST",
		data: data,
		dataType: "json",

		/* Upload Process */
		cache: false,
		processData: false,  // tell jQuery not to process the data
		contentType: false,   // tell jQuery not to set contentType


		beforeSend: function() {
			swal({
				title: 'Aguarde',
				text: 'Gravando seus dados',
				type: 'warning',
				showConfirmButton: false
			})
		},

		success: function(data){

			if ( typeof data['errors'] !== 'undefined' )
			{
				swal({
					title: 'Problema Encontrado',
					text: data['errors'],
					type: 'error'
				})
			} else {
				swal({
					title: 'Pronto!',
					text: 'Seu dado foi incluido com sucesso. Sinta-se a vontade para incluir novas categorias',
					type: 'success',
					buttons: true,
				})
				.then((buttonClick) => {
					if (buttonClick) {
					  location.reload();
					}
				});
			}
		},

		error: function(data) {
			swal(
			  'Erro',
			  'Algum problema aconteceu, certifique-se de que a conexão com a internet esteja OK e que você esteja logado no sistema.',
			  'error'
			)
		}
	});

	//console.log(request);

}

function formSubCategoria(link_redirect)
{
	event.preventDefault();

	var data = new FormData();

	data.append ( "categoryId" , $( "select#categoryId option:checked" ).val());
	data.append ( "categorySubName" , $('#categorySubName').val());
	data.append ( "categorySubActive" , $( "select#categorySubActive option:checked" ).val());
	data.append ( "categorySubDescription" , CKEDITOR.instances.editor1.getData());
	data.append ( "categorySubImage" , $('#categorySubImage')[0].files[0] );


	//console.log($('#categoryImage')[0].files[0]);

	/* Faz a leitura das entradas de dado para conferência.
	for (var pair of data.entries()) {
		console.log(pair[0]+ ', ' + pair[1]);
	}
	*/


	var request = $.ajax({
		url: link_redirect,
		method: "POST",
		data: data,
		dataType: "json",

		/* Upload Process */
		cache: false,
		processData: false,  // tell jQuery not to process the data
		contentType: false,   // tell jQuery not to set contentType


		beforeSend: function() {
			swal({
				title: 'Aguarde',
				text: 'Gravando seus dados',
				type: 'warning',
				showConfirmButton: false
			})
		},

		success: function(data){

			if ( typeof data['errors'] !== 'undefined' )
			{
				swal({
					title: 'Problema Encontrado',
					text: data['errors'],
					type: 'error'
				})
			} else {
				swal({
					title: 'Pronto!',
					text: 'Seu dado foi incluido com sucesso. Sinta-se a vontade para incluir novas categorias',
					type: 'success',
					buttons: true,
				})
				.then((buttonClick) => {
					if (buttonClick) {
					  location.reload();
					}
				});
			}
		},

		error: function(data) {
			swal(
			  'Erro',
			  'Algum problema aconteceu, certifique-se de que a conexão com a internet esteja OK e que você esteja logado no sistema.',
			  'error'
			)
		}
	});

	//console.log(request);

}

function formImagemProduto(link_redirect)
{
	event.preventDefault();

	var data = new FormData();
	//data.append ( "productId" , $('#productId').val());
	data.append ( "productImageOrder" , $('#productImageOrder').val());
	data.append ( "productImageName" , $( "#productImageName").val());
	data.append ( "productImageDescription" , CKEDITOR.instances.editor1.getData());
	data.append ( "productImage" , $('#productImage')[0].files[0] );
	data.append ( "productImageMain" , $( "select#productImageMain option:checked" ).val());
	data.append ( "productImageActive" , $( "select#productImageActive option:checked" ).val());


	//console.log($('#productImage')[0].files[0]);

	/* Faz a leitura das entradas de dado para conferência.
	for (var pair of data.entries()) {
		console.log(pair[0]+ ', ' + pair[1]);
	}
	*/


	var request = $.ajax({
		url: link_redirect,
		method: "POST",
		data: data,
		dataType: "json",

		/* Upload Process */
		cache: false,
		processData: false,  // tell jQuery not to process the data
		contentType: false,   // tell jQuery not to set contentType


		beforeSend: function() {
			swal({
				title: 'Aguarde',
				text: 'Gravando seus dados',
				type: 'warning',
				showConfirmButton: false
			})
		},

		success: function(data){

			if ( typeof data['errors'] !== 'undefined' )
			{
				swal({
					title: 'Problema Encontrado',
					text: data['errors'],
					type: 'error'
				})
			} else {
				swal({
					title: 'Pronto!',
					text: 'Sua imagem foi incluida com sucesso. Sinta-se a vontade para incluir novas imagens',
					type: 'success',
					buttons: true,
				})
				.then((buttonClick) => {
					if (buttonClick) {
					  location.reload();
					}
				});

			}
		},

		error: function(data) {
			swal(
			  'Erro',
			  'Algum problema aconteceu, certifique-se de que a conexão com a internet esteja OK e que você esteja logado no sistema.',
			  'error'
			)
		}
	});

	//console.log(request);

}

function formClassificacaoItem(link_redirect)
{
	event.preventDefault();

	var data = new FormData();

	data.append ( "classificationName" , $('#classificationName').val());
	data.append ( "classificationActive" , $( "select#classificationActive option:checked" ).val());
	data.append ( "classificationDescription" , CKEDITOR.instances.editor1.getData());

	/* Faz a leitura das entradas de dado para conferência. */
	for (var pair of data.entries()) {
		console.log(pair[0]+ ', ' + pair[1]);
	}


	var request = $.ajax({
		url: link_redirect,
		method: "POST",
		data: data,
		dataType: "json",

		/* Upload Process */
		cache: false,
		processData: false,  // tell jQuery not to process the data
		contentType: false,   // tell jQuery not to set contentType


		beforeSend: function() {
			swal({
				title: 'Aguarde',
				text: 'Gravando seus dados',
				type: 'warning',
				showConfirmButton: false
			})
		},

		success: function(data){

			if ( typeof data['errors'] !== 'undefined' )
			{
				swal({
					title: 'Problema Encontrado',
					text: data['errors'],
					type: 'error'
				})
			} else {
				swal({
					title: 'Pronto!',
					text: 'Seu dado foi incluido com sucesso. Sinta-se a vontade para incluir novas categorias',
					type: 'success',
					buttons: true,
				})
				.then((buttonClick) => {
					if (buttonClick) {
					  location.reload();
					}
				});
			}
		},

		error: function(data) {
			swal(
			  'Erro',
			  'Algum problema aconteceu, certifique-se de que a conexão com a internet esteja OK e que você esteja logado no sistema.',
			  'error'
			)
		}
	});

	//console.log(request);

}

function formProduto (link_redirect)
{
	event.preventDefault();

	var data = new FormData();

	data.append ( "subCategoryId" , $( "select#subCategoryId option:checked" ).val());
	data.append ( "productName" , $('#productName').val());
	data.append ( "productNick" , $('#productNick').val());
	data.append ( "productDescription" , CKEDITOR.instances.editor1.getData());
	data.append ( "productKeyword" , $('#productKeyword').val() );
	data.append ( "productValue" , $('#productValue').val());
	data.append ( "productPromotionValue" , $('#productPromotionValue').val());
	data.append ( "productActive" , $( "select#productActive option:checked" ).val());
	data.append ( "productFeatured" , $( "select#productFeatured option:checked" ).val());
	data.append ( "productWeight" , $('#productWeight').val());
	data.append ( "productHeight" , $('#productHeight').val());
	data.append ( "productWidth" , $('#productWidth').val());
	data.append ( "productDepth" , $('#productDepth').val());
	data.append ( "productStorage" , $('#productStorage').val());

	/* Faz a leitura das entradas de dado para conferência. /
	for (var pair of data.entries()) {
		console.log(pair[0]+ ', ' + pair[1]);
	}
	*/

	var request = $.ajax({
		url: link_redirect,
		method: "POST",
		data: data,
		dataType: "json",

		/* Upload Process */
		cache: false,
		processData: false,  // tell jQuery not to process the data
		contentType: false,   // tell jQuery not to set contentType


		beforeSend: function() {
			swal({
				title: 'Aguarde',
				text: 'Gravando seus dados',
				type: 'warning',
				showConfirmButton: false
			})
		},

		success: function(data){

			if ( typeof data['errors'] !== 'undefined' )
			{
				swal({
					title: 'Problema Encontrado',
					text: data['errors'],
					type: 'error'
				})
			} else {
				swal({
					title: 'Pronto!',
					text: 'Seu dado foi incluido com sucesso. Sinta-se a vontade para incluir novas categorias',
					type: 'success',
					buttons: true,
				})
				.then((buttonClick) => {
					if (buttonClick) {
					  location.reload();
					}
				});
			}
		},

		error: function(data) {
			swal(
			  'Erro',
			  'Algum problema aconteceu, certifique-se de que a conexão com a internet esteja OK e que você esteja logado no sistema.',
			  'error'
			)
		}
	});

	//console.log(request);

}

function formProdutoItem(link_redirect)
{
	event.preventDefault();

	/* declare an checkbox array */
	var chkArray = [];

	/* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
	$(".itemName:checked").each(function() {
		chkArray.push($(this).val());
	});

	var data = new FormData();

	data.append ( "itemName" , JSON.stringify(chkArray));

	/* Faz a leitura das entradas de dado para conferência.
	for (var pair of data.entries()) {
		console.log(pair[0]+ ', ' + pair[1]);
	}*/


	var request = $.ajax({
		url: link_redirect,
		method: "POST",
		data: data,
		dataType: "json",

		/* Upload Process */
		cache: false,
		processData: false,  // tell jQuery not to process the data
		contentType: false,   // tell jQuery not to set contentType


		beforeSend: function() {
			swal({
				title: 'Aguarde',
				text: 'Gravando seus dados',
				type: 'warning',
				showConfirmButton: false
			})
		},

		success: function(data){

			if ( typeof data['errors'] !== 'undefined' )
			{
				swal({
					title: 'Problema Encontrado',
					text: data['errors'],
					type: 'error'
				})
			} else {
				swal({
					title: 'Pronto!',
					text: 'Seu dado foi incluido com sucesso. Sinta-se a vontade para incluir novas categorias',
					type: 'success',
					buttons: true,
				})
				.then((buttonClick) => {
					if (buttonClick) {
					  location.reload();
					}
				});
			}
		},

		error: function(data) {
			swal(
			  'Erro',
			  'Algum problema aconteceu, certifique-se de que a conexão com a internet esteja OK e que você esteja logado no sistema.',
			  'error'
			)
		}
	});

	//console.log(request);

}

function formItem(link_redirect)
{
	event.preventDefault();

	var data = new FormData();

	data.append ( "itemName" , $('#itemName').val());
	data.append ( "itemActive" , $( "select#itemActive option:checked" ).val());
	data.append ( "classificationId" , $( "select#classificationId option:checked" ).val());
	data.append ( "itemDescription" , CKEDITOR.instances.editor1.getData());

	/* Faz a leitura das entradas de dado para conferência.
	for (var pair of data.entries()) {
		console.log(pair[0]+ ', ' + pair[1]);
	}*/


	var request = $.ajax({
		url: link_redirect,
		method: "POST",
		data: data,
		dataType: "json",

		/* Upload Process */
		cache: false,
		processData: false,  // tell jQuery not to process the data
		contentType: false,   // tell jQuery not to set contentType


		beforeSend: function() {
			swal({
				title: 'Aguarde',
				text: 'Gravando seus dados',
				type: 'warning',
				showConfirmButton: false
			})
		},

		success: function(data){

			if ( typeof data['errors'] !== 'undefined' )
			{
				swal({
					title: 'Problema Encontrado',
					text: data['errors'],
					type: 'error'
				})
			} else {
				swal({
					title: 'Pronto!',
					text: 'Seu dado foi incluido com sucesso. Sinta-se a vontade para incluir novas categorias',
					type: 'success',
					buttons: true,
				})
				.then((buttonClick) => {
					if (buttonClick) {
					  location.reload();
					}
				});
			}
		},

		error: function(data) {
			swal(
			  'Erro',
			  'Algum problema aconteceu, certifique-se de que a conexão com a internet esteja OK e que você esteja logado no sistema.',
			  'error'
			)
		}
	});

	//console.log(request);

}

function formLogin(link_redirect)
{
	event.preventDefault();

	var data = new FormData();

	data.append ( "loginName" , $('#loginName').val());
	data.append ( "loginSenha" , $('#loginSenha').val());
	data.append ( "loginSenha2" , $('#loginSenha2').val());
	data.append ( "loginActive" , $( "select#loginActive option:checked" ).val());
	//data.append ( "loginPermission" , CKEDITOR.instances.editor1.getData());

	/* Faz a leitura das entradas de dado para conferência. /
	for (var pair of data.entries()) {
		console.log(pair[0]+ ', ' + pair[1]);
	}
	*/

	var request = $.ajax({
		url: link_redirect,
		method: "POST",
		data: data,
		dataType: "json",

		/* Upload Process */
		cache: false,
		processData: false,  // tell jQuery not to process the data
		contentType: false,   // tell jQuery not to set contentType


		beforeSend: function() {
			swal({
				title: 'Aguarde',
				text: 'Gravando seus dados',
				type: 'warning',
				showConfirmButton: false
			})
		},

		success: function(data){

			if ( typeof data['errors'] !== 'undefined' )
			{
				swal({
					title: 'Problema Encontrado',
					text: data['errors'],
					type: 'error'
				})
			} else {
				swal({
					title: 'Pronto!',
					text: 'Seu dado foi incluido com sucesso. Sinta-se a vontade para incluir novos logins',
					type: 'success',
					buttons: true,
				})
				.then((buttonClick) => {
					if (buttonClick) {
					  location.reload();
					}
				});
			}
		},

		error: function(data) {
			swal(
			  'Erro',
			  'Algum problema aconteceu, certifique-se de que a conexão com a internet esteja OK e que você esteja logado no sistema.',
			  'error'
			)
		}
	});

	//console.log(request);

}

function formStatus(link_redirect)
{
	event.preventDefault();

	var data = new FormData();

	data.append ( "statusName" , $('#statusName').val());
	data.append ( "statusAvailable" , $( "select#statusAvailable option:checked" ).val());
	data.append ( "statusServiceOrder" , $( "select#statusServiceOrder option:checked" ).val());
	data.append ( "statusOrder" , $( "select#statusOrder option:checked" ).val());
	//data.append ( "loginPermission" , CKEDITOR.instances.editor1.getData());

	/* Faz a leitura das entradas de dado para conferência. /
	for (var pair of data.entries()) {
		console.log(pair[0]+ ', ' + pair[1]);
	}
	*/

	var request = $.ajax({
		url: link_redirect,
		method: "POST",
		data: data,
		dataType: "json",

		/* Upload Process */
		cache: false,
		processData: false,  // tell jQuery not to process the data
		contentType: false,   // tell jQuery not to set contentType


		beforeSend: function() {
			swal({
				title: 'Aguarde',
				text: 'Gravando seus dados',
				type: 'warning',
				showConfirmButton: false
			})
		},

		success: function(data){

			if ( typeof data['errors'] !== 'undefined' )
			{
				swal({
					title: 'Problema Encontrado',
					text: data['errors'],
					type: 'error'
				})
			} else {
				swal({
					title: 'Pronto!',
					text: 'Seu dado foi incluido com sucesso. Sinta-se a vontade para incluir novos logins',
					type: 'success',
					buttons: true,
				})
				.then((buttonClick) => {
					if (buttonClick) {
					  location.reload();
					}
				});
			}
		},

		error: function(data) {
			swal(
			  'Erro',
			  'Algum problema aconteceu, certifique-se de que a conexão com a internet esteja OK e que você esteja logado no sistema.',
			  'error'
			)
		}
	});

	//console.log(request);

}

function formService(link_redirect)
{
	event.preventDefault();

	var data = new FormData();

	data.append ( "serviceName" , $('#serviceName').val());
	data.append ( "serviceNickName" , $('#serviceNickName').val());
	data.append ( "serviceActive" , $( "select#serviceActive option:checked" ).val());
	data.append ( "servicePrice" , $('#servicePrice').val());
	data.append ( "serviceDescription" , CKEDITOR.instances.editor1.getData());

	/* Faz a leitura das entradas de dado para conferência. /
	for (var pair of data.entries()) {
		console.log(pair[0]+ ', ' + pair[1]);
	}
	*/

	var request = $.ajax({
		url: link_redirect,
		method: "POST",
		data: data,
		dataType: "json",

		/* Upload Process */
		cache: false,
		processData: false,  // tell jQuery not to process the data
		contentType: false,   // tell jQuery not to set contentType


		beforeSend: function() {
			swal({
				title: 'Aguarde',
				text: 'Gravando seus dados',
				type: 'warning',
				showConfirmButton: false
			})
		},

		success: function(data){

			if ( typeof data['errors'] !== 'undefined' )
			{
				swal({
					title: 'Problema Encontrado',
					text: data['errors'],
					type: 'error'
				})
			} else {
				swal({
					title: 'Pronto!',
					text: 'Seu dado foi incluido com sucesso. Sinta-se a vontade para incluir novos logins',
					type: 'success',
					buttons: true,
				})
				.then((buttonClick) => {
					if (buttonClick) {
					  location.reload();
					}
				});
			}
		},

		error: function(data) {
			swal(
			  'Erro',
			  'Algum problema aconteceu, certifique-se de que a conexão com a internet esteja OK e que você esteja logado no sistema.',
			  'error'
			)
		}
	});

	//console.log(request);

}

function addService()
{
	event.preventDefault();

	var textoHtml = "";
	var serviceId =  $( "select#serviceId option:checked" ).val();
	var serviceName =  $( "select#serviceId option:checked" ).text();
	var servicePrice = $('#servicePrice2').val();
	var serviceDiscount = $('#serviceDiscount2').val();
	var serviceFinalPrice = $('#serviceFinalPrice2').val();

	if ( serviceId != 'undefined' || serviceId != "" || servicePrice != 'undefined' || servicePrice != "" ) {
		textHtml = " <div class='row'> <div class='col-md-12'> <div class='form-group'> <label>Valor do Serviço:</label> <input type='text' value='"+serviceName+"' class='form-control' id='servicePrice[]' disabled> </div> </div> ";
		textHtml += " <input type='hidden' value='"+serviceId+"' class='form-control' id='servicePrice[]' disabled></input>";
		textHtml += "<div class='col-md-6'> <div class='form-group'> <label>Valor do Serviço:</label> <input type='text' value='"+servicePrice+"' class='form-control' id='servicePrice[]' > </div> </div>";
		textHtml += "<div class='col-md-6'> <div class='form-group'> <label>Valor do Desconto:</label> <input type='text' value='"+serviceDiscount+"' class='form-control' id='servicePrice[]' > </div> </div>";
		textHtml += "<div class='col-md-12'> <div class='form-group'> <label>Valor Final do Serviço:</label> <input type='text' value='"+serviceFinalPrice+"' class='form-control' id='servicePrice[]' > </div> </div> </div>";
	} else {
		swal({
			title: 'Problema Encontrado',
			text: "Você não selecionou um serviço ou digitou um preço!",
			type: 'error'
		})
	}

	document.getElementById('chosenServices').innerHTML += textHtml;
}
