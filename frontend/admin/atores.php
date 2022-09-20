<?php
defined('ABSPATH') or die('No script kiddies please!');

global $current_user;
if (in_array('pdi_nivel_2', $current_user->roles) || in_array('pdi_nivel_3', $current_user->roles) || in_array('pdi_nivel_4', $current_user->roles)) :
	pdi_get_template_front('admin/no-permission');
else :
?>
	<?php $atores = pdi_get_atores_all(); ?>
	<div class="container-fluid pdi-container">
		<?php if ($_GET['edit']) : ?>
			<?php if ($_GET['edit'] !== 'new') : ?>
				<?php $ator = pdi_get_atores(['id' => intval($_GET['edit'])]) ?>
			<?php endif; ?>
			<div class="pdi-plugin-title">
				<span class="dashicons dashicons-edit"></span>
				<?php echo $_GET['edit'] !== 'new' ? $ator[0]->id . ' - ' . $ator[0]->descricao : _e('Novo Ator', PDI_TEXT_DOMAIN) ?>
			</div>
			<form action="" class="form-edit-pdi">
				<div class="form-row row">
					<div class="col-md-3 col-label">
						<?php _e('Ativar/Desativar', PDI_TEXT_DOMAIN) ?>
					</div>
					<div class="form-group col-md-9">
						<input type="checkbox" name="active" id="active" class="form-control" <?php echo $ator[0]->active === '1' || !$ator[0]->active ? 'checked' : '' ?> value="1" />
					</div>
					<div class="col-md-3 col-label">
						<?php _e('Descrição', PDI_TEXT_DOMAIN) ?>
					</div>
					<div class="form-group col-md-9">
						<input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo $ator[0]->descricao ?>" />
					</div>
				</div>
				<div class="clear-line"></div>
				<div class="col-md-12">
					<p class="btn-actions">
						<button type="button" class="button button-primary <?php echo $_GET['edit'] !== 'new' ? 'btn-edit-ator' : 'btn-save-ator'  ?>" data-ator-id="<?php echo $ator[0]->id ?>">
							<?php _e('Salvar', PDI_TEXT_DOMAIN) ?>
						</button>
					</p>
				</div>
			</form>
		<?php else : ?>
			<div class="pdi-plugin-title">
				<span class="dashicons dashicons-analytics"></span>
				<?php _e('PDI / Atores', PDI_TEXT_DOMAIN) ?>
			</div>
			<div class="row">
				<div class="col-md-12 col-btn-add">
					<a href="?page=pdi-ator&edit=new" class="btn btn-success btn-add add-new-ator">
						<span class="dashicons dashicons-plus"></span>
						<span class="btn-desc">
							<?php _e('Adicionar novo', PDI_TEXT_DOMAIN) ?>
						</span>
					</a>
				</div>
			</div>
			<div class="load-table" id="load-table-atores">
				<?php pdi_get_template_front('admin/table-atores') ?>
			</div>
		<?php endif; ?>
	</div>
<?php
endif;
