<?php
defined('ABSPATH') or die('No script kiddies please!');
$grande_tema = pdi_get_grande_tema_all();
?>
<div class="container-fluid pdi-container">
	<?php if ($_GET['edit']) : ?>
		<?php if ($_GET['edit'] !== 'new') : ?>
			<?php $objOuse = pdi_get_objetivos_ouse(['id' => intval($_GET['edit'])]) ?>
			<?php $colors = json_decode($objOuse[0]->layout) ?>
		<?php endif; ?>
		<div class="pdi-plugin-title">
			<span class="dashicons dashicons-edit"></span>
			<?php $idObjetivo = $objOuse[0]->number ? $objOuse[0]->number : $objOuse[0]->id ?>
			<?php echo $_GET['edit'] !== 'new' ? $idObjetivo . ' - ' . $objOuse[0]->descricao : _e('Novo Objetivo Ouse', PDI_TEXT_DOMAIN) ?>
		</div>
		<form action="" class="form-edit-pdi">
			<div class="form-row row">
				<div class="col-md-3 col-label">
					<?php _e('Ativar/Desativar', PDI_TEXT_DOMAIN) ?>
				</div>
				<div class="form-group col-md-9">
					<input type="checkbox" name="active" id="active" class="form-control" <?php echo $objOuse[0]->active === '1' || !$objOuse[0]->active ? 'checked' : '' ?> value="1" />
				</div>
				<div class="col-md-3 col-label">
					<?php _e('Número', PDI_TEXT_DOMAIN) ?>
				</div>
				<div class="form-group col-md-9">
					<input type="text" name="number" id="number" class="form-control w-100px" value="<?php echo $objOuse[0]->number && $objOuse[0]->number !== 0 ? $objOuse[0]->number : '' ?>" />
				</div>
				<div class="col-md-3 col-label">
					<?php _e('Descrição', PDI_TEXT_DOMAIN) ?>
				</div>
				<div class="form-group col-md-9">
					<input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo $objOuse[0]->descricao ?>" />
				</div>
				<div class="col-md-3 col-label">
					<div class="">
						<?php _e('Grande Tema Estratégico', PDI_TEXT_DOMAIN) ?>
					</div>
				</div>
				<div class="form-group col-md-9">
					<select name="grande_tema" id="grande-tema" class="form-control">
						<option><?php _e('Selecione', PDI_TEXT_DOMAIN) ?></option>
						<?php foreach ($grande_tema as $gt) : ?>
							<?php if ($gt->active != 0) : ?>
								<option value="<?php echo $gt->id ?>" <?php echo $gt->id === $objOuse[0]->grande_tema_id  ? 'selected' : '' ?>>
									<?php echo $gt->id . ' - ' . $gt->descricao ?>
								</option>
							<?php endif; ?>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="clear-line"></div>
			<div class="col-md-12">
				<p class="btn-actions">
					<button type="button" class="button button-primary <?php echo $_GET['edit'] !== 'new' ? 'btn-edit-objetivo-ouse' : 'btn-save-objetivo-ouse'  ?>" data-objetivo-ouse-id="<?php echo $objOuse[0]->id ?>">
						<?php _e('Salvar', PDI_TEXT_DOMAIN) ?>
					</button>
				</p>
			</div>
		</form>
	<?php else : ?>
		<div class="pdi-plugin-title">
			<span class="dashicons dashicons-analytics"></span>
			PDI / Objetivos Ouse
		</div>
		<div class="row">
			<div class="col-md-12 col-btn-add">
				<a href="?page=pdi-objetivos-ouse&edit=new" class="btn btn-success btn-add add-new-objetivo-ouse">
					<span class="dashicons dashicons-plus"></span>
					<span class="btn-desc">
						<?php _e('Adicionar novo', PDI_TEXT_DOMAIN) ?>
					</span>
				</a>
			</div>
		</div>
		<div class="card card-full p-0">
			<form action="">
				<div class="form-row row">
					<div class="col-md-3 col-label">
						<?php _e('Selecionar Grande Tema Estratégico', PDI_TEXT_DOMAIN) ?>
					</div>
					<div class="form-group col-md-9">
						<select name="grande_tema" id="grande-tema" class="form-control admin-filter-ouse">
							<option>
								<?php _e('Selecione', PDI_TEXT_DOMAIN) ?>
							</option>
							<?php foreach ($grande_tema as $gt) : ?>
								<?php if ($gt->active != 0) : ?>
									<option value="<?php echo $gt->id ?>"><?php echo $gt->descricao ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</form>
		</div>
		<div class="load-table" id="load-table-objetivos-ouse">
			<?php pdi_get_template_front('admin/table-objetivos-ouse'); ?>
		</div>
	<?php endif; ?>
</div>
