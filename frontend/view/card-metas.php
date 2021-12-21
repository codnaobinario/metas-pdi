<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$view_pagination = 5;
$page = 1;
if(isset($_GET['page'])) $page = $_GET['page'];

$count_total = pdi_count_indicadores_all(['active' => 1]);
$pagnation = ceil(intval($count_total) / $view_pagination);

if (!$variaveis) {
	$indicadores = pdi_get_indicadores_all(['active' => 1], $view_pagination, $page);
} else {
	$indicadores = $variaveis['indicadores'];
	$page = $variaveis['page'];
	$pagnation = $variaveis['pagnation'];
}

?>
<?php foreach ($indicadores as $indicador) : ?>
	<?php

	$ano_atual = date('Y');
	$ano_indicador_view = date('Y', strtotime('-1 year'));

	$indicador->indicadores_anos = pdi_get_indicadores_anos_all(['indicador_id' => intval($indicador->id)]);
	$anos = get_anos_de_referencia($indicador->indicadores_anos);
	$indicador->grande_tema = pdi_get_grande_tema(['id' => intval($indicador->grande_tema_id)]);
	$colors = json_decode($indicador->grande_tema[0]->layout);
	$indicador->objetivo_ouse = pdi_get_objetivos_ouse(['id' => intval($indicador->objetivo_ouse_id)]);
	$indicador->acoes = pdi_get_acoes(['indicador_id' => intval($indicador->id)]);

	if ($indicador->acoes) {
		$acoes_por_ano = filtrar_acoes_por_ano($indicador->acoes);
		$calculos_acoes = calc_valores_acoes($acoes_por_ano);
	}


	$metas_por_ano = filtrar_metas_por_ano($indicador->indicadores_anos);

	?>
	<div class="col-md-12 mb-5 card-metas">
		<div id="indicador-<?php echo $indicador->id ?>" class="card card-indicadores" style="color: <?php echo $colors[1] ?>">
		<input type="hidden" name="page" id="page" value="<?php echo $page ?>">
			<div class="card-indicadores-title">
				<div class="card-top-left">
					<a href="<?php echo site_url('/detalhes-meta/?indicador_id=' . $indicador->id) ?>">
						<div class="bar" style="background-color: <?php echo $colors[1] ?>"></div>
						<div class="meta">META</div>
						<div class="id"><?php echo $indicador->id ?></div>
					</a>
				</div>
				<div class="card-top-center">
					<div class="card-label-top">
						Grande Tema Estratégico
					</div>
					<div class="card-label-botton">
						<?php printf('%s. %s', $indicador->grande_tema[0]->id, $indicador->grande_tema[0]->descricao) ?>
					</div>
					<div class="card-label-top">
						Objetivo Ouse
					</div>
					<div class="card-label-botton">
						<?php printf('%s. %s', $indicador->objetivo_ouse[0]->id, $indicador->objetivo_ouse[0]->descricao) ?>
					</div>
				</div>
				<div class="card-top-right">
					<a href="<?php echo site_url('/detalhes-meta/?indicador_id=' . $indicador->id) ?>" class="btn btn-actions-indicadores">
						<i class="fas fa-chart-pie"></i>
						Detalhes desta meta
					</a>
					<button type="button" class="btn btn-actions-indicadores btn-add-notification" data-indicador-id="<?php echo $indicador->id ?>">
						<i class="fas fa-bell"></i>
						Receber notificações
					</button>
				</div>
			</div>
			<div class="card card-indicardor-statistic">
				<form action="" id="form-notification-<?php echo $indicador->id ?>" style="display: none;">
					<div class="form-row row-send-notification">
						<div class="form-group col-md-12">
							<label class="label-top" for="">Receba atualizações sobre esta meta por e-mail</label>
						</div>
						<input type="hidden" name="notification_indicador_id" value="<?php echo $indicador->id ?>">
						<div class="form-group col-md-6">
							<label for="">Nome<span class="label-required">*</span></label>
							<input type="text" name="notification_name" class="form-control" required>
						</div>
						<div class="form-group col-md-6">
							<label for="">Email<span class="label-required">*</span></label>
							<input type="email" name="notification_email" class="form-control" required>
						</div>
						<div class="form-group col-md-12">
							<div class="form-check check-privacy-terms">
								<input type="checkbox" value="1" id="privacy-terms-<?php echo $indicador->id ?>" name="privacy-terms" class="form-check-input privacy-terms" required>
								<label class="form-check-label" for="privacy-terms-<?php echo $indicador->id ?>">Eu concordo em fornecer meu endereço de e-mail ao "Portal de Monitoramento do PDI" para receber informações sobre novas publicações do site, atualização de dados, informativos e eventos vinculados ao PDI da Unifesp. Estou ciente que posso revogar esse consentimento a qualquer momento por e-mail, clicando no link "cancelar inscrição", localizado na parte inferior de qualquer mensagem enviada a mim para os fins mencionados acima ou via Ouvidoria na página <a href="https://www.ouvidoria.unifesp.br">https://www.ouvidoria.unifesp.br</a></label>
							</div>
						</div>
						<div class="form-group col-md-12 text-right">
							<button type="button" class="btn btn-secondary add-notification" data-indicador-id="<?php echo $indicador->id ?>">Receber notificações</button>
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
								<a href="<?php echo site_url('/detalhes-meta/?indicador_id=' . $indicador->id) ?>">
									<?php printf('%s', $indicador->titulo) ?>
								</a>
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
									'valores_acoes' => $calculos_acoes[$indicador_anos->ano],
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
		</div>
	</div>
<?php endforeach; ?>
<div class="pdi-pagination pagination-front">
	<button type="button" class="btn pdi-pagination-prev" data-page="<?php echo $page - 1 ?>" <?php echo ($page <= 1) ? 'disabled' : '' ?>>Anterior</button>
	<?php for ($i = 0; $i < $pagnation; $i++) : ?>
		<button type="button" class="btn pdi-pagination-btn <?php echo ($i + 1 == $page) ? 'active' : '' ?>" data-page="<?php echo $i + 1 ?>" <?php echo ($i + 1 == $page) ? 'disabled' : '' ?>>
			<?php echo $i + 1 ?>
		</button>
	<?php endfor; ?>
	<button type="button" class="btn pdi-pagination-next" data-page="<?php echo $page + 1 ?>" <?php echo ($page >= $pagnation) ? 'disabled' : '' ?>>Próximo</button>
</div>