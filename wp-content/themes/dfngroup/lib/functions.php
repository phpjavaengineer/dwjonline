<?php

/* Functions Carried from old Theme */

add_action( 'admin_menu', 'clothoo_admin_menu' );
function clothoo_admin_menu() {
	$page_hook_suffix = add_menu_page( __('Clothoo Admin'), __('Clothoo Admin'), 'manage_options', 'clothoo_admin', 'clothoo_admin' );
	add_action('admin_head-' . $page_hook_suffix, 'clothoo_admin_scripts');

}

function clothoo_admin() {
	require_once(STYLESHEETPATH ."/lib/admin/admin.php");
}

function clothoo_admin_scripts() {
	wp_enqueue_style( 'clothoo-css', THE ."/lib/css/backend_styles.css" );	
}


function sort_colors_by_order($array) {
	
	if(is_array($array)) {
		foreach($array as $color=>$val) {
			
			$order = $val['order'];
			
			$body_color[$order] = array(
				'name' => $val['name'],
				'code' => $val['code'],
				'order' => $val['order']
			);
			
		}
		
		ksort($body_color);

		return $body_color;
	
	} else {
		return false;
	}
}



add_action("wp_head","add_file_uploader");

function add_file_uploader() {
    
	if( is_page('design-your-jacket') ) {
		wp_register_script('plu', THE ."/lib/upload/plupload.full.min.js");
		wp_enqueue_script('plu', array("jquery"));
	}
}

function wp_set_post_terms_modified( $post_id, $term, $tax ) {
	$term = preg_replace('/\s+/', ' ',$term);
	
	if(!empty($term)) {
		wp_set_post_terms( $post_id, $term, $tax );
	}
}

// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );
 
// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );


function woo_add_custom_general_fields() {
	global $woocommerce, $post;
	if(!empty($post->ID)) :
	
	$clothoo = get_post_meta( $post->ID, 'clothoo', true);
	
	if(empty($clothoo)) {
		$clothoo = array();
	}

	$fields_array = array(
		// Step0
		'gender',
		'base_size',
		
		/// Step1
		'body_pattern',
		'body_color',
		'snaps_color',
		'pockets_color',
		
		// Step2
		'trim_style',
		'trim_base_color',
		'trim_strip1_color',
		'trim_strip2_color',
		'collar_style',
		
		// Step3
		'sleeves_pattern',
		'sleeves_color',
		
		
		// Step4
		'right_chest' => array(
			'object_type',
			'image_url',
			'image_size',
			
			'obj_text_style',
			'text',
			'text_font',
			
			'letter_type',
			'text_style',
			
			'text_fill_color',
			'text_stroke_color',
			'text_size',
		),
		
		
		// Step5
		'left_chest' => array(
			'object_type',
			
			'image_url',
			'image_size',
			
			'obj_text_style',
			'text',
			'text_font',
			
			'letter_type',
			'text_style',
			
			'text_fill_color',
			'text_stroke_color',
			'text_size',
		),
		
		
		// Step6
		'right_pocket' => array(
			'object_type',
			
			'image_url',
			'image_size',
			
			'text',
			'text_font',
			'text_fill_color',
			'text_stroke_color',
			'text_size',
		),
		
		
		// Step7
		'left_pocket' => array(
			'object_type',
			
			'image_url',
			'image_size',
			
			'text',
			'text_font',
			'text_fill_color',
			'text_stroke_color',
			'text_size',
		),
		
		
		// Step8
		'bottom_top' => array(
			'object_type',
			
			'image_url',
			'image_size',
			
			'text',
			'text_font',
			'text_fill_color',
			'text_stroke_color',
			'text_size',
		),
		
		
		// Step9
		'bottom_middle' => array(
			'object_type',
			
			'image_url',
			'image_size',
			
			'text',
			'text_font',
			'text_fill_color',
			'text_stroke_color',
			'text_size',
		),
		
		
		// Step10
		'bottom_bottom' => array(
			'object_type',

			'image_url',
			'image_size',
			
			'text',
			'text_font',
			'text_fill_color',
			'text_stroke_color',
			'text_size',
		),
		
		
		// Step11
		'right_sleeve' => array(
			'object_type',
			
			'image_url',
			'image_size',
			
			'text',
			'text_font',
			'text_style',
			'text_fill_color',
			'text_stroke_color',
			'text_size',
		),
		
		
		// Step12
		'left_sleeve' => array(
			'object_type',
			'image_url',
			'image_size',
			'text',
			'text_font',
			'text_style',
			'text_fill_color',
			'text_stroke_color',
			'text_size',
		),
		
		// Step 13
		'special_note'
	);
	
	echo '<div class="options_group">';
	
	foreach($fields_array as $key=>$values) {
		
		
		
		if(is_array($values)) {
			
			$label1 = str_replace("_"," ",$key);
			$label1 = ucwords($label1);
			
			echo '<h4>'.$label1.'</h4>';
			
			foreach($values as $k=>$val) {
				
				$label2 = str_replace("_"," ",$val);
				$label2 = ucwords($label2);
				
				echo "<div style='padding-left: 8px;'>";
				woocommerce_wp_text_input(
					array(
						'id' => 'clotho['.$key.']['.$val.']',
						'label' => __( $label2, 'woocommerce' ),
						'placeholder' => '',
						'value' => $clothoo[$key][$val]
					)
				);
				echo "</div>";
			}
			
		} else {
			
			$label = str_replace("_"," ",$values);
			$label = ucwords($label);
			
			woocommerce_wp_text_input(
				array(
					'id' => 'clothoo['.$values.']',
					'label' => __( $label, 'woocommerce' ),
					'placeholder' => '',
					'value' => $clothoo[$values]
				)
			);
			
		}
		
	}
	
	echo '</div>';
	
	endif;
}

function woo_add_custom_general_fields_save( $post_id ) {
	$clothoo = $_POST['clothoo'];
	if( !empty( $woocommerce_text_field ) )
	update_post_meta( $post_id, 'clothoo', $clothoo );
}

add_action("init","create_svg_files");

function create_svg_files() {
	
	if( !is_admin() && isset($_POST['create_svg']) && $_POST['create_svg'] == 1 ) {
		header('Content-type: application/json');
		$upload_dir = wp_upload_dir();
		
		$front_name = uniqid('front_').".svg";
		$left_name = uniqid('left_').".svg";
		$right_name = uniqid('right_').".svg";
		$back_name = uniqid('back_').".svg";
		
		$svg = array();
		$svg['front_svg'] = $upload_dir['path'].'/'.$front_name;
		$svg['left_svg'] = $upload_dir['path'].'/'.$left_name;
		$svg['right_svg'] = $upload_dir['path'].'/'.$right_name;
		$svg['back_svg'] = $upload_dir['path'].'/'.$back_name;
		
		foreach($svg as $sv=>$sg) {
			$handle = fopen($sg, 'w') or die('Cannot open file:  '.$sg);
			
			$data = '<?xml version="1.0" encoding="utf-8"?><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">'.str_replace("--->","-->",stripslashes($_POST[$sv]));
			fwrite($handle, $data);
			fclose($handle);
			
			$return[$sv] = str_replace($upload_dir['path'],$upload_dir['url'],$sg);
			
			/*
			$im = new Imagick();
			$svg = file_get_contents($sg);

			$im->readImageBlob($svg);
			$im->setImageFormat("png24");
			//$im->resizeImage(720, 445, imagick::FILTER_LANCZOS, 1);

			$im->setImageFormat("jpeg");
			//$im->adaptiveResizeImage(720, 445);
			
			$file_path = str_replace(".svg",".png",$sg);
			
			$im->writeImage($file_path);
			$im->clear();
			$im->destroy();
			$return[$sv] = str_replace($upload_dir['path'],$upload_dir['url'],$file_path);*/
		}
		
		echo json_encode($return);
		exit;
	}
	
	if(!is_admin() && $_POST['save_jacket_temp'] == 1) {
		global $wpdb;
		
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$results = $wpdb->get_row('SELECT ID FROM wp_jacket_design WHERE ip_address = "'. $ip_address .'"');
		
		if(!empty($results)) {
			$wpdb->update( 
				'wp_jacket_design', 
				array( 'data' => $_POST['values'] ), 
				array( 'ID' => $results->ID ), 
				array( '%s'	), 
				array( '%d' ) 
			);
		
		} else {
			$wpdb->insert( 
				'wp_jacket_design', 
				array( 
					'ip_address' => $ip_address, 
					'data' => $_POST['values']
				), 
				array( 
					'%s', 
					'%s' 
				) 
			);
		}
		
	}
	
	if(!is_admin() && $_POST['discard_jacket_temp'] == 1) {
		global $wpdb;
		
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$wpdb->delete( 'wp_jacket_design', array( 'ip_address' => $ip_address ) );

	}
	
}

function get_color_name($code, $type) {
	$value = get_option("clothoo_admin");
	$information = $value[$type];
	
	$loops = count($information);
	for ($i = 0; $i <= $loops; $i++) {
		if($information[$i]['code'] == $code) {
			$color_name = $information[$i]['name'];
			break;
		}
	}
	
	return $color_name;
}


function decoration_object($label, $value) { ?>
	<tr>
		<td><?php echo $label; ?></td>
		
		<?php if($value['object_type'] == "Text") { ?>
			<td><?php echo $value['text']; ?></td>
			<td><?php echo $value['text_font']; ?></td>
			<td><?php echo $value['text_fill_color']; ?></td>
			<td><?php echo $value['text_stroke_color']; ?></td>
			<td><?php echo $value['text_style']; ?></td>
			<td><?php echo $value['letter_type']; ?></td>
			<td><?php echo $value['text_size']; ?>"</td>
		
		<?php } elseif($value['object_type'] == "Image") { ?>
			<td><img src="<?php echo $value['image_url']; ?>" style="height: 40px; margin: 0 auto; display: table;" /></td>
			<td colspan="5">&nbsp;</td>
			<td><?php echo $value['image_size']; ?>"</td>
		<?php } ?>
	</tr>
<?php }


add_action("wp_footer","add_scripts");

function add_scripts() { ?>
	
	<script>
		jQuery(document).ready(function($) { 
			$("a.button.add_to_cart_button.product_type_simple").each(function() {
				var product_id = $(this).data("product_id");
				
				var html = '<a class="button product_type_simple customize_button" data-product_id="'+ product_id +'" rel="nofollow" href="/design-your-jacket/?jacket_id='+ product_id +'">Customize</a>';
				$(this).after(html);
				$(this).hide();
			});
		});
	</script>

<?php }


/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function clothoo_box() {
	add_meta_box(
		'clothoo_meta_order',
		__( 'Order Details', 'clothoo' ),
		'clothoo_box_meta',
		'shop_order'
	);
}
add_action( 'add_meta_boxes', 'clothoo_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function clothoo_box_meta( $post ) { ?>

<style>/* Cart Page */

#content .info_div {
	margin-bottom: 40px;	
}

#content .product_views .product_view {
	padding: 0;
	margin: 0 30px 0 0;
	text-align: center;
}

#content .product_views .product_view:nth-child(4n) {
	margin-right: 0;
}

#content .materials_info .table td{
	text-align: center;
	border: 1px solid #e0e0e0;
	width: 20%;
}

#content .coloring_info .table tr td {
	vertical-align: middle;
}

#content .coloring_info .table tr td.color_name {
	min-width: 90px;
}

#content .coloring_info .table tr td.color_code {
	min-width: 180px;
}

#content .coloring_info .table tr td:first-child{
	width: 600px;
}

#content .coloring_info .table tr td span {
	vertical-align: top;
	display: inline-block;
}

#content .coloring_info .table tr td .color_label {
	width: 95px;
	height: 21px;
	margin: 0 10px;
	border: 1px solid #ccc;
}

#content .size_info .table {
	border: 1px solid #ccc;
}

#content .size_info h2{
	padding-left: 15px;
}

#content .text_info .table td {
	text-align: center;
}

#content .text_info .table td.image_td {
	width: 155px;
	font-weight: bold;
}

#content .text_info .table td.image_td img{
	margin: 15px auto 0;
}

#content .size_info .table td{
	border: 0;
	padding: 20px 5px;
}

#content .object_info table tr {
	border: 0;
}

#content .object_info table th {
	font-weight: normal;
	text-transform: inherit;
	vertical-align: middle;
	text-align: center;
	width: 75px;
	color: #FF3535;
}

#content .object_info table {
	margin-bottom: 0;
}

#content .object_info table td {
	vertical-align: top;
	text-align: center;
	padding: 0;
}

#content .object_info table .image_td {
	vertical-align: middle;
	border-top: 0;
	border-bottom: 1px solid #e0e0e0;
	padding: 15px 0;
}

#content .object_info table tbody tr:last-child > td {
	border-bottom: 0;
}


#content .object_info table .image_td h2 {
	margin: 0;
}

#content .object_info > table tr > td {
	border-top: 0;
	border-bottom: 1px solid #e0e0e0;
}


#content .object_info > table tr > td > img {
	margin: 10px auto 0;
	display: table;
}

#content table.object-info-details td {
	border: 1px solid #e0e0e0;
	padding: 13px 5px;
	text-align: center;
	width: 75px;
}


#content table.table.object-info-details tbody tr:first-child td{
	border-top: 0;
}

#content table.table.object-info-details tbody tr:last-child td{
	border-bottom: 0;
}

#content table.sleeves_table tbody td {
  height: 110px;
  vertical-align: middle;
}

#content .textarea_wrap {
	border: 1px solid #e0e0e0;
	padding: 15px 12px;
}

#content .textarea_wrap p:last-child{
	margin-bottom: 0
}

#content table.table.no_border tr, #content table.table.no_border td{
	border: 0;
}
</style>


<div id="content">
<?php $order = new WC_Order( $post->ID );
$items = $order->get_items();
foreach ( $items as $item ) {
	
	$product_id = $item['product_id'];

	$product_title = get_the_title($product_id);
	$clothoo = get_post_meta($product_id, "clothoo",true);
	
	$front_svg = $clothoo['front_svg'];
	$back_svg = $clothoo['back_svg'];
	$right_svg = $clothoo['right_svg'];
	$left_svg = $clothoo['left_svg'];
	
	$body_pattern = $clothoo['body_pattern'];
	$sleeves_pattern = $clothoo['sleeves_pattern'];
	$collar_style = $clothoo['collar_style'];
	$trim_style = $clothoo['trim_style'];
	$collar_style = $clothoo['collar_style'];
	
	$body_color = $clothoo['body_color'];
	$body_color_name = get_color_name($body_color, "body_color");$sleeves_color = $clothoo['sleeves_color'];
	$sleeves_color_name = get_color_name($sleeves_color, "sleeves_color");
	$snaps_color = $clothoo['snaps_color'];
	$snaps_color_name = get_color_name($snaps_color, "snaps_color");$pockets_color = $clothoo['pockets_color'];
	$pockets_color_name = get_color_name($snaps_color, "pockets_color");
	
	$trim_base_color = $clothoo['trim_base_color'];
	$trim_base_color_name = get_color_name($trim_base_color, "trim_base_color");

	$trim_strip1_color = $clothoo['trim_strip1_color'];
	$trim_strip1_color_name = get_color_name($trim_strip1_color, "trim_strip1_color");
	
	$trim_strip2_color = $clothoo['trim_strip2_color'];
	$trim_strip2_color_name = get_color_name($trim_strip2_color, "trim_strip2_color");
	
	$hood_color = $clothoo['hood_color'];
	$hood_color_name = get_color_name($hood_color, "hood_color");$hood_inside_color = $clothoo['hood_color'];
	$hood_inside_color_name = get_color_name($hood_inside_color, "hood_color");
	

	$left_chest = $clothoo['left_chest'];
	$right_chest = $clothoo['right_chest'];
	$right_pocket = $clothoo['right_pocket'];
	$left_pocket = $clothoo['left_pocket'];
	
	$bottom_top = $clothoo['bottom_top'];
	$bottom_middle = $clothoo['bottom_middle'];
	$bottom_bottom = $clothoo['bottom_bottom'];
	
	$right_sleeve = $clothoo['right_sleeve'];
	$left_sleeve = $clothoo['left_sleeve'];
	$special_note = $clothoo['special_note'];

?>


<div class="product_details">
	<h2>Your Order Details - <span class="orange"><?php echo $product_title; ?></span></h2>
	<hr />
	
	<div class="info_div product_views">
		<div class="alignleft product_view">
			<img src="<?php echo $front_svg; ?>" width="261.167px" height="266.5px" />
			<div class="view_title">Front</div>
		</div>
		
		<div class="alignleft product_view">
			<img src="<?php echo $back_svg; ?>" width="260.5px" height="265.75px" />
			<div class="view_title">Back</div>
		</div>
		
		<div class="alignleft product_view">
			<img src="<?php echo $left_svg; ?>" width="111.875px" height="265.75px" />
			<div class="view_title">Right</div>
		</div>
		
		<div class="alignleft product_view">
			<img src="<?php echo $right_svg; ?>" width="111.875px" height="265.75px" />
			<div class="view_title">Left</div>
		</div>
		
		<div class="clear"></div>
	</div>
	
	<div class="info_div materials_info">
		<h2 class="orange">Materials</h2>
		<table class="table" width="100%">
			<tr>
				<td><span class="body_style"><?php echo $body_pattern; ?></span> Body</td>
				<td><span class="sleeve_style"><?php echo $sleeves_pattern; ?></span> Sleeves</td>
				<td><span class="collar_type"><?php echo $collar_style; ?></span> Collar</td>
				<td>Tricot Band Rib <span class="trim_style"><?php echo $trim_style; ?></span></td>
				<td><span class="trim_style"><?php echo $trim_style; ?></span></td>
			</tr>
		</table>
	</div>
	
	<div class="info_div coloring_info">
		<h2 class="orange">Coloring</h2>
		<table class="table" width="100%">
			<tr class="body_color">
				<td><span class="body_style"><?php echo $body_pattern; ?></span> body color</td>
				<td class="color_name"><?php echo $body_color_name; ?></td>
				<td class="color_code">
					<span class="color_label" style="background: <?php echo $body_color; ?>;"></span>
					<span class="color_txt"><?php echo $body_color; ?></span>
				</td>
			</tr>
			<tr class="sleeve_color">
				<td><span class="sleeve_style"><?php echo $sleeves_pattern; ?></span> sleeve color</td>
				<td class="color_name"><?php echo $sleeves_color_name; ?></td>
				<td class="color_code">
					<span class="color_label" style="background: <?php echo $sleeves_color; ?>;"></span>
					<span class="color_txt"><?php echo $sleeves_color; ?></span>
				</td>
			</tr>
			<tr class="snaps_color">
				<td>Snaps color</td>
				<td class="color_name"><?php echo $snaps_color_name ?></td>
				<td class="color_code">
					<span class="color_label" style="background: <?php echo $snaps_color; ?>;"></span>
					<span class="color_txt"><?php echo $snaps_color; ?></span>
				</td>
			</tr>
			<tr class="pockets_color">
				<td>Pockets color</td>
				<td class="color_name"><?php echo $pockets_color_name; ?></td>
				<td class="color_code">
					<span class="color_label" style="background: <?php echo $pockets_color; ?>;"></span>
					<span class="color_txt"><?php echo $pockets_color; ?></span>
				</td>
			</tr>
			<tr class="trim_base_color">
				<td>Tricot band base Color</td>
				<td class="color_name"><?php echo $trim_base_color_name; ?></td>
				<td class="color_code">
					<span class="color_label" style="background: <?php echo $trim_base_color; ?>;"></span>
					<span class="color_txt"><?php echo $trim_base_color; ?></span>
				</td>
			</tr>
			<tr class="strip1_color">
				<td>Tricot band strip 1 Color</td>
				<td class="color_name"><?php echo $trim_strip1_color_name; ?></td>
				<td class="color_code">
					<span class="color_label" style="background: <?php echo $trim_strip1_color; ?>;"></span>
					<span class="color_txt"><?php echo $trim_strip1_color; ?></span>
				</td>
			</tr>
			
			<?php if($trim_style == "Trim 3") { ?>
			<tr class="strip2_color">
				<td>Tricot band strip 2 Color</td>
				<td class="color_name"><?php echo $trim_strip2_color_name; ?></td>
				<td class="color_code">
					<span class="color_label" style="background: <?php echo $trim_strip2_color; ?>;"></span>
					<span class="color_txt"><?php echo $trim_strip2_color; ?></span>
				</td>
			</tr>
			<?php } ?>
			
			<?php if($collar_style == "Hoodie Collar") { ?>
			<tr class="hood_color">
				<td>Hood Color</td>
				<td class="color_name"><?php echo $hood_color_name; ?></td>
				<td class="color_code">
					<span class="color_label" style="background: <?php echo $hood_color; ?>;"></span>
					<span class="color_txt"><?php echo $hood_color; ?></span>
				</td>
			</tr>
			<?php } ?>
			
			<?php if($collar_style == "Hoodie Collar") { ?>
			<tr class="hood_color">
				<td>Hood Inside Color</td>
				<td class="color_name"><?php echo $hood_inside_color_name; ?></td>
				<td class="color_code">
					<span class="color_label" style="background: <?php echo $hood_inside_color; ?>;"></span>
					<span class="color_txt"><?php echo $hood_inside_color; ?></span>
				</td>
			</tr>
			<?php } ?>
		</table>
	</div>

	<?php if($left_chest['object_type'] !="" || $right_chest['object_type'] !="" || $left_pocket['object_type'] !="" || $right_pocket['object_type'] !="" || $bottom_top['object_type'] !="" || $bottom_middle['object_type'] !="" || $bottom_bottom['object_type'] !="" || $right_sleeve['object_type'] !="" || $left_sleeve['object_type'] !="") { ?>
	<div class="object_info">
		<table class="table" width="100%" cellspacing="0" cellpadding="0" >
			<tbody>
			<tr>
				<td class="image_td">
					<h2 class="orange">Decoration Area</h2>
				</td>
				<td>
					<table class="table object-info-details" width="100%" cellspacing="0" cellpadding="0">
						<tbody>
						<tr>
							<th>Position</th>
							<th>Text/Image Value</th>
							<th>Font Type</th>
							<th>Fill Color</th>
							<th>Border Color</th>
							<th>Decor Type</th>
							<th>Style</th>
							<th>Size</th>
						</tr>
						</tbody>
					</table>
				</td>
			</tr>
			
			<?php if($left_chest['object_type'] !="" || $right_chest['object_type'] !="" || $left_pocket['object_type'] !="" || $right_pocket['object_type'] !="") { ?>
			<tr>
				<td class="image_td">
					Front<br />
					<img src="<?php echo $front_svg; ?>" width="113px" height="114px" />
				</td>
				<td>
					<table class="table object-info-details" width="100%" cellspacing="0" cellpadding="0">
					<tbody>
						<?php if($left_chest['object_type'] !="") { ?>
							<?php decoration_object("Left Chest", $left_chest); ?>
						<?php } ?>
						
						<?php if($right_chest['object_type'] !="") { ?>
							<?php decoration_object("Right Chest", $right_chest); ?>
						<?php } ?>
						
						<?php if($left_pocket['object_type'] !="") { ?>
							<?php decoration_object("Left Pocket", $left_pocket); ?>
						<?php } ?>
						
						<?php if($right_pocket['object_type'] !="") { ?>
							<?php decoration_object("Right Pocket", $right_pocket); ?>
						<?php } ?>
					</tbody>
					</table>
				</td>
			</tr>
			<?php } ?>
			
			<?php if($bottom_top['object_type'] !="" || $bottom_middle['object_type'] !="" || $bottom_bottom['object_type'] !="") { ?>
			<tr>
				<td class="image_td">
					Back<br />
					<img src="<?php echo $back_svg; ?>" width="113px" height="114px" />
				</td>
				<td>
					<table class="table object-info-details" width="100%" cellspacing="0" cellpadding="0">
					<tbody>
						<?php if($bottom_top['object_type'] !="") { ?>
							<?php decoration_object("Top", $bottom_top); ?>
						<?php } ?>
						
						<?php if($bottom_middle['object_type'] !="") { ?>
							<?php decoration_object("Middle", $bottom_middle); ?>
						<?php } ?>
						
						<?php if($bottom_bottom['object_type'] !="") { ?>
							<?php decoration_object("Bottom", $bottom_bottom); ?>
						<?php } ?>
					</tbody>
					</table>
				</td>
			</tr>
			<?php } ?>
			
			<?php if($right_sleeve['object_type'] !="" || $left_sleeve['object_type'] !="") { ?>
			<tr>
				<td class="image_td">
					Right / Left Sleeves<br />
					<img class="alignleft" src="<?php echo $left_svg; ?>" width="63px" height="114px" style="margin-right: 10px;" />
					<img class="alignleft" src="<?php echo $right_svg; ?>" width="63px" height="114px" />
				</td>
				<td>
					<table class="table object-info-details sleeves_table" width="100%" cellspacing="0" cellpadding="0">
					<tbody>
						<?php if($right_sleeve['object_type'] !="") { ?>
							<?php decoration_object("Right Sleeve", $right_sleeve); ?>
						<?php } ?>
						
						<?php if($left_sleeve['object_type'] !="") { ?>
							<?php decoration_object("Left Sleeve", $left_sleeve); ?>
						<?php } ?>
					</tbody>
					</table>
				</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
	<?php } ?>

	<div class="info_div size_info">
		<table class="table" width="100%">
			<tr>
				<td><h2 class="orange" style="margin-bottom: 0;">Size Information: </h2></td>
				<td><?php echo $clothoo['gender']; ?> <?php echo $clothoo['base_size']; ?></td>
				<td>Chest: <?php echo $clothoo['chest-size']; ?></td>
				<td>Bottom Size: <?php echo $clothoo['bottom-size']; ?></td>
				<td>Back Length: <?php echo $clothoo['back-length']; ?></td>
				<td>Sleeves Length: <?php echo $clothoo['sleeves-length']; ?></td>
				
			</tr>
		</table>
	</div>
	
	<?php if(!empty($special_note)) { ?>
	<div class="info_div special_note_info_box">
		<h2 class="orange">Special Note</h2>
		<div class="textarea_wrap">
			<p><?php echo $special_note; ?></p>
		</div>
	</div>
	<?php } ?>

</div>
</div>

<?php }

}


add_action("wp_footer","clothoo_add_checkout_script");
function clothoo_add_checkout_script() { ?>
	
<?php if(is_page('checkout')) : ?>
<script>
jQuery(document).ready(function($) {
	$("#review-next").click(function() {
		$("#place_order").val("<?php _e( 'Pay for order', 'woocommerce' ); ?>").css("background-color","#ff4800");
	});
});
</script>
<?php endif; ?>	

<?php }