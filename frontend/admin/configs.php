<?php
defined('ABSPATH') or die('No script kiddies please!');

if (isset($_POST) && !empty($_POST)) {

	foreach ($_POST as $key => $value) {
		$select_ = pdi_get_configs(['meta_key' => $key]);

		if (!$select_) {
			// Inserir Novo
			$result[] = pdi_set_configs(['meta_key' => $key, 'meta_value' => $value]);
		} else {
			// Atualizar
			$select = $select_[0];
			$result[] = pdi_update_configs(['meta_value' => $value], ['meta_key' => $key], ['%s'], ['%s']);
		}
	}
}
if (!empty($_FILES['image_top']) && isset($_FILES['image_top']) && $_POST['edit_image'] == 'true') {
	$movefile = wp_handle_upload($_FILES['image_top'], array('test_form' => FALSE));
	$select = pdi_get_configs(['meta_key' => 'image_top']);

	if ($select) {
		wp_delete_file($select[0]->meta_value);
		pdi_update_configs(['meta_value' => $movefile['url']], ['meta_key' => 'image_top'], ['%s'], ['%s']);
	} else {
		pdi_set_configs(['meta_key' => 'image_top', 'meta_value' => $movefile['url']], ['%s', '%s']);
	}
}
$image_top = pdi_get_configs(array('meta_key' => 'image_top'));
$title_filter = pdi_get_configs(array('meta_key' => 'title_filters'));
$filter_active = pdi_get_configs(array('meta_key' => 'filter_active'));

global $current_user;
if (in_array('pdi_nivel_1', $current_user->roles) || in_array('pdi_nivel_2', $current_user->roles)) :
	pdi_get_template_front('admin/no-permission');
else :
?>
	<div class="container-fluid pdi-container">
		<div class="pdi-plugin-title">
			<span class="dashicons dashicons-analytics"></span>
			<?php _e('Configurações', PDI_TEXT_DOMAIN) ?>
		</div>
		<div class="card card-full p-0">
			<form action="" method="POST" enctype="multipart/form-data">
				<div class="form-row row">
					<div class="col-md-3 col-label">
						<div class="">
							<?php _e('Imagem do topo', PDI_TEXT_DOMAIN) ?>
						</div>
					</div>
					<div class="form-group col-md-6 pdi-select-image">
						<input type="hidden" name="edit_image" id="edit_image" value="false">
						<input type="file" class="form-control" accept="image/png, image/jpeg" id="image-top" name="image_top" value="<?php _e($title_filter[0]->meta_value, PDI_TEXT_DOMAIN) ?>" />
						<div class="pdi-instrucoes">
							<?php _e('Tamanho da imagem 307 x 100', PDI_TEXT_DOMAIN) ?>
						</div>
					</div>
					<div class="col-md-3">
						<div class="pdi-preview-image">
							<div class="box-preview">
								<img src="<?php echo $image_top[0]->meta_value ?>" name="preview-tela" id="preview-tela" alt="">
							</div>
						</div>
					</div>
					<div class="col-md-3 col-label">
						<div class="">
							<?php _e('Ativar filtro', PDI_TEXT_DOMAIN) ?>
						</div>
					</div>
					<div class="form-group col-md-9">
						<input type="checkbox" class="form-control" id="filter_active" name="filter_active" <?php echo $filter_active[0]->meta_value === '1' || !$filter_active ? 'checked' : '' ?> value="1" />
					</div>
					<div class="col-md-3 col-label">
						<div class="">
							<?php _e('Título do filtro', PDI_TEXT_DOMAIN) ?>
						</div>
					</div>
					<div class="form-group col-md-9">
						<input type="text" class="form-control" id="title_filters" name="title_filters" value="<?php _e($title_filter[0]->meta_value, PDI_TEXT_DOMAIN) ?>" />
					</div>
					<div class="clear-line"></div>
					<div class="col-md-12">
						<p class="btn-actions">
							<button type="submit" class="button button-primary">
								<?php _e('Salvar', PDI_TEXT_DOMAIN) ?>
							</button>
						</p>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php
endif;
