<?php
defined('ABSPATH') or die('No script kiddies please!');

global $current_user;
if (in_array('pdi_nivel_2', $current_user->roles) || in_array('pdi_nivel_3', $current_user->roles) || in_array('pdi_nivel_4', $current_user->roles)) :
	pdi_get_template_front('admin/no-permission');
else :
?>
	<div class="container-fluid pdi-container">
		<?php if ($_GET['edit']) : ?>
			<?php if ($_GET['edit'] !== 'new') : ?>
				<?php $gt = pdi_get_grande_tema(['id' => intval($_GET['edit'])]) ?>
				<?php $colors = json_decode($gt[0]->layout) ?>
			<?php endif; ?>
			<div class="pdi-plugin-title">
				<span class="dashicons dashicons-edit"></span>
				<?php $gtNumber = $gt[0]->number ? $gt[0]->number : $gt[0]->id ?>
				<?php echo $_GET['edit'] !== 'new' ? $gtNumber . ' - ' . $gt[0]->descricao : _e('Novo Grande Tema', PDI_TEXT_DOMAIN) ?>
			</div>
			<form action="" class="form-edit-pdi">
				<div class="form-row row">
					<div class="col-md-3 col-label">
						<?php _e('Ativar/Desativar', PDI_TEXT_DOMAIN) ?>
					</div>
					<div class="form-group col-md-9">
						<input type="checkbox" name="active" id="active" class="form-control" <?php echo $gt[0]->active === '1' || !$gt[0]->active ? 'checked' : '' ?> value="1" />
					</div>
					<div class="col-md-3 col-label">
						<?php _e('Número', PDI_TEXT_DOMAIN) ?>
					</div>
					<div class="form-group col-md-9">
						<input type="text" name="number" id="number" class="form-control w-100px" value="<?php echo $gt[0]->number && $gt[0]->number !== 0 ? $gt[0]->number : '' ?>" />
					</div>
					<div class="col-md-3 col-label">
						<?php _e('Descrição', PDI_TEXT_DOMAIN) ?>
					</div>
					<div class="form-group col-md-9">
						<input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo $gt[0]->descricao ?>" />
					</div>
					<div class="col-md-3 col-label">
						<?php _e('Cor Primária', PDI_TEXT_DOMAIN) ?>
					</div>
					<div class="form-group col-md-9">
						<input type="color" name="color_primary" id="color_primary" class="form-control form-control-color" value="<?php echo $colors[1] ?>" />
					</div>
					<div class="col-md-3 col-label">
						<?php _e('Cor Secundária', PDI_TEXT_DOMAIN) ?>
					</div>
					<div class="form-group col-md-9">
						<input type="color" name="color_secondary" id="color-secondary" class="form-control form-control-color" value="<?php echo $colors[0] ?>" />
					</div>
				</div>
				<div class="clear-line"></div>
				<div class="col-md-12">
					<p class="btn-actions">
						<button type="button" class="button button-primary <?php echo $_GET['edit'] !== 'new' ? 'btn-edit-grande-tema' : 'btn-save-grande-tema'  ?>" data-gt-id="<?php echo $gt[0]->id ?>">
							<?php _e('Salvar', PDI_TEXT_DOMAIN) ?>
						</button>
					</p>
				</div>
			</form>
		<?php else : ?>
			<div class="pdi-plugin-title">
				<span class="dashicons dashicons-analytics"></span>
				PDI / Grande Tema
			</div>
			<div class="row">
				<div class="col-md-12 col-btn-add">
					<a href="?page=pdi-grande-tema&edit=new" class="btn btn-success btn-add add-new-grande-tema">
						<span class="dashicons dashicons-plus"></span>
						<span class="btn-desc">
							<?php _e('Adicionar novo', PDI_TEXT_DOMAIN) ?>
						</span>
					</a>
				</div>
			</div>
			<div class="load-table" id="load-table-grande-tema">
				<?php pdi_get_template_front('admin/table-grande-tema') ?>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>
