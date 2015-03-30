<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php' );
	// include_once($_SERVER['DOCUMENT_ROOT'].'/protony-website/wp-load.php' );

	$jsondata = array();
	global $wpdb;

	if ( isset($_POST['activity']) ) {
		if ($_POST['activity'] == 'initial_load'){
			// $query_first_postsids = "SELECT object_id FROM prot_term_relationships P INNER JOIN prot_terms T
			$query_first_postsids = "SELECT object_id FROM o5ok_term_relationships P INNER JOIN o5ok_terms T
									WHERE T.slug = 'female' AND P.term_taxonomy_id = T.term_id ORDER BY object_id DESC LIMIT 2";
			$first_postsids = $wpdb->get_results($query_first_postsids);
			// $query_last_postid = "SELECT object_id FROM prot_term_relationships P INNER JOIN prot_terms T
			$query_last_postid = "SELECT object_id FROM o5ok_term_relationships P INNER JOIN o5ok_terms T
								WHERE T.slug = 'female' AND P.term_taxonomy_id = T.term_id ORDER BY object_id ASC LIMIT 1";
			$last_postid = $wpdb->get_results($query_last_postid);

			$jsondata['catalog_current'] = getCatalog($first_postsids[0]->object_id);
			$jsondata['catalog_previous'] = getCatalog($last_postid[0]->object_id);
			$jsondata['catalog_next'] = getCatalog($first_postsids[1]->object_id);
			$jsondata['product_current'] = getProduct($first_postsids[0]->object_id);
			$jsondata['product_previous'] = getProduct($last_postid[0]->object_id);
			$jsondata['product_next'] = getProduct($first_postsids[1]->object_id);
		}
		if ($_POST['activity'] == 'change_gender'){
			if ( isset($_POST['id_gender']) && isset($_POST['code_ref_current']) && isset($_POST['code_ref_previous']) && isset($_POST['code_ref_next']) ){
				$id_gender = $_POST['id_gender'];
				$postid_cu = $wpdb->get_results(getIdGender($_POST['code_ref_current'], $id_gender));
				$postid_ne = $wpdb->get_results(getIdGender($_POST['code_ref_next'], $id_gender));
				$postid_prev = $wpdb->get_results(getIdGender($_POST['code_ref_previous'], $id_gender));
				$jsondata['product_current'] = getProduct( $postid_cu[0]->object_id );
				$jsondata['product_next'] = getProduct( $postid_ne[0]->object_id );
				$jsondata['product_previous'] = getProduct( $postid_prev[0]->object_id );

				// $query_first_postid = "SELECT object_id FROM prot_term_relationships
				$query_first_postid = "SELECT object_id FROM o5ok_term_relationships
										WHERE term_taxonomy_id = $id_gender ORDER BY object_id DESC LIMIT 1";
				$first_postid = $wpdb->get_results($query_first_postid);
				$jsondata['first_id'] = $first_postid[0]->object_id;
				// $query_last_postid = "SELECT object_id FROM prot_term_relationships
				$query_last_postid = "SELECT object_id FROM o5ok_term_relationships
									  WHERE term_taxonomy_id = $id_gender ORDER BY object_id ASC LIMIT 1";
				$last_postid = $wpdb->get_results($query_last_postid);
				$jsondata['last_id'] = $last_postid[0]->object_id;
			}
		}
		if ($_POST['activity'] == 'move-left'){
			if ( isset($_POST['id_current']) && isset($_POST['last_register']) && isset($_POST['first_register']) && isset($_POST['id_gender']) ){
				if ($_POST['id_current'] == $_POST['first_register']){
					$jsondata['new_catalog'] = getCatalog($_POST['last_register']);
					$jsondata['new_product'] = getProduct($_POST['last_register']);
				} else {
					$id_current = $_POST['id_current'];
					$id_gender = $_POST['id_gender'];
					// $query_prev = "SELECT object_id FROM prot_term_relationships
					$query_prev = "SELECT object_id FROM o5ok_term_relationships
								   WHERE term_taxonomy_id = $id_gender AND object_id > $id_current
								   ORDER BY object_id ASC LIMIT 1";
					$prev_postid = $wpdb->get_results($query_prev);
					$jsondata['new_catalog'] = getCatalog($prev_postid[0]->object_id);
					$jsondata['new_product'] = getProduct($prev_postid[0]->object_id);
				}
			}
		}
		if ($_POST['activity'] == 'move-right'){
			if ( isset($_POST['id_current']) && isset($_POST['last_register']) && isset($_POST['first_register']) && isset($_POST['id_gender']) ){
				if ($_POST['id_current'] == $_POST['last_register']){
					$jsondata['new_catalog'] = getCatalog($_POST['first_register']);
					$jsondata['new_product'] = getProduct($_POST['first_register']);
				} else {
					$id_current = $_POST['id_current'];
					$id_gender = $_POST['id_gender'];
					// $query_next = "SELECT object_id FROM prot_term_relationships
					$query_next = "SELECT object_id FROM o5ok_term_relationships
								   WHERE term_taxonomy_id = $id_gender AND object_id < $id_current
								   ORDER BY object_id DESC LIMIT 1";
					$next_postid = $wpdb->get_results($query_next);
					$jsondata['new_catalog'] = getCatalog($next_postid[0]->object_id);
					$jsondata['new_product'] = getProduct($next_postid[0]->object_id);
				}
			}
		}
	}
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($jsondata);
	exit();

	function getIdGender($code_ref, $id_gender){
		// $query_postid_gender = "SELECT object_id FROM prot_term_relationships
		$query_postid_gender = "SELECT object_id FROM o5ok_term_relationships
							  	WHERE object_id IN
							  	(SELECT post_id FROM o5ok_postmeta
							  	-- (SELECT post_id FROM prot_postmeta
								WHERE meta_key = '_sku'
								AND meta_value LIKE '".$code_ref."%')
								AND term_taxonomy_id = $id_gender";
		return $query_postid_gender;
	}

	function getProduct( $id_product ){
		$data_product = array(
				'id' => $id_product,
				'reference' => get_post_meta($id_product, '_sku')[0],
				'price' => get_post_meta($id_product, '_price')[0],
				'img_product' => get_post_meta(get_post_meta($id_product, '_product_image_gallery')[0], '_wp_attached_file')[0],
				'img_design' => get_post_meta(get_post_meta($id_product, '_thumbnail_id')[0], '_wp_attached_file')[0]
			);
		return $data_product;
	}

	function getCatalog( $id_product ){
		$id_catalog = get_post_meta($id_product, '_wpcf_belongs_catalog_id')[0];
		$data_catalog = array(
				'code' => get_post_meta($id_catalog, 'wpcf-id-catalog')[0],
				'brand' => get_post_meta($id_catalog, 'wpcf-brand')[0],
				'type' => get_post_meta($id_catalog, 'wpcf-type')[0],
				'color' => get_post_meta($id_catalog, 'wpcf-color')[0]
			);
		return $data_catalog;
	}
?>