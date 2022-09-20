<?php
defined('ABSPATH') or die('No script kiddies please!');
$eixos = pdi_get_eixo_all();
$atores = pdi_get_atores_all();
$indicadores = pdi_get_indicadores_all();

global $current_user;
$nivel_4 = in_array('pdi_nivel_4', $current_user->roles);
$nivel_3 = in_array('pdi_nivel_3', $current_user->roles);
$ator_meta = get_user_meta($current_user->id, 'pdi_ator');

if ($_GET['indicador']) {
	$indicadorId = $_GET['indicador'];
}

if ($nivel_4) :
	pdi_get_template_front('admin/no-permission');
else :
?>
	<div class="container-fluid pdi-container">
		<div class="pdi-plugin-title">
			<span class="dashicons dashicons-analytics"></span>
			<?php _e('PDI / Adicionar Ação', PDI_TEXT_DOMAIN) ?>
		</div>
		<div class="card card-full p-0">
			<form action="">
				<div class="form-row row">
					<div class="col-md-2 col-label">
						<div class=""><?php _e('Indicador Meta', PDI_TEXT_DOMAIN) ?></div>
					</div>
					<div class="form-group col-md-10">
						<select name="indicador_meta" id="indicador-meta" class="form-control">
							<option value=""><?php _e('Selecione...', PDI_TEXT_DOMAIN) ?></option>
							<?php foreach ($indicadores as $indicador) : ?>
								<?php if ($indicador->active != 0) : ?>
									<option value="<?php echo $indicador->id ?>" <?php echo $indicadorId == $indicador->id ? 'selected' : '' ?>>
										<?php echo $indicador->id . '. ' . $indicador->titulo ?>
									</option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="clear-line"></div>
					<div class="col-md-2 col-label">
						<div class=""><?php _e('Eixo', PDI_TEXT_DOMAIN) ?></div>
					</div>
					<div class="form-group col-md-10">
						<select name="eixo" id="eixo" class="form-control">
							<option value=""><?php _e('Selecione...', PDI_TEXT_DOMAIN) ?></option>
							<?php foreach ($eixos as $eixo) : ?>
								<?php if ($eixo->active != 0) : ?>
									<option value="<?php echo $eixo->id ?>"><?php echo $eixo->descricao ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="clear-line"></div>
					<div class="col-md-2 col-label">
						<div class=""><?php _e('Objetivo Específico', PDI_TEXT_DOMAIN) ?></div>
					</div>
					<div class="form-group col-md-10">
						<div class="card card-full m-2 bk-admin mw-100 overflow-initial">
							<div class="row">
								<div class="form-group col-md-8">
									<ul id="objetivo-especifico">
										<li class="blocos-objetivo-especifico">
											<input type="text" name="objetivo_especifico[]" class="form-control input-objetivo-especifico" data-input-save="true" />
											<div class="dropdown-objetivo-especifico" style="display: none;"></div>
											<a class="remove-objetivo-especifico ml-3" title="Remover">
												<span class="dashicons dashicons-trash text-danger"></span>
											</a>
										</li>
									</ul>
								</div>
								<div class="col-md-4 objetivos-especificos-button">
									<button type="button" class="btn btn-success add-objetivo-especifico">
										<span class="dashicons dashicons-plus"></span>
										<?php _e('Adicionar Objetivo Específico', PDI_TEXT_DOMAIN) ?>
									</button>
								</div>
							</div>


						</div>
					</div>
					<div class="clear-line"></div>
					<div class="col-md-2 col-label">
						<div class="">
							<?php _e('Descrição da Ação', PDI_TEXT_DOMAIN) ?>
						</div>
					</div>
					<div class="form-group col-md-10">
						<input type="text" name="desc_acao" id="desc-acao" class="form-control">
					</div>
					<div class="clear-line"></div>
					<div class="col-md-2 col-label">
						<div class="">
							<?php _e('Ator', PDI_TEXT_DOMAIN) ?>
						</div>
					</div>
					<div class="form-group col-md-10">
						<select name="ator_acao" id="ator-acao" class="form-control">
							<?php if ($nivel_2) : ?>
								<?php $at = pdi_get_atores(['id' => $ator_meta[0]]); ?>
								<?php if ($ator_meta[0] == $at[0]->id) : ?>
									<option value="<?php echo $at[0]->id ?>"><?php echo $at[0]->descricao ?></option>
								<?php endif; ?>
							<?php else : ?>
								<option value=""><?php _e('Selecione...', PDI_TEXT_DOMAIN) ?></option>
								<?php foreach ($atores as $ator) : ?>
									<?php if ($ator->active != 0) : ?>
										<option value="<?php echo $ator->id ?>"><?php echo $ator->descricao ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							<?php endif; ?>
						</select>
					</div>
					<div class="clear-line"></div>
					<div class="col-md-2 col-label">
						<div class=""><?php _e('Ano da Ação', PDI_TEXT_DOMAIN) ?></div>
					</div>
					<div class="form-group col-md-2">
						<input type="text" name="ano_acao" id="ano-acao" class="form-control">
						<!-- <select name="ano_acao" id="ano-acao" class="form-control">
							<option value="">Selecione o Indicador Meta</option>
						</select> -->
					</div>
					<div class="form-group col-md-4 form-group-inline">
						<label for="prazo-execucao"><?php _e('Prazo de Execução', PDI_TEXT_DOMAIN) ?></label>
						<input type="text" name="prazo_execucao" id="prazo-execucao" class="form-control">
					</div>
					<div class="clear-line"></div>
					<div class="col-md-2 col-label">
						<div class=""><?php _e('Percentual Cumprido', PDI_TEXT_DOMAIN) ?></div>
					</div>
					<div class="form-group col-md-2">
						<input type="text" name="percentual_cumprido" id="percentual-cumprido" class="form-control maskValor" />
					</div>
					<div class="form-group col-md-3 form-group-inline">
						<label for=""><?php _e('Data do Registro', PDI_TEXT_DOMAIN) ?></label>
						<input type="text" name="data_registro" class="form-control maskData">
					</div>
					<div class="form-group col-md-5 form-group-inline">
						<label for=""><?php _e('Justificativa', PDI_TEXT_DOMAIN) ?></label>
						<input type="text" name="justificativa_acao" id="justificativa-acao" class="form-control" />
					</div>
					<div class="clear-line"></div>

					<div class="col-md-12">
						<p class="btn-actions">
							<button type="button" class="button button-primary add-acoes"><?php _e('Salvar Ação', PDI_TEXT_DOMAIN) ?></button>
						</p>
					</div>
				</div>
			</form>

		</div>
	</div>
<?php endif; ?>
