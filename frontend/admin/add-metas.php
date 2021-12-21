<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$ods = pdi_get_ods_all();
$pne = pdi_get_pne_all();
$grande_tema = pdi_get_grande_tema_all();
$objetivos_ouse = pdi_get_objetivos_ouse_all();

global $current_user;
if (in_array('pdi_nivel_1', $current_user->roles) || in_array('pdi_nivel_2', $current_user->roles)) :
	pdi_get_template_front('admin/no-permission');
else :
?>
	<div class="container-fluid pdi-container">
		<div class="pdi-plugin-title">
			<span class="dashicons dashicons-analytics"></span>
			PDI / Adicionar Meta
		</div>
		<div class="card card-full p-0">
			<form id="add-indicadores-meta" action="">
				<div class="form-row row">
					<div class="col-md-3 col-label">
						<div class="">Grande Tema Estratégico</div>
					</div>
					<div class="form-group col-md-9">
						<select name="grande_tema" id="grande-tema" class="form-control">
							<option value="">Selecione</option>
							<?php foreach ($grande_tema as $gt) : ?>
								<?php if ($gt->active != 0) : ?>
									<option value="<?php echo $gt->id ?>"><?php echo $gt->descricao ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="clear-line"></div>
					<div class="col-md-3 col-label">
						<div class="">Objetivo Ouse</div>
					</div>
					<div class="form-group col-md-9">
						<select name="objetivo_ouse" id="objetivo-ouse" class="form-control" disabled>
							<option value="">Selecione o Grande Tema</option>
							
						</select>
					</div>
					<div class="clear-line"></div>
					<div class="col-md-3 col-label">
						<div class="">Indicador</div>
					</div>
					<div class="form-group col-md-9">
						<input type="text" name="indicador" id="indicador" class="form-control">
					</div>
					<div class="clear-line"></div>
					<div class="col-md-3 col-label">
						<div class="">Descrição da Meta</div>
					</div>
					<div class="form-group col-md-9">
						<textarea name="desc_meta" id="desc-meta" class="form-control" rows="3"></textarea>
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
									<input class="form-check-input" type="checkbox" id="<?php echo $ods[$i]->slug ?>" name="ods[]" value="<?php echo $ods[$i]->id ?>">
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
									<input class="form-check-input" type="checkbox" id="<?php echo $pne[$i]->slug ?>" name="pne[]" value="<?php echo $pne[$i]->id ?>">
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
						<input type="text" name="valor_meta" id="valor_meta" class="form-control valor-meta  maskValor">
					</div>
					<div class="clear-line"></div>
					<div class="col-md-3 col-label">
						<div class="">Valor Inicial</div>
						<div class="label-informativo">Dado coletado que é parâmetro para definição da meta.</div>
					</div>
					<div class="form-group col-md-2">
						<input type="text" name="valor_inicial_meta" id="valor-inicial-meta" class="form-control maskValor">
					</div>
					<div class="form-group col-md-3 form-group-inline">
						<label for="">Data do Registro</label>
						<input type="text" name="data_registro_meta" id="data-registro-meta" class="form-control maskData">
					</div>
					<div class="clear-line"></div>
					<div class="col-md-12">
						<div class="card card-full m-2 bk-admin">
							<ul id="indicadores-anos">
								<li class="blocos-indicadores-anos">
									<div class="line-indicadores-anos">
										<label for="">Ano</label>
										<input type="text" name="ano_meta[]" class="form-control maskAno">
									</div>
									<div class="line-indicadores-anos">
										<label for="">Valor</label>
										<input type="text" name="valor_ano_meta[]" class="form-control maskValor">
									</div>
									<div class="line-indicadores-anos">
										<label for="">Valor Previsto</label>
										<input type="text" name="valor_previsto_ano_meta[]" class="form-control maskValor">
									</div>
									<div class="line-indicadores-anos">
										<label for="">Data do Registro</label>
										<input type="text" name="data_registro_ano_meta[]" class="form-control maskData">
									</div>
									<div class="line-indicadores-anos">
										<label for="">Justificativa</label>
										<input type="text" name="justificativa_ano_meta[]" class="form-control">
									</div>
									<div class="line-indicadores-anos">
										<a class="remove-indicador" title="Remover">
											<span class="dashicons dashicons-trash text-danger"></span>
										</a>
									</div>
								</li>
							</ul>
							<div class="indicadores-button">
								<button type="button" class="btn btn-success add-indicadores-anos">
									<span class="dashicons dashicons-plus"></span>
									Adicionar Indicador Ano
								</button>
							</div>
						</div>
					</div>
					<div class="clear-line"></div>
					<div class="col-md-12">
						<p class="btn-actions">
							<button type="button" class="button button-primary add-indicador-meta">Salvar Meta</button>
						</p>
					</div>
				</div>
			</form>

		</div>
	</div>
<?php endif; ?>