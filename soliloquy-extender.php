<?php
/**
 * Plugin Name: Soliloquy Extender
 * Description: Extends Soliloquy to compensate for custom slides
 * Version: 1.0.0
 * Author: Nick Wisehart
 * Author URI: http://nickwisehart.com/
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */
// global $Soliloquy_Extender;
// $Soliloquy_Extender = new Soliloquy_Extender;
// class Soliloquy_Extender {
//     private $textdomain = "soliloquy-extender";
//     private $required_plugins = array('soliloquy-lite');
//     function have_required_plugins() {
//         if (empty($this->required_plugins))
//             return true;
//         $active_plugins = (array) get_option('active_plugins', array());
//         if (is_multisite()) {
//             $active_plugins = array_merge($active_plugins, get_site_option('active_sitewide_plugins', array()));
//         }
//         foreach ($this->required_plugins as $key => $required) {
//             $required = (!is_numeric($key)) ? "{$key}/{$required}.php" : "{$required}/{$required}.php";
//             if (!in_array($required, $active_plugins) && !array_key_exists($required, $active_plugins))
//                 return false;
//         }
//         return true;
//     }
//     function __construct() {
//         if (!$this->have_required_plugins())
//             return;
//         //load_plugin_textdomain($this->textdomain, false, dirname(plugin_basename(__FILE__)) . '/languages');

//     }
// }


add_action( 'wp_head', 'my_header_scripts' );


function my_header_scripts(){
  ?>
  <script>
    window.onload = function(){
        var body = document.getElementsByTagName("body")[0];
        var isMobile = (window.innerWidth < 600);
        var spacer = ( !isMobile ) ? 50 : 10;
        if (body.classList.contains("home")){
            //logo
            var logoPath = "<?php echo plugin_dir_url( __FILE__ ) . 'assets/the-mandagies-1024x328.png'; ?>";
            var img = document.createElement("img");
            var attSrc = document.createAttribute("src");
            var attId = document.createAttribute("id");
            attSrc.value = logoPath;
            attId.value = "header-logo";
            img.setAttributeNode(attSrc);
            img.setAttributeNode(attId);
            document.getElementsByClassName("soliloquy-wrapper")[0].appendChild(img);

            //set background of site inner to match body
            var style = window.getComputedStyle(body)
            var image =style.getPropertyValue('background-image');
            console.log(image);
            document.getElementsByClassName("site-inner")[0].style.backgroundImage = image; //didnt work
            
            //auto set height of logo based of header
            var height = document.getElementsByClassName("home-slider-container")[0].offsetTop;
            document.getElementById("header-logo").style.top = (height + spacer) + "px";
        }
        //console.log(body);
    }

    // if( $('body').hasClass('home') ) {
    //     //set background of site inner to match body
    //     var background = $('body').css('background-image');
    //     $('.site-inner').css('background-image', background);
    //     //auto set height of logo based of header
    //     var height = $('.home-slider-container').offset().top;
    //     console.log(height);
    // }
    //$('#soliloquy-container-4 .soliloquy-wrapper').toggleClass('hide-logo');
  </script>
  <style>
    /**logo**/
    #header-logo {
        position: fixed;
        display: block;
        width: 50%;
        max-width: 1024px;
        height: auto;
        top: -328px; /*initial position*/
        z-index: 1;
        left: 50%; 
        -webkit-transform: translate(-50%, 0);
        -ms-transform: translate(-50%, 0);
        transform: translate(-50%, 0);
        -webkit-transition: all 1s ease-in;
        transition: all 1s ease-in;
    }
    header.site-header {
        z-index: 1;
        position: relative;
    }
    div.site-inner {
        z-index: 1;
        position: relative; 
        /*background-image: url();*/
        background-position: left top;
        background-size: auto;
        background-repeat: repeat;
        background-attachment: scroll;
    }
    #soliloquy-container-4 .soliloquy-wrapper:after {
        content: "";
        display: block;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0; 
        /*background-image: url("http://localhost:8888/wp-content/uploads/2018/02/foreground_large.png");*/
        background-repeat: no-repeat;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
        background-position: bottom center;
        z-index: 2;
    }
    #soliloquy-container-4 .slide-overlay .soliloquy-image {
        /*opacity: 0.6;*/
    }
  </style> 
  <?php
}


?>