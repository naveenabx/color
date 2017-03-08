<?php
   /*
   Plugin Name: Palette Colorizer   
   Description: Palette Colorizer helps you to make beautiful complementary color schemes for your WordPress website by utilizing the Paletton engine. The free version of Palette Colorizer allows you to create a custom color palette of up to five colors! Your beautiful custom colors are then accessible on any page from the WordPress admin bar, so that you can easily colorize a template, tables, text, borders, anything that you may want to apply a unified color scheme to on your website. The RGB codes for your selected colors are easily accessible, so that you can use the same color scheme across all your projects! Simply download and install Palette Colorizer to your WordPress installation, and the Palette Colorizer color wheel selector will be added to the Tools section of your site's admin panel. 
   * Version: 0.0.1
   * Author: Trident Embedded Solutions, LLC
   Author URI: https://profiles.wordpress.org/tesplugins/
    */
 /*Add menu unser the tool option*/
   


   
add_action('admin_menu', 'add_submenu_item');
 
function add_submenu_item()
{
     add_submenu_page( 'tools.php', 'Palette Colorizer', 'Palette Colorizer', 'manage_options', 'my-tool', 'display_page');
     // or
     // add_management_page( 'My Tool', 'My Tool', 'manage_options', 'my-tool', 'display_page' );
}

function display_page()
{
	?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<?php
//wp_enqueue_script('test3', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js');
wp_enqueue_script('test', plugin_dir_url(__FILE__) . 'js/widget.js');
wp_enqueue_script('test1', plugin_dir_url(__FILE__) .'js/colorize.js');
wp_enqueue_style('test2', plugin_dir_url(__FILE__).'css/template.css');


?>

<script type="text/javascript">
/* The Colorizer OPTIONS object */

	var colorizerOptions = {

		width:	600,
		/* min width 640 */

		height: 350,
		/* min height 500 */

		dark: false,
		/* or true */

		templateURL: '<?php echo esc_url( plugins_url( 'my.html', __FILE__ ) );?>',
		/* preview document, must be full URL incl. protocol://domain */
		
		paletteUID: 'c4H1T5a2m0kkWkOaJvbg3pIpRfVvjaB',
		/* my hand-picked default palette (single color in this case) */

		colorizeMode: 'class'
		
		/* possible values: class | less | custom */

		}

 /* Get the button in the DOM */
	
	var btn = document.getElementById('col-btn-less');

/* Add onclick event handler */
/* Feel free to use btn.addEventListener() or any other method you prefer */

 $(document).ready(function(){
	
	{
		//e.preventDefault();
		_paletton.open(colorizerOptions, colorizerCallback);
	}
});



/* Your custom callback */
/* This one just gets the Colorizer data and dumps them into the page as a readable text */

 function colorizerCallback(data)
 {
		// data = { colorTable, paletteUID, myData }
		// your code here
	
		var res = document.getElementById('res'), html = '';

		if (!data)
			{
			res.innerHTML = 'cancelled';
			return
			}
		
		colorizerOptions.paletteUID = data.paletteUID;
		/* storing the palette for next time */
		
		function parse(obj,prefix)
		{
		// a dummy recursive parser just to print out the data
			 var k, x, str = '{\n';
			    for (k in obj)
				{
				x = obj[k];
				str += prefix + '   ' + k + ': ';
				if (typeof x==='undefined' || x===null) str += 'null';
				else if (typeof x==='object') str += parse(x, prefix + '   ');
				else str += x;
				str += '\n';
				}
			  str += prefix + '   ' + '}';
			  return str;
		}
	
		html = parse(data,'');
		res.innerHTML = html;

} // callback

console.log(colorizerOptions);
</script>
<?php
}	
?>