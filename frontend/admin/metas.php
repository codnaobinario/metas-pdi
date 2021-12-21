<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$grande_tema = pdi_get_grande_tema_all();
$objetivos_ouse = pdi_get_objetivos_ouse_all();
$ods = pdi_get_ods_all();
$pne = pdi_get_pne_all();
global $current_user;
$nivel_1 = in_array('pdi_nivel_1', $current_user->roles);
$nivel_2 = in_array('pdi_nivel_2', $current_user->roles);

if (in_array('pdi_nivel_1', $current_user->roles) || in_array('pdi_nivel_2', $current_user->roles)) :
	pdi_get_template_front('admin/no-permission');
else :
?>
	<?php if (!$_GET['indicador_id']) : ?>
		<div class="container-fluid pdi-container">
			<div class="pdi-plugin-title">
				<span class="dashicons dashicons-analytics"></span>
				PDI / Objetivos Ouse
			</div>
			<div class="card card-full p-0">
				<form action="" id="pdi-admin-filter-metas">
					<div class="form-row row">
						<div class="col-md-3 col-label">
							<div class="">Selecionar Grande Tema Estratégico</div>
						</div>
						<div class="form-group col-md-9">
							<select name="grande_tema" id="grande-tema" class="form-control admin-filter-metas">
								<option value="">Selecione</option>
								<?php foreach ($grande_tema as $gt) : ?>
									<?php if ($gt->active != 0) : ?>
										<option value="<?php echo $gt->id ?>"><?php echo $gt->descricao ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-md-3 col-label">
							<div class="">Selecionar Objetivo Ouse</div>
						</div>
						<div class="form-group col-md-9">
							<select name="objetivo_ouse" id="objetivo-ouse" class="form-control admin-filter-metas">
								<option value="">Selecione</option>
								<?php foreach ($objetivos_ouse as $ouse) : ?>
									<?php if ($ouse->active != 0) : ?>
										<option value="<?php echo $ouse->id ?>"><?php echo $ouse->descricao ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
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
				PDI / Editar Meta
			</div>
			<div class="card card-full p-0">
				<form id="add-indicadores-meta" action="">
					<input type="hidden" name="id" value="<?php echo $meta->id ?>">
					<div class="form-row row">
						<div class="col-md-3 col-label">
							<div class="">Grande Tema Estratégico</div>
						</div>
						<div class="form-group col-md-9">
							<select name="grande_tema" id="grande-tema" class="form-control" <?php echo ($nivel_1) ? 'readonly' : '' ?>>
								<option value="">Selecione</option>
								<?php foreach ($grande_tema as $gt) : ?>
									<?php if ($gt->active != 0) : ?>
										<option value="<?php echo $gt->id ?>" <?php echo ($gt->id == $meta->grande_tema_id) ? 'selected="selected"'  : '' ?>><?php echo $gt->descricao ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="clear-line"></div>
						<div class="col-md-3 col-label">
							<div class="">Objetivo Ouse</div>
						</div>
						<div class="form-group col-md-9">
							<select name="objetivo_ouse" id="objetivo-ouse" class="form-control" <?php echo ($nivel_1) ? 'readonly' : '' ?>>
								<option value="">Selecione</option>
								<?php foreach ($objetivos_ouse as $ouse) : ?>
									<?php if ($ouse->active != 0) : ?>
										<option value="<?php echo $ouse->id ?>" <?php echo ($ouse->id == $meta->objetivo_ouse_id) ? 'selected="selected"'  : '' ?>><?php echo $ouse->descricao ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="clear-line"></div>
						<div class="col-md-3 col-label">
							<div class="">Indicador</div>
						</div>
						<div class="form-group col-md-9">
							<input type="text" name="indicador" id="indicador" class="form-control" value="<?php echo $meta->titulo ?>" <?php echo ($nivel_1) ? 'readonly' : '' ?>>
						</div>
						<div class="clear-line"></div>
						<div class="col-md-3 col-label">
							<div class="">Descrição da Meta</div>
						</div>
						<div class="form-group col-md-9">
							<textarea name="desc_meta" id="desc-meta" class="form-control" rows="3" <?php echo ($nivel_1) ? 'readonly' : '' ?>><?php echo $meta->descricao ?></textarea>
						</div>
						<div class="clear-line"></div>
						<?php if ($ods) : ?>
							<div class="col-md-3 col-label">
								<div class="">ODS</div>
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
										<input class="form-check-input" type="checkbox" id="<?php echo $ods[$i]->slug ?>" name="ods[]" value="<?php echo $ods[$i]->id ?>" <?php echo (array_search($ods[$i]->id, $metaOds) !== false) ? 'checked="checked"' : '' ?> <?php echo ($nivel_1) ? 'readonly' : '' ?>>
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
								<div class="">PNE</div>
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
										<input class="form-check-input" type="checkbox" id="<?php echo $pne[$i]->slug ?>" name="pne[]" value="<?php echo $pne[$i]->id ?>" <?php echo (array_search($pne[$i]->id, $metaPne) !== false) ? 'checked="checked"' : '' ?> <?php echo ($nivel_1) ? 'readonly' : '' ?>>
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
							<div class="">Meta do Indicador</div>
						</div>
						<div class="form-group col-md-9">
							<input type="text" name="valor_meta" id="valor_meta" class="form-control valor-meta  maskValor" value="<?php echo format_real($meta->valor_meta) ?>" <?php echo ($nivel_1) ? 'readonly' : '' ?>>
						</div>
						<div class="clear-line"></div>
						<div class="col-md-3 col-label">
							<div class="">Valor Inicial</div>
							<div class="label-informativo">Dado coletado que é parâmetro para definição da meta.</div>
						</div>
						<div class="form-group col-md-2">
							<input type="text" name="valor_inicial_meta" id="valor-inicial-meta" class="form-control maskValor" value="<?php echo format_real($meta->valor_inicial) ?>" <?php echo ($nivel_1) ? 'readonly' : '' ?>>
						</div>
						<div class="form-group col-md-3 form-group-inline">
							<label for="">Data do Registro</label>
							<input type="text" name="data_registro_meta" id="data-registro-meta" class="form-control maskData" value="<?php echo convert_data_front($meta->data_registro) ?>" <?php echo ($nivel_1) ? 'readonly' : '' ?>>
						</div>
						<div class="clear-line"></div>
						<div class="col-md-12">
							<div class="card card-full m-2 bk-admin">
								<ul id="indicadores-anos">
									<?php foreach ($metaAno as $ano) : ?>
										<li class="blocos-indicadores-anos">
											<input type="hidden" name="ano_id[]" value="<?php echo $ano->id ?>">
											<div class="line-indicadores-anos">
												<label for="">Ano</label>
												<input type="text" name="ano_meta[]" class="form-control maskAno" value="<?php echo $ano->ano ?>">
											</div>
											<div class="line-indicadores-anos">
												<label for="">Valor</label>
												<input type="text" name="valor_ano_meta[]" class="form-control maskValor" value="<?php echo format_real($ano->valor) ?>">
											</div>
											<div class="line-indicadores-anos">
												<label for="">Valor Previsto</label>
												<input type="text" name="valor_previsto_ano_meta[]" class="form-control maskValor" value="<?php echo format_real($ano->valor_previsto) ?>">
											</div>
											<div class="line-indicadores-anos">
												<label for="">Data do Registro</label>
												<input type="text" name="data_registro_ano_meta[]" class="form-control maskData" value="<?php echo convert_data_front($ano->data_registro) ?>">
											</div>
											<div class="line-indicadores-anos">
												<label for="">Justificativa</label>
												<input type="text" name="justificativa_ano_meta[]" class="form-control" value="<?php echo $ano->justificativa ?>">
											</div>
											<div class="line-indicadores-anos">
												<a class="remove-indicador" title="Remover" data-id-ano-indicador="<?php echo $ano->id ?>" <?php echo ($nivel_1) ? 'disabled' : '' ?>>
													<span class="dashicons dashicons-trash text-danger"></span>
												</a>
											</div>
										</li>
									<?php endforeach; ?>
								</ul>
								<div class="indicadores-button">
									<button type="button" class="btn btn-success add-indicadores-anos" <?php echo ($nivel_1) ? 'disabled' : '' ?>>
										<span class="dashicons dashicons-plus"></span>
										Adicionar Indicador Ano
									</button>
								</div>
							</div>
						</div>
						<div class="clear-line"></div>
						<div class="col-md-12">
							<p class="btn-actions">
								<button type="button" class="button button-primary update-indicador-meta">Salvar Meta</button>
							</p>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php endif; ?>
<?php endif; ?>