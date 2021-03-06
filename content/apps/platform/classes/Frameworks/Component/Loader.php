<?php
//
//    ______         ______           __         __         ______
//   /\  ___\       /\  ___\         /\_\       /\_\       /\  __ \
//   \/\  __\       \/\ \____        \/\_\      \/\_\      \/\ \_\ \
//    \/\_____\      \/\_____\     /\_\/\_\      \/\_\      \/\_\ \_\
//     \/_____/       \/_____/     \/__\/_/       \/_/       \/_/ /_/
//
//   上海商创网络科技有限公司
//
//  ---------------------------------------------------------------------------------
//
//   一、协议的许可和权利
//
//    1. 您可以在完全遵守本协议的基础上，将本软件应用于商业用途；
//    2. 您可以在协议规定的约束和限制范围内修改本产品源代码或界面风格以适应您的要求；
//    3. 您拥有使用本产品中的全部内容资料、商品信息及其他信息的所有权，并独立承担与其内容相关的
//       法律义务；
//    4. 获得商业授权之后，您可以将本软件应用于商业用途，自授权时刻起，在技术支持期限内拥有通过
//       指定的方式获得指定范围内的技术支持服务；
//
//   二、协议的约束和限制
//
//    1. 未获商业授权之前，禁止将本软件用于商业用途（包括但不限于企业法人经营的产品、经营性产品
//       以及以盈利为目的或实现盈利产品）；
//    2. 未获商业授权之前，禁止在本产品的整体或在任何部分基础上发展任何派生版本、修改版本或第三
//       方版本用于重新开发；
//    3. 如果您未能遵守本协议的条款，您的授权将被终止，所被许可的权利将被收回并承担相应法律责任；
//
//   三、有限担保和免责声明
//
//    1. 本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的；
//    2. 用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未获得商业授权之前，我们不承
//       诺提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任；
//    3. 上海商创网络科技有限公司不对使用本产品构建的商城中的内容信息承担责任，但在不侵犯用户隐
//       私信息的前提下，保留以任何方式获取用户信息及商品信息的权利；
//
//   有关本产品最终用户授权协议、商业授权与技术服务的详细内容，均由上海商创网络科技有限公司独家
//   提供。上海商创网络科技有限公司拥有在不事先通知的情况下，修改授权协议的权力，修改后的协议对
//   改变之日起的新授权用户生效。电子文本形式的授权协议如同双方书面签署的协议一样，具有完全的和
//   等同的法律效力。您一旦开始修改、安装或使用本产品，即被视为完全理解并接受本协议的各项条款，
//   在享有上述条款授予的权力的同时，受到相关的约束和限制。协议许可范围以外的行为，将直接违反本
//   授权协议并构成侵权，我们有权随时终止授权，责令停止损害，并保留追究相关责任的权力。
//
//  ---------------------------------------------------------------------------------
//
namespace Ecjia\App\Platform\Frameworks\Component;

use RC_App;
use RC_Hook;
use RC_Script;
use RC_Style;

class Loader {
	/**
	 * Register all ECJia scripts.
	 *
	 * Localizes some of them.
	 * args order: $scripts->add( 'handle', 'url', 'dependencies', 'query-string', 1 );
	 * when last arg === 1 queues the script for the footer
	 *
	 * @since 1.0.0
	 *
	 * @param object $scripts WP_Scripts object.
	 */
	public static function default_scripts( &$scripts ) {
	    $base_url = dirname(dirname(dirname(RC_App::app_dir_url(__FILE__)))) . '/statics';

		$scripts->remove('jquery');
		$scripts->remove('bootstrap');

		$scripts->add( 'ecjia-platform-vendors', 	                $base_url.'/platform/vendors/js/vendors.min.js');
		$scripts->add( 'jquery', 			                        $base_url.'/platform/js/core/libraries/jquery.min.js' );
		
		$scripts->add( 'ecjia-platform-jquery-pjax',                $base_url.'/platform/js/jquery-pjax.js' );
		
		$scripts->add( 'ecjia-platform', 			                $base_url.'/ecjia/ecjia-platform.js', array('jquery', 'ecjia') );
		$scripts->add( 'ecjia-platform-ui',			                $base_url.'/ecjia/ecjia-platform-ui.js', array('jquery', 'ecjia') );
		
		
		$scripts->add( 'ecjia-platform-jquery-sticky', 	            $base_url.'/platform/vendors/js/ui/jquery.sticky.js', array(), false, 1 );
		$scripts->add( 'ecjia-platform-headroom', 		            $base_url.'/platform/vendors/js/ui/headroom.min.js', array(), false, 1 );
		$scripts->add( 'ecjia-platform-jquery-knob',                $base_url.'/platform/vendors/js/extensions/jquery.knob.min.js', array(), false, 1 );
		$scripts->add( 'ecjia-platform-knob',  			            $base_url.'/platform/js/scripts/extensions/knob.js', array(), false, 1 );
		
		$scripts->add( 'ecjia-platform-jquery-sparkline',   		$base_url.'/platform/vendors/js/charts/jquery.sparkline.min.js', array(), false, 1 );
		$scripts->add( 'ecjia-platform-unslider',  					$base_url.'/platform/vendors/js/extensions/unslider-min.js', array(), false, 1 );
		$scripts->add( 'ecjia-platform-app-menu', 					$base_url.'/platform/js/core/app-menu.js', array(), false, 1 );
		$scripts->add( 'ecjia-platform-app',    					$base_url.'/platform/js/core/app.js', array(), false, 1 );
		$scripts->add( 'ecjia-platform-customizer',					$base_url.'/platform/js/scripts/customizer.js', array(), false, 1 );
		$scripts->add( 'ecjia-platform-breadcrumbs-with-stats',    	$base_url.'/platform/js/scripts/ui/breadcrumbs-with-stats.js', array(), false, 1 );
		
		$scripts->add( 'ecjia-platform-components-modal',    	    $base_url.'/platform/js/scripts/modal/components-modal.js', array(), false, 1 );
		
		$scripts->add( 'ecjia-platform-jquery-migrate',   			$base_url.'/platform/js/jquery-migrate.min.js', array('jquery'), false, 1 );
		
		$scripts->add( 'ecjia-platform-select-full',    			$base_url.'/platform/vendors/js/forms/select/select2.full.min.js', array(), false, 1 );
		$scripts->add( 'ecjia-platform-form-select',    					$base_url.'/platform/js/scripts/forms/select/form-select2.js', array(), false, 1 );
		$scripts->add( 'ecjia-platform-bootstrap-fileupload-js',	$base_url.'/platform/lib/bootstrap-fileupload/bootstrap-fileupload.js', array(), false, 1 );

		$scripts->add( 'ecjia-platform-jquery-quicksearch',   		$base_url.'/platform/js/jquery.quicksearch.js', array('jquery'), false, 1 );
		
		$scripts->add( 'ecjia-platform-sweetalert',   				$base_url.'/platform/vendors/js/extensions/sweetalert.min.js', array(), false, 1 );
		$scripts->add( 'ecjia-platform-sweet',   					$base_url.'/platform/js/scripts/extensions/sweet-alerts.js', array(), false, 1 );
	}


	/**
	 * Assign default styles to $styles object.
	 *
	 * Nothing is returned, because the $styles parameter is passed by reference.
	 * Meaning that whatever object is passed will be updated without having to
	 * reassign the variable that was passed back to the same value. This saves
	 * memory.
	 *
	 * Adding default styles is not the only task, it also assigns the base_url
	 * property, the default version, and text direction for the object.
	 *
	 * @since 1.0.0
	 *
	 * @param object $styles
	 */
	public static function default_styles( &$styles ) {
	    $base_url = dirname(dirname(dirname(RC_App::app_dir_url(__FILE__)))) . '/statics';

		$styles->remove('bootstrap');
		$styles->remove('bootstrap-reset');

		$styles->add( 'ecjia-platform-ui', 					    $base_url."/platform/css/ecjia-platform.ui.css" );
		// $styles->add( 'ecjia-platform-googleapis',			$base_url."/platform/css/googleapis.css" );
		$styles->add( 'ecjia-platform-vendors',           	    $base_url."/platform/css/vendors.css" );
		$styles->add( 'ecjia-platform-jquery-jvectormap', 	    $base_url."/platform/vendors/css/charts/jquery-jvectormap-2.0.3.css" );
		$styles->add( 'ecjia-platform-morris',		      	    $base_url."/platform/vendors/css/charts/morris.css" );
		$styles->add( 'ecjia-platform-unslider',          	    $base_url."/platform/vendors/css/extensions/unslider.css" );
		$styles->add( 'ecjia-platform-climacons',         	    $base_url."/platform/vendors/css/weather-icons/climacons.min.css" );
		$styles->add( 'ecjia-platform-select',         		  	$base_url."/platform/vendors/css/forms/selects/select2.min.css" );
		$styles->add( 'ecjia-platform-app',               	    $base_url."/platform/css/app.css" );
		
		$styles->add( 'ecjia-platform-function',      			$base_url."/platform/css/ecjia.function.css" );
		
		$styles->add( 'ecjia-platform-vertical-content-menu', 	$base_url."/platform/css/core/menu/menu-types/vertical-content-menu.css" );
		$styles->add( 'ecjia-platform-palette-gradient',     	$base_url."/platform/css/core/colors/palette-gradient.css" );
		$styles->add( 'ecjia-platform-clndr',   				$base_url."/platform/css/plugins/calendars/clndr.css" );
		$styles->add( 'ecjia-platform-palette-climacon',    	$base_url."/platform/css/core/colors/palette-climacon.css" );
		$styles->add( 'ecjia-platform-users',         		  	$base_url."/platform/css/pages/users.css" );
		
		
		$styles->add( 'ecjia-platform-bootstrap-fileupload-css',	$base_url.'/platform/lib/bootstrap-fileupload/bootstrap-fileupload.css');
	}


	/**
	 * Hooks to print the scripts and styles in the footer.
	 *
	 * @since 1.0.0
	 */
	public static function admin_print_footer_scripts() {
		/**
		 * Fires when footer scripts are printed.
		 *
		 * @since 1.0.0
		 */
		RC_Hook::do_action( 'admin_print_footer_scripts' );
	}

	/**
	 * Wrapper for do_action('enqueue_scripts')
	 *
	 * Allows plugins to queue scripts for the front end using wp_enqueue_script().
	 * Runs first in admin_head() where all is_home(), is_page(), etc. functions are available.
	 *
	 * @since 1.0.0
	 */
	public static function admin_enqueue_scripts() {
		/**
		 * Fires when scripts and styles are enqueued.
		 *
		 * @since 1.0.0
		 */
		RC_Hook::do_action( 'admin_enqueue_scripts' );
	}


	/**
	 * Prints the script queue in the HTML head on admin pages.
	 *
	 * Postpones the scripts that were queued for the footer.
	 * print_footer_scripts() is called in the footer to print these scripts.
	 *
	 * @since 1.0.0
	 *
	 * @see admin_print_scripts()
	 */
	public static function print_head_scripts() {
		if ( ! RC_Hook::did_action('rc_print_scripts') ) {
			RC_Hook::do_action( 'rc_print_scripts' );
		}

		RC_Script::instance()->do_head_items();

		/**
		 * Filter whether to print the head scripts.
		 *
		 * @since 1.0.0
		 *
		 * @param bool $print Whether to print the head scripts. Default true.
		*/
		if ( RC_Hook::apply_filters( 'print_head_scripts', true ) ) {
			self::_print_scripts();
		}

		RC_Script::instance()->reset();
		return RC_Script::instance()->done;
	}


	/**
	 * Prints the scripts that were queued for the footer or too late for the HTML head.
	 *
	 * @since 1.0.0
	 */
	public static function print_footer_scripts() {
// 		if ( !is_a($wp_scripts, 'WP_Scripts') )
// 			return array(); // No need to run if not instantiated.

// 		script_concat_settings();
// 		$wp_scripts->do_concat = $concatenate_scripts;
		RC_Script::instance()->do_footer_items();

		/**
		 * Filter whether to print the footer scripts.
		 *
		 * @since 1.0.0
		 *
		 * @param bool $print Whether to print the footer scripts. Default true.
		*/
		if ( RC_Hook::apply_filters( 'print_footer_scripts', true ) ) {
			self::_print_scripts();
		}

		RC_Script::instance()->reset();
		return RC_Script::instance()->done;
	}


	/**
	 * @internal use
	 */
	public static function _print_scripts() {

		// 		$zip = $compress_scripts ? 1 : 0;
		// 		if ( $zip && defined('ENFORCE_GZIP') && ENFORCE_GZIP )
			// 			$zip = 'gzip';

		// 		if ( $concat = trim( $wp_scripts->concat, ', ' ) ) {

		// 			if ( !empty($wp_scripts->print_code) ) {
		// 				echo "\n<script type='text/javascript'>\n";
		// 				echo "/* <![CDATA[ */\n"; // not needed in HTML 5
		// 				echo $wp_scripts->print_code;
		// 				echo "/* ]]> */\n";
		// 				echo "</script>\n";
		// 			}

		// 			$concat = str_split( $concat, 128 );
		// 			$concat = 'load%5B%5D=' . implode( '&load%5B%5D=', $concat );

		// 			$src = $wp_scripts->base_url . "/wp-admin/load-scripts.php?c={$zip}&" . $concat . '&ver=' . $wp_scripts->default_version;
		// 			echo "<script type='text/javascript' src='" . esc_attr($src) . "'></script>\n";
		// 		}

		if ( !empty(RC_Script::instance()->print_html) )
				echo RC_Script::instance()->print_html;
	}


	/**
	 * for use in *_footer_scripts hooks
	 *
	 * @since 1.0.0
	 */
	public static function _admin_footer_scripts() {
		self::print_late_styles();
		self::print_footer_scripts();
	}


	/**
	 * Prints the styles queue in the HTML head on admin pages.
	 *
	 * @since 1.0.0
	 */
	public static function print_admin_styles() {
// 		global $wp_styles, $concatenate_scripts, $compress_css;

// 		if ( !is_a($wp_styles, 'WP_Styles') )
// 			$wp_styles = new WP_Styles();

// 		script_concat_settings();
// 		RC_Style::instance()->do_concat = $concatenate_scripts;
// 		$zip = $compress_css ? 1 : 0;
// 		if ( $zip && defined('ENFORCE_GZIP') && ENFORCE_GZIP )
// 			$zip = 'gzip';

		RC_Style::instance()->do_items(false);

		/**
		 * Filter whether to print the admin styles.
		 *
		 * @since 1.0.0
		 *
		 * @param bool $print Whether to print the admin styles. Default true.
		*/
		if ( RC_Hook::apply_filters( 'print_admin_styles', true ) ) {
			self::_print_styles();
		}

		RC_Style::instance()->reset();
		return RC_Style::instance()->done;
	}


	/**
	 * Prints the styles that were queued too late for the HTML head.
	 *
	 * @since 1.0.0
	 */
	public static function print_late_styles() {
// 		global $wp_styles, $concatenate_scripts;

// 		if ( !is_a($wp_styles, 'WP_Styles') )
// 			return;

// 		RC_Style::instance()->do_concat = $concatenate_scripts;
		RC_Style::instance()->do_footer_items();

		/**
		 * Filter whether to print the styles queued too late for the HTML head.
		 *
		 * @since 1.0.0
		 *
		 * @param bool $print Whether to print the 'late' styles. Default true.
		*/
		if ( RC_Hook::apply_filters( 'print_late_styles', true ) ) {
			self::_print_styles();
		}

		RC_Style::instance()->reset();
		return RC_Style::instance()->done;
	}


	/**
	 * @internal use
	 */
	public static function _print_styles() {
// 		global $wp_styles, $compress_css;

// 		$zip = $compress_css ? 1 : 0;
// 		if ( $zip && defined('ENFORCE_GZIP') && ENFORCE_GZIP )
// 			$zip = 'gzip';

		if ( !empty(RC_Style::instance()->concat) ) {
// 			$dir = RC_Style::instance()->text_direction;
// 			$ver = RC_Style::instance()->default_version;
// 			$href = RC_Style::instance()->base_url . "/wp-admin/load-styles.php?c={$zip}&dir={$dir}&load=" . trim(RC_Style::instance()->concat, ', ') . '&ver=' . $ver;
// 			echo "<link rel=\"stylesheet\" href=\"" . RC_Format::esc_attr($href) . "\" type=\"text/css\" media=\"all\" />\n";

			if ( !empty(RC_Style::instance()->print_code) ) {
				echo "<style type='text/css'>\n";
				echo RC_Style::instance()->print_code;
				echo "\n</style>\n";
			}
		}

		if ( !empty(RC_Style::instance()->print_html) )
			echo RC_Style::instance()->print_html;
	}

}

// end
