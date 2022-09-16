<?php
defined('ABSPATH') or die('No script kiddies please!');
if ($variaveis) {
	$indicador_id = $variaveis;
}

if ($_GET['indicador_id']) {
	$indicador_id = $_GET['indicador_id'];
}

$ano_atual = date('Y');
$ano_indicador_view = date('Y', strtotime('-1 year'));

$indicador = pdi_get_indicadores(['id' => intval($indicador_id)]);
$indicador = $indicador[0];
$indicador->indicadores_anos = pdi_get_indicadores_anos_all(['indicador_id' => intval($indicador_id)]);
$anos = get_anos_de_referencia($indicador->indicadores_anos);
$grande_tema = pdi_get_grande_tema(['id' => intval($indicador->grande_tema_id)]);
$indicador->grande_tema = $grande_tema[0];
$colors = json_decode($indicador->grande_tema->layout);
$objetivo_ouse = pdi_get_objetivos_ouse(['id' => intval($indicador->objetivo_ouse_id)]);
$indicador->objetivo_ouse = $objetivo_ouse[0];
$acoes = pdi_get_acoes(['indicador_id' => intval($indicador_id)]);
$indicador->acoes = $acoes;

$ods_ = json_decode($indicador->ods);
$indicador->ods = [];
foreach ($ods_ as $o) {
	$indicador->ods[] = pdi_get_ods(['id' => intval($o)]);
}
$pne_ = json_decode($indicador->pne);
$indicador->pne = [];
foreach ($pne_ as $p) {
	$indicador->pne[] = pdi_get_pne(['id' => intval($p)]);
}

if ($indicador->acoes) {
	$acoes_por_ano = filtrar_acoes_por_ano($indicador->acoes);
	$calculos_acoes = calc_valores_acoes($acoes_por_ano);
}



$metas_por_ano = filtrar_metas_por_ano($indicador->indicadores_anos);


?>
<div class="col-md-12 mb-5 card-metas">
	<div id="indicador-<?php echo $indicador->id ?>" class="card card-indicadores" style="color: <?php echo $colors[1] ?>">
		<div class="card-indicadores-title">
			<div class="card-top-left">
				<div class="bar" style="background-color: <?php echo $colors[1] ?>"></div>
				<div class="meta">
					<?php _e('Indicador', PDI_TEXT_DOMAIN) ?>
				</div>
				<div class="id">
					<?php echo $indicador->number ? $indicador->number : $indicador->id ?>
				</div>
			</div>
			<div class="card-top-center">
				<div class="card-label-top">
					<?php _e('Grande Tema Estratégico', PDI_TEXT_DOMAIN) ?>
				</div>
				<div class="card-label-botton">
					<?php $number = $indicador->grande_tema->number && $indicador->grande_tema->number != 0 ? $indicador->grande_tema->number : null;  ?>
					<?php $gtNumber = $number ? $number : $indicador->grande_tema->id ?>
					<?php printf('%s. %s', $gtNumber, $indicador->grande_tema->descricao) ?>
				</div>
				<div class="card-label-top">
					<?php _e('Objetivo Ouse', PDI_TEXT_DOMAIN) ?>
				</div>
				<div class="card-label-botton">
					<?php $number = $indicador->objetivo_ouse->number && $indicador->objetivo_ouse->number != 0 ? $indicador->objetivo_ouse->number : null;  ?>
					<?php $ouseNumber = $number ? $number : $indicador->objetivo_ouse->id ?>
					<?php printf('%s. %s', $ouseNumber, $indicador->objetivo_ouse->descricao) ?>
				</div>
			</div>
			<div class="card-top-right">
				<button type="button" class="btn btn-actions-indicadores btn-add-notification" data-indicador-id="<?php echo $indicador->id ?>">
					<i class="fas fa-bell"></i>

				</button>
			</div>
		</div>
		<div class="card card-indicardor-statistic">
			<form action="" id="form-notification-<?php echo $indicador->id ?>" style="display: none;">
				<div class="form-row row-send-notification">
					<div class="form-group col-md-12">
						<label class="label-top" for="">
							<?php _e('Receba atualizações sobre esta meta por e-mail', PDI_TEXT_DOMAIN) ?>
						</label>
					</div>
					<input type="hidden" name="notification_indicador_id" value="<?php echo $indicador->id ?>">
					<div class="form-group col-md-6">
						<label for="">
							<?php _e('Nome', PDI_TEXT_DOMAIN) ?>
							<span class="label-required">*</span></label>
						<input type="text" name="notification_name" class="form-control" required>
					</div>
					<div class="form-group col-md-6">
						<label for="">
							<?php _e('Email', PDI_TEXT_DOMAIN) ?>
							<span class="label-required">*</span></label>
						<input type="email" name="notification_email" class="form-control" required>
					</div>
					<div class="form-group col-md-12">
						<div class="form-check check-privacy-terms">
							<input type="checkbox" value="1" id="privacy-terms-<?php echo $indicador->id ?>" name="privacy-terms" class="form-check-input privacy-terms" required>
							<label class="form-check-label" for="privacy-terms-<?php echo $indicador->id ?>"><?php _e('Eu concordo em fornecer meu endereço de e-mail ao "Portal de Monitoramento do PDI" para receber informações sobre novas publicações do site, atualização de dados, informativos e eventos vinculados ao PDI da Unifesp. Estou ciente que posso revogar esse consentimento a qualquer momento por e-mail, clicando no link "cancelar inscrição", localizado na parte inferior de qualquer mensagem enviada a mim para os fins mencionados acima ou via Ouvidoria na página', PDI_TEXT_DOMAIN) ?> <a href="https://www.ouvidoria.unifesp.br">https://www.ouvidoria.unifesp.br</a></label>
						</div>
					</div>
					<div class="form-group col-md-12 text-right">
						<button type="button" class="btn btn-secondary add-notification" data-indicador-id="<?php echo $indicador->id ?>">
							<?php _e('Receber notificações', PDI_TEXT_DOMAIN) ?>
						</button>
					</div>
				</div>
			</form>
			<div class="row" id="meta-content-<?php echo $indicador->id ?>">
				<div class="col-md-6">
					<div class="titulo-indicador">
						<!-- <div class="card-label-top">
								Indicador
							</div> -->
						<div class="card-label-botton">
							<?php printf('%s', $indicador->titulo) ?>
						</div>
						<div class="card-label-top label-descricao">
							<?php echo $indicador->descricao ?>
						</div>
					</div>
					<div class="dados-indicadores">
						<div>
							<?php $ano_atual = date('Y'); ?>
							<?php $ano_indicador_view = date('Y', strtotime('-1 year')); ?>
							<div class="card-label-top">
								Valor do indicador - <?php echo date('Y', strtotime($indicador->data_registro)) ?>
							</div>
							<div class="card-label-value valor-ano-<?php echo $indicador->id ?>">
								<?php echo format_real($indicador->valor_inicial, 2) ?>
							</div>
						</div>
						<div>
							<div class="card-label-top">
								Meta do indicador - <?php echo return_maior($anos) ?>
							</div>
							<div class="card-label-value">
								<?php printf('%s', format_real($indicador->valor_meta, 2)) ?>
							</div>
						</div>
						<div>
							<div class="card-label-top">
								Ano de referência
							</div>
							<?php foreach ($indicador->indicadores_anos as $key => $indicador_anos) : ?>
								<div class="card-label-value data-ano-<?php echo $indicador->id ?> <?php echo ($indicador_anos->ano == $ano_atual) ? 'active' : '' ?>" id="data-ano-<?php printf('%s-%s', $indicador->id, $indicador_anos->ano) ?>" <?php echo ($indicador_anos->ano == $ano_atual) ? '' : 'style="display:none"' ?>>
									<span><?php echo $indicador_anos->ano ?></span>
								</div>
							<?php endforeach; ?>
							<div class="icon-select-meta">
								<i class="fas fa-caret-down view-anos" data-indicador-id="<?php echo $indicador->id ?>"></i>
								<div class="box-view-anos" id="view-anos-<?php echo $indicador->id ?>" style="display: none;">
									<ul>
										<?php foreach ($anos as $a) : ?>
											<li class="select-ano" data-indicador-id="<?php echo $indicador->id ?>" data-ano="<?php echo $a ?>">
												<?php print_r($a) ?>
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>

						</div>
					</div>
					<?php foreach ($indicador->indicadores_anos as $key => $indicador_anos) : ?>
						<div class="indicador-percent indicador-percent-<?php echo $indicador->id ?> <?php echo ($indicador_anos->ano == $ano_atual) ? 'active' : '' ?>" id="indicador-percent-<?php printf('%s-%s', $indicador->id, $indicador_anos->ano) ?>" <?php echo ($indicador_anos->ano == $ano_atual) ? '' : 'style="display:none"' ?>>
							<div class="indicar-percent-meta">
								<span>
									<?php echo calc_porcent_meta($metas_por_ano[$indicador_anos->ano]->valor_previsto, $metas_por_ano[$indicador_anos->ano]->valor) ?>%
								</span>
								<strong>Desempenho para alcançar a meta do ano</strong>
							</div>
							<div class="indicar-percent-ano">
								<span>
									<?php echo $calculos_acoes[$indicador->id][$indicador_anos->ano]['media_percentual_cumprido'] ?>%
								</span>
								<strong>Execução das ações previstas no ano</strong>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="col-md-6 chart-box">
					<?php foreach ($indicador->indicadores_anos as $key => $indicador_anos) : ?>
						<div class="indicador-chart-<?php echo $indicador->id ?> <?php echo ($indicador_anos->ano == $ano_atual) ? 'active' : '' ?>" id="indicador-chart-<?php printf('%s-%s', $indicador->id, $indicador_anos->ano) ?>" <?php echo ($indicador_anos->ano == $ano_atual) ? '' : 'style="display:none"' ?>">
							<?php
							$porcentMeta = calc_porcent_meta($metas_por_ano[$indicador_anos->ano]->valor_previsto, $metas_por_ano[$indicador_anos->ano]->valor);

							$var = [
								'indicador_id' => $indicador->id,
								'colors' => $colors,
								'valores_acoes' => $calculos_acoes[$indicador->id][$indicador_anos->ano],
								'dados_meta' => $metas_por_ano[$indicador_anos->ano],
								'meta_valor_inical' => $indicador->valor_inicial,
								'meta_valor_final' => $indicador->valor_meta,
								'meta_percent' => $porcentMeta,
							];
							pdi_get_template_front('view/grafico-bar', $var);
							?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="card card-indicardor-detalhes">
			<div class="row row-indicardor-detalhes">
				<div class="col-md-8 title-card">
					<img src="<?php echo PDI_PLUGIN_URL ?>assets/images/icons-card/icon-ods.png" alt="" width="29">
					OBJETIVOS GLOBAIS PARA O DESENVOLVIMENTO SUSTENTÁVEL
				</div>
				<div class="col-md-12">
					<ul class="list-ods">
						<?php foreach ($indicador->ods as $ods) : ?>
							<li id="ods_<?php echo $ods[0]->slug ?>">
								<img src="<?php echo PDI_PLUGIN_URL . $ods[0]->img . '.png' ?>" alt="" title="<?php echo $ods[0]->titulo ?>">
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="card card-indicardor-detalhes">
			<div class="row row-indicardor-detalhes">
				<div class="col-md-8 title-card">
					<img src="<?php echo PDI_PLUGIN_URL ?>assets/images/icons-card/icon-pne.png" alt="" width="20">
					METAS DO PNE
				</div>
				<div class="col-md-12">
					<ul class="list-pne">
						<?php foreach ($indicador->pne as $pne) : ?>
							<li id="pne_<?php echo $pne[0]->slug ?>" title="<?php echo $pne[0]->titulo ?>">
								<span><?php printf('%s. %s', $pne[0]->id, $pne[0]->titulo) ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="card card-indicardor-detalhes">
			<div class="row row-indicardor-detalhes">
				<div class="col-md-8 title-card">
					<img src="<?php echo PDI_PLUGIN_URL ?>assets/images/icons-card/icon-serie-historica.png" alt="" width="20">
					SÉRIE HISTÓRICA
				</div>
				<div class="col-md-11 mt-5">
					<div class="chart-box mb-5">
						<!-- <div class="legenda-grafico-linha">
							<?php _e('% de metas cumpripas sobre meta do indicador') ?>
						</div> -->
						<?php pdi_get_template_front('view/grafico-linha', $indicador) ?>
					</div>
				</div>
			</div>
		</div>
		<div class="card card-indicardor-detalhes">
			<div class="row row-indicardor-detalhes">
				<div class="col-md-8 title-card">
					<img src="<?php echo PDI_PLUGIN_URL ?>assets/images/icons-card/icon-serie-historica.png" alt="" width="20">
					AÇÕES
				</div>
				<div class="col-md-12 indicardor-detalhes-acoes">
					<?php pdi_get_template_front('view/detalhes-acoes', $indicador); ?>
				</div>
			</div>
		</div>
		<div class="card card-indicardor-detalhes">
			<div class="row row-indicardor-detalhes">
				<div class="col-md-8 title-card">
					<img src="<?php echo PDI_PLUGIN_URL ?>assets/images/icons-card/icon-comentarios.png" alt="" width="20">
					COMENTARIOS
				</div>
				<div class="col-md-7 d-flex align-items-center">
					<?php pdi_get_template_front('view/detalhes-comments', ['indicador' => $indicador]); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php

?>
