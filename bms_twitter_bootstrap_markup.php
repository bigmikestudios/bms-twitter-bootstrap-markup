<?php

/*
Plugin Name: BMS Twitter Bootstrap Markup
Plugin URI: http://bigmikestudios.com
Description: Creates a shortcodes to display twitter bootstrap scaffolding.
Version: 0.0.1
Author URI: http://bigmikestudios.com
*/

/*

An example of how to enter these shortcodes into the editor:

[tbmu_row]

[tbmu_span cols="4"]

here is my first column.

[/tbmu_span]

[tbmu_span cols="4"]

here is my second column.

[/tbmu_span]

[/tbmu_row]

*/


$cr = "\r\n"; 


// shortcode for row div
function tbmu_row ($atts, $content=null)
{
	extract( shortcode_atts( array(
      'parameter' => 'default',
      ), $atts ) );
	
	//error_log("===================== content remove everything outside of span shortcodes! \n$content");
	$string = $content;
	$pattern = "/\[tbmu_span.*?\[\/tbmu_span\]/s";
	preg_match_all($pattern, $string, $matches);
	$content = "";
	foreach($matches[0] as $tag) {
		$content .= $tag . $cr;
	}
	
	//error_log("===================== content before do_shortcode! \n$content");
	$content = do_shortcode($content);
	 
	$return = "";
	$return .= "<div class='row'>\n";
	$return .= do_shortcode($content);
	$return .= "</div><!-- /.row -->\n";
	
	//error_log("===================== return! \n$return");
	return $return;
	
}
add_shortcode('tbmu_row', 'tbmu_row');

// shortcode for span div
function tbmu_span ($atts, $content=null)
{
	extract( shortcode_atts( array(
      'cols' => '1',
      ), $atts ) );
	
	$content = ltrim($content, "</p>");
	$content = rtrim($content, "<p>");	
	
	$return = "";
	$return .= "<div class='span$cols'>";
	$return .= do_shortcode($content);
	$return .= "</div><!-- /.span$cols -->\n";
	//error_log("===================== tbmu span called! \n$return");

	return $return;
	
}
add_shortcode('tbmu_span', 'tbmu_span');
?>