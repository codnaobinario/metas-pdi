<?php

/**
 * Plugin Name: PDI - Núcleo Digital (Faculdade)
 * Plugin URI: 
 * Description: Puglin de Plano de Desenvolvimento Institucional
 * Author: Núcleo Digital
 * Author URI: http://nucleodigital.cc
 * Version: 2.0.7
 * License: GPLv2 or later
 * Text Domain: pdi-nucleo-digital
 * 
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

define('PDI_VERSION', '2.0.7');
define('PDI_PATH', plugin_dir_path(__FILE__));
define('PDI_LANG', plugin_dir_path(__FILE__) . '/lang/');
define('PDI_UPLOAD', plugin_dir_path(__FILE__) . '/uploads/');
define('PDI_FRONT', plugin_dir_path(__FILE__) . '/frontend/');
define('PDI_IMAGES', plugins_url('pdi-nucleo-digital/assets/images'));
define('PDI_TEXT_DOMAIN', 'pdi-nucleo-digital');
define('PDI_PLUGIN_URL', plugins_url('/', __FILE__));

// Configurações de Banco de Dados
define('PREFIXO_TABLE', 'pdi_');
define('TABLE_OBJETIVOS_OUSE', 'objetivos_ouse');
define('TABLE_ODS', 'ods');
define('TABLE_PNE', 'pne');
define('TABLE_INDICADORES_ANOS', 'indicadores_anos');
define('TABLE_INDICADORES', 'indicadores');
define('TABLE_GRANDE_TEMA', 'grande_tema');
define('TABLE_EIXO', 'eixo');
define('TABLE_ACOES', 'acoes');
define('TABLE_ATORES', 'atores');
define('TABLE_OBJETIVO_ESPECIFICO', 'objetivo_especifico');
define('TABLE_NOTIFICATION', 'notification');
define('TABLE_COMMENTS', 'comments');
define('TABLE_CONFIGS', 'configs');
define('TABLE_LOGS', 'logs');
define('EMAIL_PDI', 'portalpdi@unifesp.br');

include_once dirname(__FILE__) . '/inc/xlsxwriter.class.php';
include_once dirname(__FILE__) . '/inc/XLSXReader.php';
include_once dirname(__FILE__) . '/includes/class-pdi-db.php';
include_once dirname(__FILE__) . '/includes/class-pdi-menu-admin.php';
include_once dirname(__FILE__) . '/includes/functions.php';
include_once dirname(__FILE__) . '/includes/functions-ajax.php';
include_once dirname(__FILE__) . '/includes/functions-shortcode.php';

/**
 * Funções de ativação do plugin
 */
register_activation_hook(__FILE__, 'pdi_initialize_activation_plugin');

/* function author_admin_notice()
{
	global $pagenow;
	if ($pagenow == 'index.php') {
		$tt = PDI_DB::create_table_configs();
		echo '<div class="notice notice-info is-dismissible">
				<p>' . $tt . '</p>
			 </div>';
	}
}
add_action('admin_notices', 'author_admin_notice'); */

function pdi_initialize_activation_plugin()
{
	PDI_DB::create_table_configs();
	PDI_DB::create_table_logs();
	PDI_DB::create_table_acoes();
	PDI_DB::create_table_eixo();
	PDI_DB::create_table_grande_tema();
	PDI_DB::create_table_indicadores();
	PDI_DB::create_table_indicadores_anos();
	PDI_DB::create_table_objetivos_ouse();
	PDI_DB::create_table_ods();
	PDI_DB::create_table_pne();
	PDI_DB::create_atores();
	PDI_DB::create_table_notification();
	PDI_DB::create_table_comments();

	// Add conteúdos Table
	PDI_DB::insert_configs();
	PDI_DB::insert_grande_tema();
	PDI_DB::insert_objetivos_ouse();
	PDI_DB::insert_ods();
	PDI_DB::insert_pne();
	PDI_DB::insert_atores();
	PDI_DB::insert_eixos();
}

function pdi_enqueue_front()
{
	if (!is_admin()) {
		wp_enqueue_style('pdi_style_front', plugins_url('assets/css/style-front.css', __FILE__), array());
		wp_enqueue_script('pdi_bootstrap_front', plugins_url('assets/js/bootstrap.min.js', __FILE__), array('jquery'));
		wp_enqueue_script('pdi_script_mask', plugins_url('assets/js/jquery.mask.min.js', __FILE__), array('jquery'));
		wp_enqueue_script('pdi_script_chartjs', plugins_url('assets/js/chart.min.js', __FILE__), array('jquery'));
		wp_enqueue_script('pdi_script_function_front', plugins_url('assets/js/functions-front.js', __FILE__), array('jquery'));
		wp_enqueue_script('pdi_script_front', plugins_url('assets/js/script-front.js', __FILE__), array('jquery'));

		$localize = array(
			'ajaxurl' => admin_url('admin-ajax.php'),
		);
		wp_localize_script('pdi_script_function_front', 'pdi_options_object', $localize);


		add_action('wp_head', 'pdi_new_title', 0);
	}
}
add_action('init', 'pdi_enqueue_front');

/**
 * Função de edição de Titulo da página
 */
function pdi_new_title()
{
	if (is_page('detalhes-meta')) {
		$indicador_id = $_GET['indicador_id'];
		$indicador = pdi_get_indicadores(['id' => intval($indicador_id)]);
		echo "<title>Meta {$indicador[0]->id} - {$indicador[0]->titulo}</title>";
	}
}

/**
 * Funções de desativação do plugin
 */
register_deactivation_hook(__FILE__, 'pdi_initialize_deactivation_plugin');
function pdi_initialize_deactivation_plugin()
{
}

add_action('admin_init', 'pdi_init_admin');

function pdi_init_admin()
{
	/**
	 * Enqueue Style
	 */
	wp_enqueue_style('pdi_style_admin', plugins_url('assets/css/style-admin.css', __FILE__), array());


	/**
	 * Enqueue Script
	 */
	$localize = array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'security' => wp_create_nonce('file_upload'),
	);
	if ($_GET) {
		$localize['get'] = $_GET;
	}

	wp_enqueue_script('pdi_script_bootstrap_admin', plugins_url('assets/js/bootstrap.min.js', __FILE__), array());
	wp_enqueue_script('pdi_script_mask', plugins_url('assets/js/jquery.mask.min.js', __FILE__), array('jquery'));
	wp_enqueue_script('pdi_script_toastr', plugins_url('assets/js/toastr.min.js', __FILE__), array('jquery'));
	wp_enqueue_script('pdi_script_function_admin', plugins_url('assets/js/functions-admin.js', __FILE__), array('jquery'));
	wp_enqueue_script('pdi_script_admin', plugins_url('assets/js/script-admin.js', __FILE__), array('jquery'));

	wp_localize_script('pdi_script_function_admin', 'pdi_options_object', $localize);

	global $current_user;
	foreach ($current_user->roles as $role) {
		if ($role == 'pdi_nivel_1' || $role == 'pdi_nivel_2' || $role == 'pdi_nivel_3') {
			remove_menu_page('index.php'); //Dashboard 
			remove_menu_page('edit.php'); //Posts - publicações
			remove_menu_page('upload.php'); //Media - imagens, vídeos, docs, etc...
			remove_menu_page('edit.php?post_type=page'); //Pages - páginas
			remove_menu_page('edit-comments.php'); //Comments - comentários
			remove_menu_page('themes.php'); //Appearance - aparência (recomendo!)
			remove_menu_page('plugins.php'); //Plugins (recomendo!)
			remove_menu_page('users.php'); //Users - usuários 
			remove_menu_page('tools.php'); //Tools - ferramentas (recomendo!)
			remove_menu_page('options-general.php'); //Settings - configurações 
			remove_menu_page('elementor');
			remove_menu_page('ai1wm_export');
			remove_menu_page('edit.php?post_type=elementor_library');
		}
	}
}

function pdi_functions_activation()
{
	$roles = [
		array(
			'pdi_nivel_1',
			__('PDI - Super Admin', PDI_TEXT_DOMAIN),
		),
		array(
			'pdi_nivel_4',
			__('PDI - Gerente', PDI_TEXT_DOMAIN),
		),
		array(
			'pdi_nivel_2',
			__('PDI - Cordenador', PDI_TEXT_DOMAIN),
		),
		array(
			'pdi_nivel_3',
			__('PDI - Operador', PDI_TEXT_DOMAIN),
		),
	];

	$adm = get_role('administrator');
	$adm->capabilities['edit_users'] = false;
	$adm->capabilities['add_users'] = false;
	$adm->capabilities['create_users'] = false;
	$adm->capabilities['delete_users'] = false;
	foreach ($roles as $role) {
		add_role(
			$role[0],
			$role[1],
			$adm->capabilities
		);
	}
}
register_activation_hook(__FILE__, 'pdi_functions_activation');

function pdi_functions_deactivation()
{
	$roles = [
		'pdi_nivel_1',
		'pdi_nivel_2',
		'pdi_nivel_3',
		'pdi_nivel_4',
	];

	foreach ($roles as $role) {
		remove_role($role);
	}
}
register_deactivation_hook(__FILE__, 'pdi_functions_deactivation');
