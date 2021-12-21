<?php
defined('ABSPATH') or die('No script kiddies please!');
$grandeTema = pdi_get_grande_tema_all();
$objetivoOuse = pdi_get_objetivos_ouse_all();
$eixos = pdi_get_eixo_all();
global $current_user;
$nivel_1 = in_array('pdi_nivel_1', $current_user->roles);
$nivel_2 = in_array('pdi_nivel_2', $current_user->roles);
?>
<?php if (!$_GET['acao_id']) : ?>
	<div class="container-fluid pdi-container">
		<div class="pdi-plugin-title">
			<span class="dashicons dashicons-analytics"></span>
			PDI / Ações
		</div>
		<div class="card card-full p-0">
			<form action="" id="pdi-admin-filter-acoes">
				<div class="form-row row">
					<div class="col-md-3 col-label">
						<div class="">Selecionar Grande Tema Estratégico</div>
					</div>
					<div class="form-group col-md-9">
						<select name="grande_tema" id="grande-tema" class="form-control admin-filter-acoes">
							<option value="">Selecione</option>
							<?php foreach ($grandeTema as $gt) : ?>
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
						<select name="objetivo_ouse" id="objetivo-ouse" class="form-control admin-filter-acoes">
							<option value="">Selecione</option>
							<?php foreach ($objetivoOuse as $ouse) : ?>
								<?php if ($ouse->active != 0) : ?>
									<option value="<?php echo $ouse->id ?>"><?php echo $ouse->descricao ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-3 col-label">
						<div class="">Selecionar Eixo Estruturante</div>
					</div>
					<div class="form-group col-md-9">
						<select name="eixo_estruturante" id="eixo-estruturante" class="form-control admin-filter-acoes">
							<option value="">Selecione</option>
							<?php foreach ($eixos as $eixo) : ?>
								<?php if ($eixo->active != 0) : ?>
									<option value="<?php echo $eixo->id ?>"><?php echo $eixo->descricao ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</form>
		</div>
		<div class="load-table">
			<?php pdi_get_template_front('admin/table-acoes'); ?>
		</div>
	</div>
<?php else : ?>
	<?php $atores = pdi_get_atores_all(); ?>
	<?php $indicadores = pdi_get_indicadores_all(); ?>
	<?php $acao = pdi_get_acoes(['id' => $_GET['acao_id']]) ?>
	<?php $acao = $acao[0] ?>
	<?php $indicadores_anos = pdi_get_indicadores_anos_all(['indicador_id' => $acao->indicador_id]) ?>
	<div class="container-fluid pdi-container">
		<div class="pdi-plugin-title">
			<span class="dashicons dashicons-analytics"></span>
			PDI / Editar Ação
		</div>
		<div class="card card-full p-0">
			<form action="">
				<input type="hidden" name="id" value="<?php echo $acao->id ?>">
				<div class="form-row row">
					<div class="col-md-2 col-label">
						<div class="">Indicador Meta</div>
					</div>
					<div class="form-group col-md-10">
						<select name="indicador_meta" id="indicador-meta" class="form-control" <?php echo ($nivel_1) ? 'readonly' : '' ?>>
							<option value="">Selecione</option>
							<?php foreach ($indicadores as $indicador) : ?>
								<?php if ($indicador->active != 0) : ?>
									<option value="<?php echo $indicador->id ?>" <?php echo ($indicador->id == $acao->indicador_id) ? 'selected="selected"' : '' ?>><?php echo $indicador->id . '. ' . $indicador->titulo ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="clear-line"></div>
					<div class="col-md-2 col-label">
						<div class="">Eixo</div>
					</div>
					<div class="form-group col-md-10">
						<select name="eixo" id="eixo" class="form-control" <?php echo ($nivel_1) ? 'readonly' : '' ?>>
							<option value="">Selecione</option>
							<?php foreach ($eixos as $eixo) : ?>
								<?php if ($eixo->active != 0) : ?>
									<option value="<?php echo $eixo->id ?>" <?php echo ($eixo->id == $acao->eixo_id) ? 'selected="selected"' : '' ?>><?php echo $eixo->descricao ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="clear-line"></div>
					<div class="col-md-2 col-label">
						<div class="">Objetivo Específico</div>
					</div>
					<div class="form-group col-md-10">
						<div class="card card-full m-2 bk-admin mw-100 overflow-initial">
							<div class="row">
								<div class="form-group col-md-8">
									<ul id="objetivo-especifico">
										<?php $objEspecifico = json_decode($acao->objetivo_especifico); ?>
										<?php foreach ($objEspecifico as $objEsp) : ?>
											<?php $obj = pdi_get_objetivo_especifico(['id' => $objEsp]); ?>
											<li class="blocos-objetivo-especifico">
												<input type="text" name="objetivo_especifico[]" class="form-control input-objetivo-especifico" data-input-save="true" value="<?php echo $obj[0]->descricao ?>" <?php echo ($nivel_1) ? 'readonly' : '' ?> />
												<div class="dropdown-objetivo-especifico" style="display: none;"></div>
												<a class="remove-objetivo-especifico ml-3" title="Remover" <?php echo ($nivel_1) ? 'disabled' : '' ?>>
													<span class="dashicons dashicons-trash text-danger"></span>
												</a>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
								<div class="col-md-4 objetivos-especificos-button">
									<button type="button" class="btn btn-success add-objetivo-especifico" <?php echo ($nivel_1) ? 'disabled' : '' ?>>
										<span class="dashicons dashicons-plus"></span>
										Adicionar Objetivo Específico
									</button>
								</div>
							</div>


						</div>
					</div>
					<div class="clear-line"></div>
					<div class="col-md-2 col-label">
						<div class="">Descrição da Ação</div>
					</div>
					<div class="form-group col-md-10">
						<input type="text" name="desc_acao" id="desc-acao" class="form-control" value="<?php echo $acao->descricao_acao ?>" <?php echo ($nivel_1) ? 'readonly' : '' ?>>
					</div>
					<div class="clear-line"></div>
					<div class="col-md-2 col-label">
						<div class="">Ator</div>
					</div>
					<div class="form-group col-md-10">
						<select name="ator_acao" id="ator-acao" class="form-control" <?php echo ($nivel_1) ? 'readonly' : '' ?>>
							<option value="">Selecione</option>
							<?php foreach ($atores as $ator) : ?>
								<?php if ($ator->active != 0) : ?>
									<option value="<?php echo $ator->id ?>" <?php echo ($ator->id == $acao->ator) ? 'selected="selected"' : '' ?>><?php echo $ator->descricao ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="clear-line"></div>
					<div class="col-md-2 col-label">
						<div class="">Ano da Ação</div>
					</div>
					<div class="form-group col-md-2">
						<input type="text" name="ano_acao" id="ano-acao" class="form-control" value="<?php echo $acao->ano_acao ?>">
						<!-- <select name="ano_acao" id="ano-acao" class="form-control" <?php echo ($nivel_1) ? 'readonly' : '' ?>>	
							<select name="ano_acao" id="ano-acao" class="form-control">
							<option value="">Selecione o Indicador Meta</option>
						</select> -->

						</select>
					</div>
					<div class="clear-line"></div>
					<div class="col-md-2 col-label">
						<div class="">Percentual Cumprido</div>
					</div>
					<div class="form-group col-md-2">
						<input type="text" name="percentual_cumprido" id="percentual-cumprido" class="form-control maskValor" value="<?php echo format_real($acao->percentual_cumprido) ?>" />
					</div>
					<div class="form-group col-md-3 form-group-inline">
						<label for="">Data do Registro</label>
						<input type="text" name="data_registro" class="form-control maskData" value="<?php echo convert_data_front($acao->data_registro) ?>">
					</div>
					<div class="form-group col-md-5 form-group-inline">
						<label for="">Justificativa</label>
						<input type="text" name="justificativa_acao" id="justificativa-acao" class="form-control" value="<?php echo $acao->justificativa ?>" />
					</div>
					<div class="clear-line"></div>

					<div class="col-md-12">
						<p class="btn-actions">
							<button type="button" class="button button-primary update-acoes">Salvar Ação</button>
						</p>
					</div>
				</div>
			</form>

		</div>
	</div>
<?php endif; ?>