<?php
defined('ABSPATH') or die('No script kiddies please!');
$grande_tema = pdi_get_grande_tema_all();
$objetivos_ouse = pdi_get_objetivos_ouse_all();
$ods = pdi_get_ods_all();
$pne = pdi_get_pne_all();
global $current_user;
$nivel_1 = in_array('pdi_nivel_1', $current_user->roles);
$nivel_2 = in_array('pdi_nivel_2', $current_user->roles);

if (in_array('pdi_nivel_3', $current_user->roles) || in_array('pdi_nivel_4', $current_user->roles)) :
	$inactive = true;
endif;
?>
<?php if (!$_GET['indicador_id']) : ?>
	<div class="container-fluid pdi-container">
		<div class="pdi-plugin-title">
			<span class="dashicons dashicons-analytics"></span>
			<?php _e('PDI / Metas', PDI_TEXT_DOMAIN) ?>
		</div>
		<div class="card card-full p-0">
			<form action="" id="pdi-admin-filter-metas">
				<div class="form-row row">
					<div class="col-md-3 col-label">
						<div class="">
							<?php _e('Selecionar Grande Tema Estratégico', PDI_TEXT_DOMAIN) ?>
						</div>
					</div>
					<div class="form-group col-md-9">
						<select name="grande_tema" id="grande-tema" class="form-control admin-filter-metas">
							<option value="">
								<?php _e('Selecione...', PDI_TEXT_DOMAIN) ?>
							</option>
							<?php foreach ($grande_tema as $gt) : ?>
								<?php if ($gt->active != 0) : ?>
									<option value="<?php echo $gt->id ?>"><?php echo $gt->descricao ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-3 col-label">
						<div class="">
							<?php _e('Selecionar Objetivo Ouse', PDI_TEXT_DOMAIN) ?>
						</div>
					</div>
					<div class="form-group col-md-9">
						<select name="objetivo_ouse" id="objetivo-ouse" class="form-control admin-filter-metas">
							<option value="">
								<?php _e('Selecione...', PDI_TEXT_DOMAIN) ?>
							</option>
							<?php foreach ($objetivos_ouse as $ouse) : ?>
								<?php if ($ouse->active != 0) : ?>
									<option value="<?php echo $ouse->id ?>"><?php echo $ouse->descricao ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-3 col-label">
						<div class="">
							<?php _e('Número do Indicador', PDI_TEXT_DOMAIN) ?>
						</div>
					</div>
					<div class="form-group col-md-2">
						<input type="text" class="form-control onlyNumber admin-filter-metas-number" name="number" id="number">
					</div>
				</div>
			</form>
		</div>
		<div class="load-table">
			<?php pdi_get_template_front('admin/table-metas'); ?>
		</div>
	</div>
<?php else : ?>
	<?php $meta = pdi_get_indicadores(['id' => intval($_GET['indicador_id'])]) ?>
	<?php $meta = $meta[0]; ?>
	<?php $metaOds = json_decode($meta->ods); ?>
	<?php $metaPne = json_decode($meta->pne); ?>
	<?php $metaAno = pdi_get_indicadores_anos_all(['indicador_id' => intval($meta->id)]); ?>
	<div class="container-fluid pdi-container">
		<div class="pdi-plugin-title">
			<span class="dashicons dashicons-analytics"></span>
			<?php _e('PDI / Editar Meta', PDI_TEXT_DOMAIN) ?>
		</div>
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<button class="nav-link active" id="nav-meta-tab" data-bs-toggle="tab" data-bs-target="#nav-meta" type="button" role="tab" aria-controls="nav-meta" aria-selected="true">Meta</button>
				<button class="nav-link" id="nav-acoes-tab" data-bs-toggle="tab" data-bs-target="#nav-acoes" type="button" role="tab" aria-controls="nav-acoes" aria-selected="false">Açoes</button>
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-meta" role="tabpanel" aria-labelledby="nav-meta-tab">
				<div class="card card-full p-0">
					<form id="add-indicadores-meta" action="">
						<input type="hidden" name="id" value="<?php echo $meta->id ?>">
						<div class="form-row row">
							<div class="col-md-3 col-label">
								<div class="">
									<?php _e('Número da Meta', PDI_TEXT_DOMAIN) ?>
								</div>
							</div>
							<div class="form-group col-md-1">
								<input type="text" name="number" id="number" class="form-control onlyNumber" value="<?php echo $meta->number ?>" <?php echo $inactive ? 'disabled' : '' ?>>
							</div>
							<div class="clear-line"></div>
							<div class="col-md-3 col-label">
								<div class="">
									<?php _e('Grande Tema Estratégico', PDI_TEXT_DOMAIN) ?>
								</div>
							</div>
							<div class="form-group col-md-9">
								<select name="grande_tema" id="grande-tema" class="form-control" <?php echo ($nivel_1) ? 'readonly' : '' ?> <?php echo $inactive ? 'disabled' : '' ?>>
									<option value="">
										<?php _e('Selecione...', PDI_TEXT_DOMAIN) ?>
									</option>
									<?php foreach ($grande_tema as $gt) : ?>
										<?php if ($gt->active != 0) : ?>
											<option value="<?php echo $gt->id ?>" <?php echo ($gt->id == $meta->grande_tema_id) ? 'selected="selected"'  : '' ?>><?php echo $gt->descricao ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="clear-line"></div>
							<div class="col-md-3 col-label">
								<div class="">
									<?php _e('Objetivo Ouse', PDI_TEXT_DOMAIN) ?>
								</div>
							</div>
							<div class="form-group col-md-9">
								<select name="objetivo_ouse" id="objetivo-ouse" class="form-control" <?php echo ($nivel_1) ? 'readonly' : '' ?> <?php echo $inactive ? 'disabled' : '' ?>>
									<option value="">
										<?php _e('Selecione...', PDI_TEXT_DOMAIN) ?>
									</option>
									<?php foreach ($objetivos_ouse as $ouse) : ?>
										<?php if ($ouse->active != 0) : ?>
											<option value="<?php echo $ouse->id ?>" <?php echo ($ouse->id == $meta->objetivo_ouse_id) ? 'selected="selected"'  : '' ?>><?php echo $ouse->descricao ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="clear-line"></div>
							<div class="col-md-3 col-label">
								<div class="">
									<?php _e('Indicador', PDI_TEXT_DOMAIN) ?>
								</div>
							</div>
							<div class="form-group col-md-9">
								<input type="text" name="indicador" id="indicador" class="form-control" value="<?php echo $meta->titulo ?>" <?php echo ($nivel_1) ? 'readonly' : '' ?> <?php echo $inactive ? 'disabled' : '' ?>>
							</div>
							<div class="clear-line"></div>
							<div class="col-md-3 col-label">
								<div class="">
									<?php _e('Descrição da Meta', PDI_TEXT_DOMAIN) ?>
								</div>
							</div>
							<div class="form-group col-md-9">
								<textarea name="desc_meta" id="desc-meta" class="form-control" rows="3" <?php echo ($nivel_1) ? 'readonly' : '' ?> <?php echo $inactive ? 'disabled' : '' ?>><?php echo $meta->descricao ?></textarea>
							</div>
							<div class="clear-line"></div>
							<?php if ($ods) : ?>
								<div class="col-md-3 col-label">
									<div class="">
										<?php _e('ODS', PDI_TEXT_DOMAIN) ?>
									</div>
								</div>
								<?php $x = 0; ?>
								<?php $count = count($ods); ?>
								<?php for ($i = 0; $i < $count; $i++) : ?>
									<?php if ($x == 0) {
									?>
										<div class="form-group col-md-3">
										<?php
									} ?>
										<div class="form-check form-check-inline form-check-inline-pdi">
											<input class="form-check-input" type="checkbox" id="<?php echo $ods[$i]->slug ?>" name="ods[]" value="<?php echo $ods[$i]->id ?>" <?php echo (array_search($ods[$i]->id, $metaOds) !== false && $metaOds) ? 'checked="checked"' : '' ?> <?php echo ($nivel_1) ? 'readonly' : '' ?> <?php echo $inactive ? 'disabled' : '' ?>>
											<label class="form-check-label" for="<?php echo $ods[$i]->slug ?>">
												<?php echo $ods[$i]->id . '. ' . $ods[$i]->titulo ?>
											</label>
										</div>

										<?php if ($x == 6 || $count - 1 == $i) {
											$x = 0;
										?>
										</div>
									<?php
										} else {
											$x++;
										}
									?>
								<?php endfor; ?>
								<div class="clear-line"></div>
							<?php endif; ?>
							<?php if ($pne) : ?>
								<div class="col-md-3 col-label">
									<div class="">
										<?php _e('PNE', PDI_TEXT_DOMAIN) ?>
									</div>
								</div>
								<?php $x = 0; ?>
								<?php $count = count($pne); ?>
								<?php for ($i = 0; $i < $count; $i++) : ?>
									<?php if ($x == 0) {
									?>
										<div class="form-group col-md-3">
										<?php
									} ?>
										<div class="form-check form-check-inline form-check-inline-pdi">
											<input class="form-check-input" type="checkbox" id="<?php echo $pne[$i]->slug ?>" name="pne[]" value="<?php echo $pne[$i]->id ?>" <?php echo (array_search($pne[$i]->id, $metaPne) !== false && $metaPne) ? 'checked="checked"' : '' ?> <?php echo ($nivel_1) ? 'readonly' : '' ?> <?php echo $inactive ? 'disabled' : '' ?>>
											<label class="form-check-label" for="<?php echo $pne[$i]->slug ?>">
												<?php echo $pne[$i]->id . '. ' . $pne[$i]->titulo ?>
											</label>
										</div>

										<?php if ($x == 7 || $count - 1 == $i) {
											$x = 0;
										?>
										</div>
									<?php
										} else {
											$x++;
										}
									?>
								<?php endfor; ?>
								<div class="clear-line"></div>
							<?php endif; ?>
							<div class="col-md-3 col-label">
								<div class="">
									<?php _e('Meta do Indicador', PDI_TEXT_DOMAIN) ?>
								</div>
							</div>
							<div class="form-group col-md-2">
								<input type="text" name="valor_meta" id="valor_meta" class="form-control valor-meta  maskValor" value="<?php echo format_real($meta->valor_meta) ?>" <?php echo ($nivel_1) ? 'readonly' : '' ?> <?php echo $inactive ? 'disabled' : '' ?>>
							</div>
							<div class="form-group col-md-4 form-group-inline">
								<label for="justif-valor-meta"><?php _e('Justificativa', PDI_TEXT_DOMAIN) ?></label>
								<input type="text" name="justif_valor_meta" id="justif-valor-meta" class="form-control" value="<?php echo $meta->justif_valor_meta ?>" <?php echo $inactive ? 'disabled' : '' ?>>
							</div>
							<div class="clear-line"></div>
							<div class="col-md-3 col-label">
								<div class="">
									<?php _e('Valor Inicial', PDI_TEXT_DOMAIN) ?>
								</div>
								<div class="label-informativo">
									<?php _e('Dado coletado que é parâmetro para definição da meta.', PDI_TEXT_DOMAIN) ?>
								</div>
							</div>
							<div class="form-group col-md-2">
								<input type="text" name="valor_inicial_meta" id="valor-inicial-meta" class="form-control maskValor" value="<?php echo format_real($meta->valor_inicial) ?>" <?php echo ($nivel_1) ? 'readonly' : '' ?> <?php echo $inactive ? 'disabled' : '' ?>>
							</div>
							<div class="form-group col-md-4 form-group-inline">
								<label for="justif-valor-inicial"><?php _e('Justificativa', PDI_TEXT_DOMAIN) ?></label>
								<input type="text" name="justif_valor_inicial" id="justif-valor-inicial" class="form-control" value="<?php echo $meta->justif_valor_inicial ?>" <?php echo $inactive ? 'disabled' : '' ?>>
							</div>
							<div class="form-group col-md-3 form-group-inline">
								<label for="">
									<?php _e('Data do Registro', PDI_TEXT_DOMAIN) ?>
								</label>
								<input type="text" name="data_registro_meta" id="data-registro-meta" class="form-control maskData" value="<?php echo convert_data_front($meta->data_registro) ?>" <?php echo ($nivel_1) ? 'readonly' : '' ?> <?php echo $inactive ? 'disabled' : '' ?>>
							</div>
							<div class="clear-line"></div>
							<div class="col-md-12">
								<div class="card card-full m-2 bk-admin">
									<ul id="indicadores-anos">
										<?php foreach ($metaAno as $ano) : ?>
											<li class="blocos-indicadores-anos">
												<input type="hidden" name="ano_id[]" value="<?php echo $ano->id ?>">
												<div class="line-indicadores-anos">
													<label for="">
														<?php _e('Ano', PDI_TEXT_DOMAIN) ?>
													</label>
													<input type="text" name="ano_meta[]" class="form-control maskAno" value="<?php echo $ano->ano ?>" <?php echo $inactive ? 'disabled' : '' ?>>
												</div>
												<div class="line-indicadores-anos">
													<label for="">
														<?php _e('Valor', PDI_TEXT_DOMAIN) ?>
													</label>
													<input type="text" name="valor_ano_meta[]" class="form-control maskValor" value="<?php echo format_real($ano->valor) ?>" <?php echo $inactive ? 'disabled' : '' ?>>
												</div>
												<div class="line-indicadores-anos">
													<label for="">
														<?php _e('Valor Previsto', PDI_TEXT_DOMAIN) ?>
													</label>
													<input type="text" name="valor_previsto_ano_meta[]" class="form-control maskValor" value="<?php echo format_real($ano->valor_previsto) ?>" <?php echo $inactive ? 'disabled' : '' ?>>
												</div>
												<div class="line-indicadores-anos">
													<label for="">
														<?php _e('Data do Registro', PDI_TEXT_DOMAIN) ?>
													</label>
													<input type="text" name="data_registro_ano_meta[]" class="form-control maskData" value="<?php echo convert_data_front($ano->data_registro) ?>" <?php echo $inactive ? 'disabled' : '' ?>>
												</div>
												<div class="line-indicadores-anos">
													<label for="">
														<?php _e('Justificativa', PDI_TEXT_DOMAIN) ?>
													</label>
													<input type="text" name="justificativa_ano_meta[]" class="form-control" value="<?php echo $ano->justificativa ?>" <?php echo $inactive ? 'disabled' : '' ?>>
												</div>
												<div class="line-indicadores-anos">
													<a class="remove-indicador" title="Remover" data-id-ano-indicador="<?php echo $ano->id ?>" <?php echo ($nivel_1) ? 'disabled' : '' ?> <?php echo $inactive ? 'disabled' : '' ?>>
														<span class="dashicons dashicons-trash text-danger"></span>
													</a>
												</div>
											</li>
										<?php endforeach; ?>
									</ul>
									<div class="indicadores-button">
										<button type="button" class="btn btn-success add-indicadores-anos" <?php echo ($nivel_1) ? 'disabled' : '' ?> <?php echo $inactive ? 'disabled' : '' ?>>
											<span class="dashicons dashicons-plus"></span>
											<?php _e('Adicionar Indicador Ano', PDI_TEXT_DOMAIN) ?>
										</button>
									</div>
								</div>
							</div>
							<div class="clear-line"></div>
							<div class="col-md-12">
								<p class="btn-actions">
									<button type="button" class="button button-primary update-indicador-meta" <?php echo $inactive ? 'disabled' : '' ?>>
										<?php _e('Salvar Meta', PDI_TEXT_DOMAIN) ?>
									</button>
								</p>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="tab-pane fade" id="nav-acoes" role="tabpanel" aria-labelledby="nav-acoes-tab">
				<div class="row">
					<div class="col-md-12 col-btn-add">
						<a href="?page=pdi-new-acoes&indicador=<?php echo $meta->id ?>" class="btn btn-success btn-add">
							<span class="dashicons dashicons-plus"></span>
							<span class="btn-desc">
								<?php _e('Adicionar nova ação', PDI_TEXT_DOMAIN) ?>
							</span>
						</a>
					</div>
				</div>
				<?php
				$args = array(
					'meta_id' => $meta->id,
				);
				?>
				<?php pdi_get_template_front('admin/table-acoes', $args) ?>
			</div>
		</div>

	</div>
<?php endif; ?>
