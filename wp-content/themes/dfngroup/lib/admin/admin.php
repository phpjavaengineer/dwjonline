<?php
	
	if( !empty($_POST['clothoo']) ) {
		update_option("clothoo_admin",$_POST['clothoo']);
	}
	
	$value = get_option("clothoo_admin");
	
	$body_color = sort_colors_by_order($value['body_color']);
	$snaps_color = sort_colors_by_order($value['snaps_color']);
	$pockets_color = sort_colors_by_order($value['pockets_color']);

	$trim_style = $value['trim_style'];
	$trim_base_color = sort_colors_by_order($value['trim_base_color']);
	$trim_strip1_color = sort_colors_by_order($value['trim_strip1_color']);
	$trim_strip2_color = sort_colors_by_order($value['trim_strip2_color']);
	
	$collar_style = $value['collar_style'];
	
	$text_fill_color = sort_colors_by_order($value['text_fill_color']);
	$text_stroke_color = sort_colors_by_order($value['text_stroke_color']);
	$sleeves_color = sort_colors_by_order($value['sleeves_color']);
	$hood_color = sort_colors_by_order($value['hood_color']);
	
	$clothoo_price = $value['price'];
	$material_price = $value['material'];
	$smaterial_price = $value['smaterial'];
	
	/*$args = array(
		'post_type'	=> 'color',
		'nopaging'	=>	true
	);
	
	// the query
	$the_query = new WP_Query( $args );
	$i = 0;
	
	if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) : $the_query->the_post();
		$color = get_post_meta(get_the_ID(),"wpcf-color-code",true);
		
		$body_color[$i] = array(
			'name'	=> get_the_title(),
			'code'	=> $color,
			'order'	=> $i
		);
	
	$i++; endwhile; endif;
	
	$snaps_color = $pockets_color = $body_color;*/
		
	
	

?>

<h1>Clothoo Administration</h1>
<br />

<form method="POST" action="<?php echo $_SERVER['REDIRECT_URI']; ?>">
	
	<div class="row col3" style="margin-bottom: 25px;">
		<div class="col col-1">
			<h3>Body Colors</h3>
			<hr />
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">Name</th>
						<th style="text-align: left;">Code</th>
						<th style="text-align: left;">Order</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				
				<tbody id="color_code">
					
					<?php $i=0; foreach($body_color as $color) {?>
					<tr>
						<td><input class="color_name" type="text" name="clothoo[body_color][<?php echo $i; ?>][name]" value="<?php echo $color['name']; ?>" placeholder="Enter Color Name" /></td>
						<td><input class="color_code" type="text" name="clothoo[body_color][<?php echo $i; ?>][code]" value="<?php echo $color['code']; ?>" placeholder="e.g. #ccc" /></td>
						<td><input class="color_order" type="text" name="clothoo[body_color][<?php echo $i; ?>][order]" value="<?php echo $color['order']; ?>" placeholder="Order" /></td>
						<td><a class="remove_row" href="#">Remove</a></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
				
				<tfoot>
					<tr>
						<td colspan="3">
							<a class="add_row" href="#">Add Color</a>
						</td>
					</tr>
				</tfoot>
				
			</table>
		</div>
		
		<div class="col col-2">
			<h3>Pocket Colors</h3>
			<hr />
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">Name</th>
						<th style="text-align: left;">Code</th>
						<th style="text-align: left;">Order</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				
				<tbody id="color_code">
					
					<?php $i=0; foreach($pockets_color as $color) {?>
					<tr>
						<td><input class="color_name" type="text" name="clothoo[pockets_color][<?php echo $i; ?>][name]" value="<?php echo $color['name']; ?>" placeholder="Enter Color Name" /></td>
						<td><input class="color_code" type="text" name="clothoo[pockets_color][<?php echo $i; ?>][code]" value="<?php echo $color['code']; ?>" placeholder="e.g. #ccc" /></td>
						<td><input class="color_order" type="text" name="clothoo[pockets_color][<?php echo $i; ?>][order]" value="<?php echo $color['order']; ?>" placeholder="Order" /></td>
						<td><a class="remove_row" href="#">Remove</a></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
				
				<tfoot>
					<tr>
						<td colspan="3">
							<a class="add_row" href="#">Add Color</a>
						</td>
					</tr>
				</tfoot>
				
			</table>
		</div>
		
		<div class="col col-3">
			<h3>Snap Colors</h3>
			<hr />
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">Name</th>
						<th style="text-align: left;">Code</th>
						<th style="text-align: left;">Order</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				
				<tbody id="color_code">
					
					<?php $i=0; foreach($snaps_color as $color) {?>
					<tr>
						<td><input class="color_name" type="text" name="clothoo[snaps_color][<?php echo $i; ?>][name]" value="<?php echo $color['name']; ?>" placeholder="Enter Color Name" /></td>
						<td><input class="color_code" type="text" name="clothoo[snaps_color][<?php echo $i; ?>][code]" value="<?php echo $color['code']; ?>" placeholder="e.g. #ccc" /></td>
						<td><input class="color_order" type="text" name="clothoo[snaps_color][<?php echo $i; ?>][order]" value="<?php echo $color['order']; ?>" placeholder="Order" /></td>
						<td><a class="remove_row" href="#">Remove</a></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
				
				<tfoot>
					<tr>
						<td colspan="3">
							<a class="add_row" href="#">Add Color</a>
						</td>
					</tr>
				</tfoot>
				
			</table>
		</div>
		
		<div class="clear"></div>
	</div>
	
	<div class="row col3" style="margin-bottom: 25px;">
		<div class="col col-1">
			<h3>Trim Base Colors</h3>
			<hr />
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">Name</th>
						<th style="text-align: left;">Code</th>
						<th style="text-align: left;">Order</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				
				<tbody id="color_code">
					
					<?php $i=0; foreach($trim_base_color as $color) {?>
					<tr>
						<td><input class="color_name" type="text" name="clothoo[trim_base_color][<?php echo $i; ?>][name]" value="<?php echo $color['name']; ?>" placeholder="Enter Color Name" /></td>
						<td><input class="color_code" type="text" name="clothoo[trim_base_color][<?php echo $i; ?>][code]" value="<?php echo $color['code']; ?>" placeholder="e.g. #ccc" /></td>
						<td><input class="color_order" type="text" name="clothoo[trim_base_color][<?php echo $i; ?>][order]" value="<?php echo $color['order']; ?>" placeholder="Order" /></td>
						<td><a class="remove_row" href="#">Remove</a></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
				
				<tfoot>
					<tr>
						<td colspan="3">
							<a class="add_row" href="#">Add Color</a>
						</td>
					</tr>
				</tfoot>
				
			</table>
		</div>
		
		<div class="col col-2">
			<h3>Trim Strip 1 Colors</h3>
			<hr />
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">Name</th>
						<th style="text-align: left;">Code</th>
						<th style="text-align: left;">Order</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				
				<tbody id="color_code">
					
					<?php $i=0; foreach($trim_strip1_color as $color) {?>
					<tr>
						<td><input class="color_name" type="text" name="clothoo[trim_strip1_color][<?php echo $i; ?>][name]" value="<?php echo $color['name']; ?>" placeholder="Enter Color Name" /></td>
						<td><input class="color_code" type="text" name="clothoo[trim_strip1_color][<?php echo $i; ?>][code]" value="<?php echo $color['code']; ?>" placeholder="e.g. #ccc" /></td>
						<td><input class="color_order" type="text" name="clothoo[trim_strip1_color][<?php echo $i; ?>][order]" value="<?php echo $color['order']; ?>" placeholder="Order" /></td>
						<td><a class="remove_row" href="#">Remove</a></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
				
				<tfoot>
					<tr>
						<td colspan="3">
							<a class="add_row" href="#">Add Color</a>
						</td>
					</tr>
				</tfoot>
				
			</table>
		</div>
		
		<div class="col col-3">
			<h3>Trim Strip 2 Colors</h3>
			<hr />
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">Name</th>
						<th style="text-align: left;">Code</th>
						<th style="text-align: left;">Order</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				
				<tbody id="color_code">
					
					<?php $i=0; foreach($trim_strip2_color as $color) {?>
					<tr>
						<td><input class="color_name" type="text" name="clothoo[trim_strip2_color][<?php echo $i; ?>][name]" value="<?php echo $color['name']; ?>" placeholder="Enter Color Name" /></td>
						<td><input class="color_code" type="text" name="clothoo[trim_strip2_color][<?php echo $i; ?>][code]" value="<?php echo $color['code']; ?>" placeholder="e.g. #ccc" /></td>
						<td><input class="color_order" type="text" name="clothoo[trim_strip2_color][<?php echo $i; ?>][order]" value="<?php echo $color['order']; ?>" placeholder="Order" /></td>
						<td><a class="remove_row" href="#">Remove</a></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
				
				<tfoot>
					<tr>
						<td colspan="3">
							<a class="add_row" href="#">Add Color</a>
						</td>
					</tr>
				</tfoot>
				
			</table>
		</div>
		
		<div class="clear"></div>
	</div>
	
	<div class="row col3" style="margin-bottom: 25px;">
		<div class="col col-1">
			<h3>Trim Styles</h3>
			<hr />
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">Trim Style</th>
						<th style="text-align: left;">Price</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				
				<tbody>
					<?php $i=0; foreach($trim_style as $trim) { ?>
					<tr>
						<td><input class="color_name" type="text" name="clothoo[trim_style][<?php echo $i; ?>][name]" value="<?php echo $trim['name']; ?>" placeholder="Enter Trim Style Name" /></td>
						<td><input class="color_code" type="text" name="clothoo[trim_style][<?php echo $i; ?>][price]" value="<?php echo $trim['price']; ?>" placeholder="Enter Trim Style Price" /></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
			</table>
		</div>
		
		<div class="col col-2">
			<h3>Collar Styles</h3>
			<hr />
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">Collar Style</th>
						<th style="text-align: left;">Price</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				
				<tbody>
					<?php $i=0; foreach($collar_style as $collar) { ?>
					<tr>
						<td><input class="color_name" type="text" name="clothoo[collar_style][<?php echo $i; ?>][name]" value="<?php echo $collar['name']; ?>" placeholder="Enter Collar Style Name" /></td>
						<td><input class="color_code" type="text" name="clothoo[collar_style][<?php echo $i; ?>][price]" value="<?php echo $collar['price']; ?>" placeholder="Enter Collar Style Price" /></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
			</table>
		</div>
		
		<div class="col col-3"></div>
		<div class="clear"></div>
	</div>
	
	
	<div class="row col3" style="margin-bottom: 25px;">
		<div class="col col-1">
			<h3>Text Fill Colors</h3>
			<hr />
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">Name</th>
						<th style="text-align: left;">Code</th>
						<th style="text-align: left;">Order</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				
				<tbody id="color_code">
					
					<?php $i=0; foreach($text_fill_color as $color) {?>
					<tr>
						<td><input class="color_name" type="text" name="clothoo[text_fill_color][<?php echo $i; ?>][name]" value="<?php echo $color['name']; ?>" placeholder="Enter Color Name" /></td>
						<td><input class="color_code" type="text" name="clothoo[text_fill_color][<?php echo $i; ?>][code]" value="<?php echo $color['code']; ?>" placeholder="e.g. #ccc" /></td>
						<td><input class="color_order" type="text" name="clothoo[text_fill_color][<?php echo $i; ?>][order]" value="<?php echo $color['order']; ?>" placeholder="Order" /></td>
						<td><a class="remove_row" href="#">Remove</a></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
				
				<tfoot>
					<tr>
						<td colspan="3">
							<a class="add_row" href="#">Add Color</a>
						</td>
					</tr>
				</tfoot>
				
			</table>
		</div>
		
		<div class="col col-2">
			<h3>Text Stroke Colors</h3>
			<hr />
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">Name</th>
						<th style="text-align: left;">Code</th>
						<th style="text-align: left;">Order</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				
				<tbody id="color_code">
					
					<?php $i=0; foreach($text_stroke_color as $color) {?>
					<tr>
						<td><input class="color_name" type="text" name="clothoo[text_stroke_color][<?php echo $i; ?>][name]" value="<?php echo $color['name']; ?>" placeholder="Enter Color Name" /></td>
						<td><input class="color_code" type="text" name="clothoo[text_stroke_color][<?php echo $i; ?>][code]" value="<?php echo $color['code']; ?>" placeholder="e.g. #ccc" /></td>
						<td><input class="color_order" type="text" name="clothoo[text_stroke_color][<?php echo $i; ?>][order]" value="<?php echo $color['order']; ?>" placeholder="Order" /></td>
						<td><a class="remove_row" href="#">Remove</a></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
				
				<tfoot>
					<tr>
						<td colspan="3">
							<a class="add_row" href="#">Add Color</a>
						</td>
					</tr>
				</tfoot>
				
			</table>
		</div>
		
		<div class="col col-2">
			<h3>Sleeves Colors</h3>
			<hr />
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">Name</th>
						<th style="text-align: left;">Code</th>
						<th style="text-align: left;">Order</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				
				<tbody id="color_code">
					
					<?php $i=0; foreach($sleeves_color as $color) {?>
					<tr>
						<td><input class="color_name" type="text" name="clothoo[sleeves_color][<?php echo $i; ?>][name]" value="<?php echo $color['name']; ?>" placeholder="Enter Color Name" /></td>
						<td><input class="color_code" type="text" name="clothoo[sleeves_color][<?php echo $i; ?>][code]" value="<?php echo $color['code']; ?>" placeholder="e.g. #ccc" /></td>
						<td><input class="color_order" type="text" name="clothoo[sleeves_color][<?php echo $i; ?>][order]" value="<?php echo $color['order']; ?>" placeholder="Order" /></td>
						<td><a class="remove_row" href="#">Remove</a></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
				
				<tfoot>
					<tr>
						<td colspan="3">
							<a class="add_row" href="#">Add Color</a>
						</td>
					</tr>
				</tfoot>
				
			</table>
		</div>
		<div class="clear"></div>
	</div>
	
	
	<div class="row col3" style="margin-bottom: 25px;">
		<div class="col col-1">
			<h3>Text Or Image Prices</h3>
			<hr />
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">Name</th>
						<th style="text-align: left;">Price (in USD)</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				
				<tbody id="color_code">
					
					<?php $i=0; foreach($clothoo_price as $price) {?>
					<tr>
						<td><input class="create_name_as_slug" data-format="clothoo[price][][name]" type="text" name="clothoo[price][<?php echo str_replace(" ","_", strtolower($price['name'])); ?>][name]" value="<?php echo $price['name']; ?>" placeholder="Enter Color Name" /></td>
						<td><input class="replace_slug" type="text" data-format="clothoo[price][][price]" name="clothoo[price][<?php echo str_replace(" ","_", strtolower($price['name'])); ?>][price]" value="<?php echo $price['price']; ?>" placeholder="e.g. 300" /></td>
						<td><a class="remove_row" href="#">Remove</a></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
				
				<tfoot>
					<tr>
						<td colspan="3">
							<a class="add_row" href="#">Add More</a>
						</td>
					</tr>
				</tfoot>
				
			</table>
		</div>
		<div class="col col-2">
			<h3>Body Material Type Prices</h3>
			<hr />
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">Name</th>
						<th style="text-align: left;">Price (in USD)</th>
						
					</tr>
				</thead>
				
				<tbody id="color_code">
					
					
					<tr>
						<td><input class="input" type="text" name="clothoo[material][wool][name]" value="<?php echo $material_price['wool']['name']; ?>" placeholder="Enter Material Name" /></td>
						<td><input class="replace_slug" type="text" name="clothoo[material][wool][price]" value="<?php echo $material_price['wool']['price']; ?>" placeholder="e.g. 300" /></td>
						
					</tr>
					
					<tr>
						<td><input class="input" type="text" name="clothoo[material][leather][name]" value="<?php echo $material_price['leather']['name']; ?>" placeholder="Enter Material Name" /></td>
						<td><input class="replace_slug" type="text" name="clothoo[material][leather][price]" value="<?php echo $material_price['leather']['price']; ?>" placeholder="e.g. 300" /></td>
						
					</tr>
					
					<tr>
						<td><input class="input" type="text" name="clothoo[material][fleather][name]" value="<?php echo $material_price['fleather']['name']; ?>" placeholder="Enter Material Name" /></td>
						<td><input class="replace_slug" type="text" name="clothoo[material][fleather][price]" value="<?php echo $material_price['fleather']['price']; ?>" placeholder="e.g. 300" /></td>
					</tr>
					
					<tr>
						<td><input class="input" type="text" name="clothoo[material][cotton][name]" value="<?php echo $material_price['cotton']['name']; ?>" placeholder="Enter Material Name" /></td>
						<td><input class="replace_slug" type="text" name="clothoo[material][cotton][price]" value="<?php echo $material_price['cotton']['price']; ?>" placeholder="e.g. 300" /></td>
						
					</tr>
					
					<tr>
						<td><input class="input" type="text" name="clothoo[material][denim][name]" value="<?php echo $material_price['denim']['name']; ?>" placeholder="Enter Material Name" /></td>
						<td><input class="replace_slug" type="text" name="clothoo[material][denim][price]" value="<?php echo $material_price['denim']['price']; ?>" placeholder="e.g. 300" /></td>
					</tr>
					
					<tr>
						<td><input class="input" type="text" name="clothoo[material][satin][name]" value="<?php echo $material_price['satin']['name']; ?>" placeholder="Enter Material Name" /></td>
						<td><input class="replace_slug" type="text" name="clothoo[material][satin][price]" value="<?php echo $material_price['satin']['price']; ?>" placeholder="e.g. 300" /></td>
					</tr>

					<tr>
						<td><input class="input" type="text" name="clothoo[material][poly_cotton_twill][name]" value="<?php echo $material_price['poly_cotton_twill']['name']; ?>" placeholder="Enter Material Name" /></td>
						<td><input class="replace_slug" type="text" name="clothoo[material][poly_cotton_twill][price]" value="<?php echo $material_price['poly_cotton_twill']['price']; ?>" placeholder="e.g. 300" /></td>
					</tr>
					
					
				</tbody>
				
				
			</table>
		</div>
		
		<div class="col col-2">
			<h3>Sleeves Material Prices</h3>
			<hr />
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">Name</th>
						<th style="text-align: left;">Price (in USD)</th>
						
					</tr>
				</thead>
				
				<tbody id="color_code">
					
					
					<tr>
						<td><input class="input" type="text" name="clothoo[smaterial][wool][name]" value="<?php echo $smaterial_price['wool']['name']; ?>" placeholder="Enter Material Name" /></td>
						<td><input class="replace_slug" type="text" name="clothoo[smaterial][wool][price]" value="<?php echo $smaterial_price['wool']['price']; ?>" placeholder="e.g. 300" /></td>
						
					</tr>
					
					<tr>
						<td><input class="input" type="text" name="clothoo[smaterial][leather][name]" value="<?php echo $smaterial_price['leather']['name']; ?>" placeholder="Enter Material Name" /></td>
						<td><input class="replace_slug" type="text" name="clothoo[smaterial][leather][price]" value="<?php echo $smaterial_price['leather']['price']; ?>" placeholder="e.g. 300" /></td>
						
					</tr>
					
					<tr>
						<td><input class="input" type="text" name="clothoo[smaterial][fleather][name]" value="<?php echo $smaterial_price['fleather']['name']; ?>" placeholder="Enter Material Name" /></td>
						<td><input class="replace_slug" type="text" name="clothoo[smaterial][fleather][price]" value="<?php echo $smaterial_price['fleather']['price']; ?>" placeholder="e.g. 300" /></td>
						
					</tr>
					
					<tr>
						<td><input class="input" type="text" name="clothoo[smaterial][cotton][name]" value="<?php echo $smaterial_price['cotton']['name']; ?>" placeholder="Enter Material Name" /></td>
						<td><input class="replace_slug" type="text" name="clothoo[smaterial][cotton][price]" value="<?php echo $smaterial_price['cotton']['price']; ?>" placeholder="e.g. 300" /></td>
					</tr>
					
					<tr>
						<td><input class="input" type="text" name="clothoo[smaterial][satin][name]" value="<?php echo $smaterial_price['satin']['name']; ?>" placeholder="Enter Material Name" /></td>
						<td><input class="replace_slug" type="text" name="clothoo[smaterial][satin][price]" value="<?php echo $smaterial_price['satin']['price']; ?>" placeholder="e.g. 300" /></td>
					</tr>
					
					<tr>
						<td><input class="input" type="text" name="clothoo[smaterial][denim][name]" value="<?php echo $smaterial_price['denim']['name']; ?>" placeholder="Enter Material Name" /></td>
						<td><input class="replace_slug" type="text" name="clothoo[smaterial][denim][price]" value="<?php echo $smaterial_price['denim']['price']; ?>" placeholder="e.g. 300" /></td>
					</tr>
					
					<tr>
						<td><input class="input" type="text" name="clothoo[smaterial][poly_cotton_twill][name]" value="<?php echo $smaterial_price['poly_cotton_twill']['name']; ?>" placeholder="Enter Material Name" /></td>
						<td><input class="replace_slug" type="text" name="clothoo[smaterial][poly_cotton_twill][price]" value="<?php echo $smaterial_price['poly_cotton_twill']['price']; ?>" placeholder="e.g. 300" /></td>
					</tr>
					
				</tbody>
				
				
			</table>
		</div>
		
		<div class="clear"></div>
	</div>
	
	<div class="row col3" style="margin-bottom: 25px;">
		<div class="col col-1">
			<h3>Hood Colors</h3>
			<hr />
			<table>
				<thead>
					<tr>
						<th style="text-align: left;">Name</th>
						<th style="text-align: left;">Code</th>
						<th style="text-align: left;">Order</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				
				<tbody id="color_code">
					
					<?php $i=0; foreach($hood_color as $color) {?>
					<tr>
						<td><input class="color_name" type="text" name="clothoo[hood_color][<?php echo $i; ?>][name]" value="<?php echo $color['name']; ?>" placeholder="Enter Color Name" /></td>
						<td><input class="color_code" type="text" name="clothoo[hood_color][<?php echo $i; ?>][code]" value="<?php echo $color['code']; ?>" placeholder="e.g. #ccc" /></td>
						<td><input class="color_order" type="text" name="clothoo[hood_color][<?php echo $i; ?>][order]" value="<?php echo $color['order']; ?>" placeholder="Order" /></td>
						<td><a class="remove_row" href="#">Remove</a></td>
					</tr>
					<?php $i++; } ?>
				</tbody>
				
				<tfoot>
					<tr>
						<td colspan="3">
							<a class="add_row" href="#">Add Color</a>
						</td>
					</tr>
				</tfoot>
				
			</table>
		</div>
		
		<div class="col col-2"></div>
		
		<div class="col col-3"></div>
		
		<div class="clear"></div>
	</div>
	
	<p class="submit">
		<input type="submit" value="Save Changes" class="button button-primary" id="submit" name="">
	</p>
</form>

<script>
jQuery(document).ready(function($) {
	
	$(document).on("click",".remove_row",function() {
		$(this).parent().parent().remove();
		return false;
	});
	
	$(document).on("click",".add_row",function() {
		var tbody = $(this).parent().parent().parent().parent().find("tbody");
		var total_tr = tbody.find("tr").length;
		var total_tr_minus = total_tr-1;
		
		var row_html = tbody.find("tr:last-child").clone();
		
		row_html.find("input").each(function() {
			var attr_name = $(this).attr("name");
			row_html.find("input[name='"+attr_name+"']").attr("name",attr_name.replace("["+total_tr_minus+"]","["+total_tr+"]").replace('value="'+total_tr_minus+'"','value="'+total_tr+'"'));
		});
		row_html.find("input[type='text']").val('');
		tbody.append(row_html);
		
		//tbody.append(row_html).replace("["+total_tr_minus+"]","["+total_tr+"]").replace('value="'+total_tr_minus+'"','value="'+total_tr+'"');
		
		return false;
	});
	
	$(document).on("keyup","input.create_name_as_slug",function() {
		
		var value = $(this).val();
		var slug = value.toLowerCase().replace(" ","_");
		
		// Replace Current Slug
		var get_current_format = $(this).data("format");
		var replaced_name = get_current_format.replace("[]","["+slug+"]");
		$(this).attr("name",replaced_name);
		
		// Do on all Brothers & Sisters
		var parent_elem = $(this).parent().parent();
		parent_elem.find(".replace_slug").each(function() {
			var get_current_format = $(this).data("format");
			var replaced_name = get_current_format.replace("[]","["+slug+"]");
			$(this).attr("name",replaced_name);
		});
		
	});
	
	$(document).on("keyup","input.color_order",function() {
		var number = $(this).val();
		var this_name = $(this).attr("name").replace(/\[\d+\]/g,"["+number+"]").replace("[]","["+number+"]");
		$(this).attr("name",this_name);
		
		
		$(this).parent().parent().find("input").each(function() {
			var this_name = $(this).attr("name").replace(/\[\d+\]/g,"["+number+"]").replace("[]","["+number+"]");
			$(this).attr("name",this_name);
		});
	});
	
});
</script>
