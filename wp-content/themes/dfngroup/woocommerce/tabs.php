<?php

function woocommerce_product_sizing_tab() {
	global $post;
	/*$html = "";
	for($i = 1; $i <=10; $i++) {
		$size = get_post_meta($post->ID, "wpcf-size$i", true);
		if(!empty($size)) {
			$html .= '<li class="one-fourth' . ($i == 1 || $i % 4 == 1 ? " first" : "" ).'">'.$size.'</li>';
		}
	}
	
	if( empty($html) ) {
		for($i = 1; $i <=10; $i++) {
			$size = get_post_meta(1217, "wpcf-size$i", true);
			if(!empty($size)) {
				$html .= '<li class="one-fourth' . ($i == 1 || $i % 4 == 1 ? " first" : "" ).'">'.$size.'</li>';
			}
		}
	}*/
	?>
	
	<div class="wrap">
	<ul class="sizing clearfix">
		
			<div class="white-area" style="padding-top: 0px; border-top: 0px none; padding-bottom: 0px;" >
		<div class="wrap" id="size-chart-table">
			<h1 class="text-center">Varsity (letterman ) jackets' size chart</h1>
			<p class="text-center">To find out your measurement, please measure your chest/bust circumference as shown below . You then match it with the size in the table<br />below. Note: Please allow a human error margin up to
			1 inch=2.54 cm - Please refer to our Return Policy prior to placing your order.</p>
			
			<h6 class="text-uppercase">SIZE Chart For Men</h6>
			<table class="table size-table">
				<thead>
					<tr>
						<th>Sizes</th>
						<th>Adult XS</th>
						<th>Adult S</th>
						
						<th>Adult M</th>
						<th>Adult L</th>
						<th>Adult XL</th>
						
						<th>Adult 2XL</th>
						<th>Adult 3XL</th>
						<th>Adult 4XL</th>
						
						<th>Adult 5XL</th>
						<th>Adult 6XL</th>
						<th>UOM</th>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<th>Chest</th>
						<td>108</td>
						<td>112</td>
						
						<td>116</td>
						<td>120</td>
						<td>124</td>
						
						<td>128</td>
						<td>132</td>
						<td>136</td>
						
						<td>140</td>
						<td>114</td>
						<th>CM</th>
					</tr>
					
					<tr>
						<th>Bottom</th>
						<td>104</td>
						<td>108</td>
						
						<td>112</td>
						<td>116</td>
						<td>120</td>
						
						<td>124</td>
						<td>128</td>
						<td>132</td>
						
						<td>136</td>
						<td>140</td>
						<th>CM</th>
					</tr>
					
					<tr>
						<th>Back Length</th>
						<td>61</td>
						<td>64</td>
						
						<td>67</td>
						<td>70</td>
						<td>73</td>
						
						<td>76</td>
						<td>79</td>
						<td>82</td>
						
						<td>85</td>
						<td>88</td>
						<th>CM</th>
					</tr>
					
					<tr>
						<th>Sleeves Length</th>
						<td>54</td>
						<td>57</td>
						
						<td>60</td>
						<td>63</td>
						<td>66</td>
						
						<td>69</td>
						<td>72</td>
						<td>75</td>
						
						<td>78</td>
						<td>81</td>
						<th>CM</th>
					</tr>
				</tbody>
			</table>
			
			<h6 class="text-uppercase">SIZE Chart For WOMEN</h6>
			<table class="table size-table">
				<thead>
					<tr>
						<th>Sizes</th>
						<th>Adult XS</th>
						<th>Adult S</th>
						
						<th>Adult M</th>
						<th>Adult L</th>
						<th>Adult XL</th>
						
						<th>Adult 2XL</th>
						<th>Adult 3XL</th>
						<th>Adult 4XL</th>
						
						<th>Adult 5XL</th>
						<th>Adult 6XL</th>
						<th>UOM</th>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<th>Chest</th>
						<td>96</td>
						<td>100</td>
						
						<td>104</td>
						<td>108</td>
						<td>112</td>
						
						<td>116</td>
						<td>120</td>
						<td>124</td>
						
						<td>128</td>
						<td>132</td>
						<th>CM</th>
					</tr>
					
					<tr>
						<th>Bottom</th>
						<td>92</td>
						<td>96</td>
						
						<td>100</td>
						<td>104</td>
						<td>108</td>
						
						<td>112</td>
						<td>116</td>
						<td>120</td>
						
						<td>124</td>
						<td>128</td>
						<th>CM</th>
					</tr>
					
					<tr>
						<th>Back Length</th>
						<td>54</td>
						<td>57</td>
						
						<td>60</td>
						<td>63</td>
						<td>66</td>
						
						<td>69</td>
						<td>72</td>
						<td>75</td>
						
						<td>78</td>
						<td>81</td>
						<th>CM</th>
					</tr>
					
					<tr>
						<th>Sleeves Length</th>
						<td>54</td>
						<td>56</td>
						
						<td>58</td>
						<td>60</td>
						<td>62</td>
						
						<td>64</td>
						<td>66</td>
						<td>68</td>
						
						<td>70</td>
						<td>72</td>
						<th>CM</th>
					</tr>
				</tbody>
			</table>
			
		</div>
	</div>
		
	</ul>
	</div>
	
<?php }

function woocommerce_product_care_tab() {
	global $post; 
	
	$care = get_post_meta($post->ID, "wpcf-care", true);
	
	if(empty($care)) {
		$product_terms = wp_get_object_terms( get_the_ID(),  'product_cat' );
		
		if( empty($product_terms) || is_object_in_term( get_the_ID(), 'product_cat', 'custom' ) ) {
			$care = get_post_meta(1217, "wpcf-care", true);
		}
	}
	?>
	<div class="wrap_570">
	<?php echo wpautop($care); ?>
	</div>
<?php }

function woocommerce_product_shipping_tab() { 
	global $post;
	
	$shipping = get_post_meta($post->ID, "wpcf-shipping", true);
	
	if(empty($shipping)) {
		$product_terms = wp_get_object_terms( get_the_ID(),  'product_cat' );
		
		if( empty($product_terms) || is_object_in_term( get_the_ID(), 'product_cat', 'custom' ) ) {
			$shipping = get_post_meta(1217, "wpcf-shipping", true);
		}
	}
	echo wpautop($shipping);
}

function woocommerce_product_custom_content_tab() {
	
	$post = get_post(1217);
	
	$content = $post->post_content;
	
	echo wpautop($content);
	
}