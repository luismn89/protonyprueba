jQuery(document).ready(function($) {
	var current_page = $(location).attr('href'),
		is_moving = true,
		json_products = {
			current : {},
			next : {},
			previous : {}
		};

	$(window).scroll(function(event) {
		if ($(this).scrollTop() > 1) {
			$('#undefined-sticky-wrapper > nav').css('position', 'static');
		}
	});

// Gender selection code default
	if (current_page == window.location.origin + '/'){
	// if (current_page == window.location.origin + '/protony-website/'){
		var $id_gender = $('.options div:first-child #btn-gender-female');
		$id_gender.parent('.gender').data('check', 'btn-gender-female');

		$id_gender.css('position', 'relative');
		$id_gender.append('<span class="icon-check-hover icon-check-alt"></span>');
		$id_gender.children('.icon-check-hover').css({
			color : '#F5989D',
			right : '-5px',
			top : '-21px'
		});
	}

// Code click event for gender options
	$('.options div:first-child a').on('click', function(event){
		event.preventDefault();
		var $parent = $(this).parent('.gender'),
			data_check = $parent.data('check'),
			id_btn = $(this)[0].id,
			param = {
				activity : 'change_gender',
				id_gender : $(this).data('idterm'),
				code_ref_current : json_products.current.gender_ref,
				code_ref_previous : json_products.previous.gender_ref,
				code_ref_next : json_products.next.gender_ref
			};
		if (data_check != id_btn){
			showLoading();
			is_moving = true;
			$(this).css('position', 'relative');
			$(this).append('<span class="icon-check-hover icon-check-alt"></span>');
			$.post(current_page + 'wp-content/themes/childrootstrap/slider.php', param)
				.done(changeProductGender);
			if (id_btn == 'btn-gender-female'){
				$(this).children('.icon-check-hover').css({
					color : '#F5989D',
					right : '-5px',
					top : '-21px'
				});
			} else if (id_btn == 'btn-gender-male') {
				$(this).children('.icon-check-hover').css({
					color : '#3F7CFA',
					right : '-9px',
					top : '-22px'
				});
			}
			$('.gender').data('check', id_btn);
			id_btn = "#" + data_check;
			$parent.children(id_btn).children('.icon-check-hover').remove();
		}
	});

// Code mouseenter and mouseleave event for hover gender options
	$('.btn-gender-female')
		.on('mouseenter', function(){
			$(this).css('position', 'relative');
			$(this).append('<span class="icon-check-hover icon-check-alt"></span>');
			$(this).children('.icon-check-hover').css('color', '#F5989D');
		})
		.on('mouseleave', function(){
			$(this).children('.icon-check-hover').remove();
		});
	$('.btn-gender-male')
		.on('mouseenter', function(){
			$(this).css('position', 'relative');
			$(this).append('<span class="icon-check-hover icon-check-alt"></span>');
			$(this).children('.icon-check-hover').css('color', '#3F7CFA');
		})
		.on('mouseleave', function(){
			$(this).children('.icon-check-hover').remove();
		});

// Code for buttons quantity options
	$('.options div:nth-child(2) a').on('click', function(event){
		event.preventDefault();
		changeQuantity($(this));
	});

// Code for buttons size options
	$('.options div:nth-child(3) a').on('click', function(event){
		event.preventDefault();
		changeSize($(this));
	});

// Code submit event for form suscription
	$('#form-suscription').on('submit', function(event){
		event.preventDefault();
		var email_suscriptor = $('#email-suscription').val();

		if (email_suscriptor){
			$.ajax({
				url: $(location).attr('href') + 'wp-content/themes/childrootstrap/sendMail.php',
				type: 'POST',
				dataType: 'json',
				data: {email_suscriptor: email_suscriptor},
				success: function (response){
					showMsj(response.msj, response.status_send, $('#text-msj'));
				},
				error: function(msj){
					console.log(msj);
				}
			});
		} else {
			showMsj('Error! Please enter a valid email', 'error', $('#text-msj'));
		}
	});

// Code for buttons slide options
	if (current_page == window.location.origin + '/'){
	// if (current_page == window.location.origin + '/protony-website/'){
		var promise_rPhp = $.post(current_page + 'wp-content/themes/childrootstrap/slider.php', {activity: 'initial_load'}),
			// promise_ProdPrintful = $.get('https://api.theprintful.com/products');
			promise_ProdPrintful = $.ajax({
				url: 'https://api.theprintful.com/products',
				type: 'GET',
				dataType: 'json',
				beforeSend: function(xhr){
					xhr.setRequestHeader('Authorization', 'Basic 68xky5q8-knl6-is4z:etd4-jduf6nsoxsww');
					xhr.setRequestHeader('Access-Control-Allow-Origin', '*');
				}
			});
		showLoading();
		$.when(promise_rPhp, promise_ProdPrintful).done(loadProducts)
			.fail(function (msj){
				console.log(msj);
			});

	}

	$('.slider a').on('click', function(event){
		event.preventDefault();
		var id_btn = $(this)[0].className,
			$list_img = $('.slider div ul'),
			$slides = $list_img.children(),
			increment = $slides.outerWidth(true);
		if (!is_moving){
			is_moving = true;
			if (id_btn == 'icon-chevron-thin-left'){
				var param = {
						activity : 'move-left',
						id_current : json_products.previous.id,
						last_register : json_products.last,
						first_register : json_products.first,
						id_gender : $('#' + $('.gender').data('check')).data('idterm')
					},
					promise_rPhp = $.post(current_page + 'wp-content/themes/childrootstrap/slider.php', param),
					promise_ProdPrintful = $.get('https://api.theprintful.com/products');
				$.when(promise_rPhp, promise_ProdPrintful).done(addPrev);
				$list_img.animate({left: '+=' + increment}, 1500, 'swing');
				json_products.next = JSON.parse(JSON.stringify(json_products.current));
				json_products.current = JSON.parse(JSON.stringify(json_products.previous));
				$('.price').text(json_products.previous.price + '$');
				$('.options .size span').text(json_products.previous.size_variants.array_size[0]);
				$list_img.children(':nth-child(2)').removeClass('select');
				$list_img.children(':nth-child(1)').addClass('select');
				showLoading();
				$list_img.css({left: -increment});
			}
			if (id_btn == 'icon-chevron-thin-right'){
				var param = {
						activity : 'move-right',
						id_current : json_products.next.id,
						last_register : json_products.last,
						first_register : json_products.first,
						id_gender : $('#' + $('.gender').data('check')).data('idterm')
					},
					promise_rPhp = $.post(current_page + 'wp-content/themes/childrootstrap/slider.php', param),
					promise_ProdPrintful = $.get('https://api.theprintful.com/products');
				$.when(promise_rPhp, promise_ProdPrintful).done(addNext);
				$list_img.animate({	left: '-=' + increment }, 1500, 'swing');
				json_products.previous = JSON.parse(JSON.stringify(json_products.current));
				json_products.current = JSON.parse(JSON.stringify(json_products.next));
				$('.price').text(json_products.next.price + '$');
				$('.options .size span').text(json_products.next.size_variants.array_size[0]);
				$list_img.children(':nth-child(2)').removeClass('select');
				$list_img.children(':nth-child(3)').addClass('select');
				showLoading();
				$list_img.css({left: -increment});
			}
		}
	});

// Code for button Get It
	$('.sec-button button').on('click', showProductGetIt);

// Functions javascript
	function loadProducts(data_db, data_api_product){
		// console.log(data_api_product);
		if (data_db[1] == 'success'){
			var $list_img = $('.slider div ul');
			$list_img.append('<li class=""><img src="' + current_page + 'wp-content/uploads/' + data_db[0].product_previous.img_product + '"></li>');
			$list_img.append('<li class="select"><img src="' + current_page + 'wp-content/uploads/' + data_db[0].product_current.img_product + '"></li>');
			$list_img.append('<li class=""><img src="' + current_page + 'wp-content/uploads/' + data_db[0].product_next.img_product + '"></li>');
			var increment = $list_img.children().outerWidth(true);
			$list_img.css({left: -increment});
			$('.price').text(data_db[0].product_current.price + '$');

			json_products.first = data_db[0].product_current.id;
			json_products.last = data_db[0].product_previous.id;

			loadJsonProduct('id', data_db[0].product_current.id, data_db[0].product_next.id, data_db[0].product_previous.id);
			loadJsonProduct('price', data_db[0].product_current.price, data_db[0].product_next.price, data_db[0].product_previous.price);
			loadJsonProduct('gender_ref', data_db[0].product_current.reference, data_db[0].product_next.reference, data_db[0].product_previous.reference);
			loadJsonProduct('catalog_code', data_db[0].catalog_current.code, data_db[0].catalog_next.code, data_db[0].catalog_previous.code);
			loadJsonProduct('img_design', data_db[0].product_current.img_design, data_db[0].product_next.img_design, data_db[0].product_previous.img_design);
		}
		if (data_api_product[1] == 'success' && data_api_product[0].code == 200){
			var id_prod_current, id_prod_next, id_prod_previous,
				promise_variant_current, promise_variant_next, promise_variant_previous,
				obj = {};
			if (data_db[0].catalog_current.code == data_db[0].catalog_next.code && data_db[0].catalog_current.code == data_db[0].catalog_previous.code){
				id_prod_current = getIdProductCatalog(data_db[0].catalog_current.code, data_db[0].catalog_current.type, data_api_product[0].result);
				loadJsonProduct('id_product_catalog', id_prod_current, id_prod_current, id_prod_current);
				promise_variant_current = $.get('https://api.theprintful.com/products/' + id_prod_current);
				obj.current = {color: data_db[0].catalog_current.color.charAt(0).toUpperCase() + data_db[0].catalog_current.color.slice(1), param: 1};
				obj.next = {color: data_db[0].catalog_next.color.charAt(0).toUpperCase() + data_db[0].catalog_next.color.slice(1), param: 1};
				obj.previous = {color: data_db[0].catalog_previous.color.charAt(0).toUpperCase() + data_db[0].catalog_previous.color.slice(1), param: 1};
				promise_variant_current.done(function (data){ saveVariants(data, null, null, obj); });
			} else if (data_db[0].catalog_current.code == data_db[0].catalog_next.code && data_db[0].catalog_current.code != data_db[0].catalog_previous.code) {
				id_prod_current = getIdProductCatalog(data_db[0].catalog_current.code, data_db[0].catalog_current.type, data_api_product[0].result);
				id_prod_previous = getIdProductCatalog(data_db[0].catalog_previous.code, data_db[0].catalog_previous.type, data_api_product[0].result);
				loadJsonProduct('id_product_catalog', id_prod_current, id_prod_current, id_prod_previous);
				promise_variant_current = $.get('https://api.theprintful.com/products/' + id_prod_current);
				promise_variant_previous = $.get('https://api.theprintful.com/products/' + id_prod_previous);
				obj.current = {color: data_db[0].catalog_current.color.charAt(0).toUpperCase() + data_db[0].catalog_current.color.slice(1), param: 1};
				obj.next = {color: data_db[0].catalog_next.color.charAt(0).toUpperCase() + data_db[0].catalog_next.color.slice(1), param: 1};
				obj.previous = {color: data_db[0].catalog_previous.color.charAt(0).toUpperCase() + data_db[0].catalog_previous.color.slice(1), param: 2};
				$.when(promise_variant_current, promise_variant_previous).done(function (data_current, data_previous){ saveVariants(data_current, data_previous, null, obj); });
			} else if (data_db[0].catalog_current.code != data_db[0].catalog_next.code && data_db[0].catalog_current.code == data_db[0].catalog_previous.code) {
				id_prod_current = getIdProductCatalog(data_db[0].catalog_current.code, data_db[0].catalog_current.type, data_api_product[0].result);
				id_prod_next = getIdProductCatalog(data_db[0].catalog_next.code, data_db[0].catalog_next.type, data_api_product[0].result);
				loadJsonProduct('id_product_catalog', id_prod_current, id_prod_next, id_prod_current);
				promise_variant_current = $.get('https://api.theprintful.com/products/' + id_prod_current);
				promise_variant_next = $.get('https://api.theprintful.com/products/' + id_prod_next);
				obj.current = {color: data_db[0].catalog_current.color.charAt(0).toUpperCase() + data_db[0].catalog_current.color.slice(1), param: 1};
				obj.next = {color: data_db[0].catalog_next.color.charAt(0).toUpperCase() + data_db[0].catalog_next.color.slice(1), param: 2};
				obj.previous = {color: data_db[0].catalog_previous.color.charAt(0).toUpperCase() + data_db[0].catalog_previous.color.slice(1), param: 1};
				$.when(promise_variant_current, promise_variant_next).done(function (data_current, data_next){ saveVariants(data_current, data_next, null, obj); });
			} else if (id_prod_current != id_prod_next && id_prod_next == id_prod_previous) {
				id_prod_current = getIdProductCatalog(data_db[0].catalog_current.code, data_db[0].catalog_current.type, data_api_product[0].result);
				id_prod_next = getIdProductCatalog(data_db[0].catalog_next.code, data_db[0].catalog_next.type, data_api_product[0].result);
				loadJsonProduct('id_product_catalog', id_prod_current, id_prod_next, id_prod_next);
				promise_variant_current = $.get('https://api.theprintful.com/products/' + id_prod_current);
				promise_variant_next = $.get('https://api.theprintful.com/products/' + id_prod_next);
				obj.current = {color: data_db.catalog_current.color.charAt(0).toUpperCase() + data_db.catalog_current.color.slice(1), param: 1};
				obj.next = {color: data_db.catalog_next.color.charAt(0).toUpperCase() + data_db.catalog_next.color.slice(1), param: 2};
				obj.previous = {color: data_db.catalog_previous.color.charAt(0).toUpperCase() + data_db.catalog_previous.color.slice(1), param: 2};
				$.when(promise_variant_current, promise_variant_next).done(function (data_current, data_next){ saveVariants(data_current, data_next, null, obj); });
			} else {
				id_prod_current = getIdProductCatalog(data_db[0].catalog_current.code, data_db[0].catalog_current.type, data_api_product[0].result);
				id_prod_next = getIdProductCatalog(data_db[0].catalog_next.code, data_db[0].catalog_next.type, data_api_product[0].result);
				id_prod_previous = getIdProductCatalog(data_db[0].catalog_previous.code, data_db[0].catalog_previous.type, data_api_product[0].result);
				loadJsonProduct('id_product_catalog', id_prod_current, id_prod_next, id_prod_previous);
				promise_variant_current = $.get('https://api.theprintful.com/products/' + id_prod_current);
				promise_variant_next = $.get('https://api.theprintful.com/products/' + id_prod_next);
				promise_variant_previous = $.get('https://api.theprintful.com/products/' + id_prod_previous);
				obj.current = {color: data_db[0].catalog_current.color.charAt(0).toUpperCase() + data_db[0].catalog_current.color.slice(1), param: 1};
				obj.next = {color: data_db[0].catalog_next.color.charAt(0).toUpperCase() + data_db[0].catalog_next.color.slice(1), param: 2};
				obj.previous = {color: data_db[0].catalog_previous.color.charAt(0).toUpperCase() + data_db[0].catalog_previous.color.slice(1), param: 3};
				$.when(promise_variant_current, promise_variant_next, promise_variant_previous).done(function (data_current, data_next, data_previous){ saveVariants(data_current, data_next, data_previous, obj); });
			}
		}
	}

	function saveVariants(data_prom_one, data_prom_two, data_prom_three, obj){
		var size_variant_cu, size_variant_ne, size_variant_prev;
		if (data_prom_one.code == 200){
			size_variant_cu = getArraySizeId(obj.current.color, data_prom_one.result.variants);
			if (obj.next.param == 1){
				size_variant_ne = (obj.next.color == obj.current.color) ? size_variant_cu : getArraySizeId(obj.next.color, data_prom_one.result.variants);
			}
			if (obj.previous.param == 1){
				if (obj.previous.color == obj.current.color){
					size_variant_prev = size_variant_cu;
				} else if (obj.next.param == 1 && obj.previous.color == obj.next.color){
					size_variant_prev = size_variant_ne;
				} else {
					size_variant_prev = getArraySizeId(obj.previous.color, data_prom_one.result.variants);
				}
			}
		}
		if (data_prom_two !== null && data_prom_two.code == 200){
			if (obj.next.param == 2){
				size_variant_ne = getArraySizeId(obj.next.color, data_prom_two.result.variants);
			}
			if (obj.previous.param == 2){
				if (obj.next.param == 2 && obj.next.color == obj.previous.color){
					size_variant_prev = size_variant_ne;
				} else {
					size_variant_prev = getArraySizeId(obj.previous.color, data_prom_two.result.variants);
				}
			}
		}
		if (data_prom_three !== null && data_prom_three.code == 200){
			if (obj.previous.param == 3){
				size_variant_prev = getArraySizeId(obj.previous.color, data_prom_three.result.variants);
			}
		}
		loadJsonProduct('size_variants', size_variant_cu, size_variant_ne, size_variant_prev);
		$('.options .size span').text(size_variant_cu.array_size[0]);
		is_moving = false;
		hideLoading();
	}

	function saveVariant(data_prom, color, obj){
		var size_variants;
		if (data_prom.code == 200){
			size_variants = getArraySizeId(color, data_prom.result.variants);
		}
		obj.size_variants = size_variants;
	}

	function getArraySizeId(color, variants){
		var arrays = {array_size: [], array_id_variant: []};
		for (var i = 0; i < variants.length; i++){
			if (variants[i].color == color){
				arrays.array_size.push(variants[i].size);
				arrays.array_id_variant.push(variants[i].id);
			}
		}
		return arrays;
	}

	function getIdProductCatalog(code_ref, type, catalog){
		var id_product;
		for (var i = 0; i < catalog.length; i++){
			if (catalog[i].model.indexOf(code_ref) != -1 && catalog[i].type == type.toUpperCase()){
				id_product = catalog[i].id;
			}
		}
		return id_product;
	}

	function loadJsonProduct(item, product_current, product_next, product_previous){
		if (item == 'gender_ref'){
			json_products.current[item] = (product_current.indexOf('_') != -1) ? product_current.split('_')[0] : product_current;
			json_products.next[item] = (product_next.indexOf('_') != -1) ? product_next.split('_')[0] : product_next;
			json_products.previous[item] = (product_previous.indexOf('_') != -1) ? product_previous.split('_')[0] : product_previous;
		} else {
			json_products.current[item] = product_current;
			json_products.next[item] = product_next;
			json_products.previous[item] = product_previous;
		}
	}

	function changeProductGender(data_db){
		$('.slider div ul li.select img').attr('src', current_page + 'wp-content/uploads/' + data_db.product_current.img_product);
		$('.price').text(data_db.product_current.price + '$');
		$('.slider div ul li:nth-child(1) img').attr('src', current_page + 'wp-content/uploads/' + data_db.product_previous.img_product);
		$('.slider div ul li:nth-child(3) img').attr('src', current_page + 'wp-content/uploads/' + data_db.product_next.img_product);
		loadJsonProduct('id', data_db.product_current.id, data_db.product_next.id, data_db.product_previous.id);
		loadJsonProduct('price', data_db.product_current.price, data_db.product_next.price, data_db.product_previous.price);
		loadJsonProduct('img_design', data_db.product_current.img_design, data_db.product_next.img_design, data_db.product_previous.img_design);
		json_products.first = data_db.first_id;
		json_products.last = data_db.last_id;
		is_moving = false;
		hideLoading();
	}

	function addNext(data_db, data_api_product){
		if (data_db[1] == 'success'){
			json_products.next.id = data_db[0].new_product.id;
			json_products.next.price = data_db[0].new_product.price;
			json_products.next.gender_ref = data_db[0].new_product.reference.split('_')[0];
			json_products.next.img_design = data_db[0].new_product.img_design;

			if (data_api_product[1] == 'success' && data_api_product[0].code == 200){
				var id_prod_cat;
				if (data_db[0].new_catalog.code == json_products.current.catalog_code){
					id_prod_cat = json_products.current.id_product_catalog;
				} else if (data_db[0].catalog_code.code == json_products.previous.catalog_code){
					id_prod_cat = json_products.previous.id_product_catalog	;
				} else {
					id_prod_cat = getIdProductCatalog(data_db[0].new_catalog.code, data_db[0].new_catalog.type, data_api_product[0].result);
				}
				var promise_variant = $.get('https://api.theprintful.com/products/' + id_prod_cat);
				json_products.next.id_product_catalog = id_prod_cat;
				promise_variant.done(function (data_prom){ saveVariant(data_prom, data_db[0].new_catalog.color, json_products.next); });
			}

			var $list_img = $('.slider div ul');
			$list_img.children(':first-child').remove();
			$list_img.append('<li class=""><img src="' + current_page + 'wp-content/uploads/' + data_db[0].new_product.img_product + '"></li>');
			$list_img.css({left: -($list_img.children().outerWidth(true))});
			hideLoading();
			is_moving = false;
		}
	}

	function addPrev(data_db, data_api_product){
		if (data_db[1] == 'success'){
			var $list_img = $('.slider div ul');
			$list_img.children(':last-child').remove();
			$list_img.prepend('<li class=""><img src="' + current_page + 'wp-content/uploads/' + data_db[0].new_product.img_product + '"></li>');
			$list_img.css({left: -($list_img.children().outerWidth(true))});

			json_products.previous.id = data_db[0].new_product.id;
			json_products.previous.price = data_db[0].new_product.price;
			json_products.previous.gender_ref = data_db[0].new_product.reference.split('_')[0];
			json_products.previous.img_design = data_db[0].new_product.img_design;

			if (data_api_product[1] == 'success' && data_api_product[0].code == 200){
				var id_prod_cat;
				if (data_db[0].new_catalog.code == json_products.current.catalog_code){
					id_prod_cat = json_products.current.id_product_catalog;
				} else if (data[0].new_catalog.code == json_products.next.catalog_code){
					id_prod_cat = json_products.next.id_product_catalog;
				} else {
					id_prod_cat = getIdProductCatalog(data_db[0].new_catalog.code, data_db[0].new_catalog.type, data_api_product[0].result);
				}
				var promise_variant = $.get('https://api.theprintful.com/products/' + id_prod_cat);
				json_products.previous.id_product_catalog = id_prod_cat;
				promise_variant.done(function (data_prom){ saveVariant(data_prom, data_db[0].new_catalog.color, json_products.previous); });
			}

			hideLoading();
			is_moving = false;
			$list_img.css({left: -($list_img.children().outerWidth(true))});
		}
	}

	// Function to display an error message or confirmation
	function showMsj(msj, status, $obj){
		$obj.html(msj);
		if (status == 'ok'){
			$obj.addClass('class-text-ok').show();
		} else {
			$obj.addClass('class-text-error').show();
		}
	}

	function showLoading(){
		$('.loading').show();
		if ($('.mode-mobile').is(':visible')){
			$('.sec-button button').prop('disabled', true);
		}
	}

	function hideLoading(){
		if ($('.mode-mobile').is(':visible')){
			$('.sec-button button').prop('disabled', false);
		}
		$('.loading').hide();
	}

	function showProductGetIt(){
		console.log(json_products.current);
		console.log($('.estruct-xs .quantity .text-option').text());

		var sizes = json_products.current.size_variants.array_size,
			ids_variants = json_products.current.size_variants.array_id_variant,
			pos = $.inArray($('.estruct-xs .size .text-option').text(), sizes);

		console.log($('.estruct-xs .size .text-option').text());
		console.log(ids_variants[pos]);

		$(location).attr('href', current_page + 'shipping/');
	}

	// Function to change size options
	function changeSize($btn){
		var $parent = $btn.parent('.size');
			options = json_products.current.size_variants.array_size,
			ids_options = json_products.current.size_variants.array_id_variant,
			$size_sel = $parent.children('.text-option'),
			pos_option = $.inArray($size_sel.text(), options);

		if ($btn.hasClass('btn-left')){
			if (pos_option > 0){
				$('.size .text-option').text(options[parseInt(pos_option) - 1]);
			}
		} else {
			if (pos_option < (options.length - 1)){
				$('.size .text-option').text(options[parseInt(pos_option) + 1]);
			}
		}
	}

	// Function to change quantity options
	function changeQuantity($obj){
		var $parent = $obj.parent('.quantity'),
			max = 100,
			min = 1;
			$quantity_sel = $parent.children('.text-option');

		if($obj.hasClass('btn-minus')){
			if($quantity_sel.text() > min){
				$('.quantity .text-option').text($quantity_sel.text() - 1);
			}
		} else {
			if($quantity_sel.text() < max){
				$('.quantity .text-option').text(parseInt($quantity_sel.text()) + 1);
			}
		}
	}
});