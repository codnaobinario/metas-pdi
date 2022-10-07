<?php

/**
 * PDI - Núcleo Digital
 * Developer: Igor Sacramento
 *
 * Class PDI_Menu_admin
 */


if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

class PDI_Menu_Admin
{

	function __construct()
	{
		add_action('admin_menu', array($this, 'pdi_add_menu'));
	}

	public function pdi_add_menu()
	{

		$icon = 'dashicons-admin-site';
		global $current_user;

		add_menu_page(
			__('PDI', PDI_TEXT_DOMAIN),
			'PDI',
			'',
			'pdi',
			array($this, 'pdi_menu_page'),
			$icon,
			10
		);

		add_submenu_page(
			'pdi',
			'Todas as Metas',
			'Todas as Metas',
			'manage_options',
			'pdi-metas',
			array($this, 'pdi_submenu_page_metas')
		);
		add_submenu_page(
			'pdi',
			'Adicionar nova Meta',
			'Adicionar nova Meta',
			'manage_options',
			'pdi-new-metas',
			array($this, 'pdi_submenu_page_new_metas')
		);

		add_submenu_page(
			'pdi',
			'Todas as Ações',
			'Todas as Ações',
			'manage_options',
			'pdi-acoes',
			array($this, 'pdi_submenu_page_acoes')
		);
		add_submenu_page(
			'pdi',
			'Adicionar nova Ação',
			'Adicionar nova Ação',
			'manage_options',
			'pdi-new-acoes',
			array($this, 'pdi_submenu_page_new_acoes')
		);

		add_submenu_page(
			'pdi',
			'Grande Tema',
			'Grande Tema',
			'manage_options',
			'pdi-grande-tema',
			array($this, 'pdi_submenu_page_grande_tema')
		);

		add_submenu_page(
			'pdi',
			'Objetivos Ouse',
			'Objetivos Ouse',
			'manage_options',
			'pdi-objetivos-ouse',
			array($this, 'pdi_submenu_page_objetivos_ouse')
		);

		add_submenu_page(
			'pdi',
			'Eixos',
			'Eixos',
			'manage_options',
			'pdi-eixos',
			array($this, 'pdi_submenu_page_eixos')
		);

		add_submenu_page(
			'pdi',
			'Atores',
			'Atores',
			'manage_options',
			'pdi-ator',
			array($this, 'pdi_submenu_page_ator')
		);

		add_submenu_page(
			'pdi',
			'Permissoes de Usuários',
			'Permissões de Usuários',
			'manage_options',
			'pdi-user-permission',
			array($this, 'pdi_submenu_page_user_permission')
		);

		add_submenu_page(
			'pdi',
			'Exportar / Importar',
			'Exportar / Importar',
			'manage_options',
			'pdi-import',
			array($this, 'pdi_submenu_page_export_import')
		);

		add_submenu_page(
			'pdi',
			'Configurações',
			'Configurações',
			'manage_options',
			'pdi-configs',
			array($this, 'pdi_submenu_page_configs')
		);

		add_submenu_page(
			'pdi',
			'Logs Auditoria',
			'Logs Auditoria',
			'manage_options',
			'pdi-logs',
			array($this, 'pdi_submenu_page_logs')
		);
	}

	public function pdi_menu_page()
	{
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.', PDI_TEXT_DOMAIN));
		}

		pdi_get_template_front('admin/metas');
	}

	public function pdi_submenu_page_grande_tema()
	{
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.', PDI_TEXT_DOMAIN));
		}

		pdi_get_template_front('admin/grande-tema');
	}

	public function pdi_submenu_page_objetivos_ouse()
	{
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.', PDI_TEXT_DOMAIN));
		}

		pdi_get_template_front('admin/objetivos-ouse');
	}

	public function pdi_submenu_page_eixos()
	{
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.', PDI_TEXT_DOMAIN));
		}

		pdi_get_template_front('admin/eixos');
	}

	public function pdi_submenu_page_metas()
	{
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.', PDI_TEXT_DOMAIN));
		}

		pdi_get_template_front('admin/metas');
	}

	public function pdi_submenu_page_acoes()
	{
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.', PDI_TEXT_DOMAIN));
		}

		pdi_get_template_front('admin/acoes');
	}

	public function pdi_submenu_page_new_acoes()
	{
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.', PDI_TEXT_DOMAIN));
		}


		#POST
		if (isset($_POST['action']) && $_POST['action'] == 'admin_menu_post_acoes') {
			echo '<a class="btn btn-outline-primary" href="javascript: history.back(-1);">Voltar</a>';
			wp_die(json_encode(array(
				'eixo_id'             => !empty($_POST['dataEixos']) ? strip_tags(stripslashes($_POST['dataEixos']), $allow ?? null) : null,
				'titulo'              => !empty($_POST['dataTitulo']) ? strip_tags(stripslashes($_POST['dataTitulo']), $allow ?? null) : null,
				'descricao'           => !empty($_POST['dataDescricao']) ? strip_tags(stripslashes($_POST['dataDescricao']), $allow ?? null) : null,
				'objetivo_especifico' => !empty($_POST['dataObjetivoEspecifico']) ? strip_tags(stripslashes($_POST['dataObjetivoEspecifico']), $allow ?? null) : null,
				'ator'                => !empty($_POST['dataAtor']) ? strip_tags(stripslashes($_POST['dataAtor']), $allow ?? null) : null,
				'desempenho'          => !empty($_POST['dataDesempenho']) ? strip_tags(stripslashes($_POST['dataDesempenho']), $allow ?? null) : null,
				'data_registro'       => !empty($_POST['dataRegistro']) ? strip_tags(stripslashes($_POST['dataRegistro']), $allow ?? null) : null,
				'active'              => 1,
			)));
		}

		pdi_get_template_front('admin/add-acoes');
	}

	public function pdi_submenu_page_new_metas()
	{
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.', PDI_TEXT_DOMAIN));
		}


		#POST
		if (isset($_POST['action']) && $_POST['action'] == 'admin_menu_post_acoes') {
			echo '<a class="btn btn-outline-primary" href="javascript: history.back(-1);">Voltar</a>';
			wp_die(json_encode(array(
				'titulo'        => !empty($_POST['dataTitulo']) ?  strip_tags(stripslashes($_POST['dataTitulo'])) : null,
				'descricao'     => !empty($_POST['dataDescricao']) ?  strip_tags(stripslashes($_POST['dataDescricao'])) : null,
				'indicador_id'  => !empty($_POST['dataIndicadores']) ?  strip_tags(stripslashes($_POST['dataIndicadores'])) : null,
				'objetivo_id'   => !empty($_POST['dataObjetivos']) ?  strip_tags(stripslashes($_POST['dataObjetivos'])) : null,
				'eixo_id'       => !empty($_POST['dataEixos']) ?  strip_tags(stripslashes($_POST['dataEixos'])) : null,
				'ods_id'        => !empty($_POST['dataOds']) ?  strip_tags(stripslashes($_POST['dataOds'])) : null,
				'pne_id'        => !empty($_POST['dataPne']) ?  strip_tags(stripslashes($_POST['dataPne'])) : null,
				'valor'         => !empty($_POST['dataValor']) ?  strip_tags(stripslashes($_POST['dataValor'])) : null,
				'valor_inicial' => !empty($_POST['dataValorInicial']) ?  strip_tags(stripslashes($_POST['dataValorInicial'])) : null,
				'data_registro' => !empty($_POST['dataRegistro']) ?  strip_tags(stripslashes($_POST['dataRegistro'])) : null,
				'active'        => 1
			)));
		}

		pdi_get_template_front('admin/add-metas');
	}

	public function pdi_submenu_page_export_import()
	{
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.', PDI_TEXT_DOMAIN));
		}



		pdi_get_template_front('admin/import');
	}

	public function pdi_submenu_page_user_permission()
	{
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.', PDI_TEXT_DOMAIN));
		}

		pdi_get_template_front('admin/user-permission');
	}

	public function pdi_submenu_page_configs()
	{
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.', PDI_TEXT_DOMAIN));
		}

		pdi_get_template_front('admin/configs');
	}

	public function pdi_submenu_page_ator()
	{
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.', PDI_TEXT_DOMAIN));
		}

		pdi_get_template_front('admin/atores');
	}

	public function pdi_submenu_page_logs()
	{
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.', PDI_TEXT_DOMAIN));
		}

		pdi_get_template_front('admin/logs');
	}
}

new PDI_Menu_Admin();
