<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$acoes = $variaveis['valores_acoes'];
$metas = $variaveis['dados_meta'];
$metaInicial = $variaveis['meta_valor_inical'];
$metaFinal = $variaveis['meta_valor_final'];
$valor_real_acoes = intval($acoes['total_acoes']) / 100 * intval($acoes['media_percentual_cumprido']);
$porcentMeta = $variaveis['meta_percent'];

?>

<div class="grafico-bar">
	<div class="grafico-box">
		<div class="divisoes line-top"></div>
		<div class="divisoes"></div>
		<div class="divisoes"></div>
		<div class="divisoes"></div>
		<!-- <div class="divisoes"></div> -->
		<div class="divisoes no-line"></div>
	</div>
	<div class="grafico-estatisticas">
		<div class="divisoes">
			<div class="eixo-x">
				<span class="eixo-100">100%</span>
			</div>
		</div>
		<div class="divisoes">
			<div class="eixo-x">
				<span>80%</span>
			</div>
		</div>
		<div class="divisoes">
			<div class="eixo-x">
				<span>60%</span>
			</div>
		</div>
		<div class="divisoes">
			<div class="eixo-x">
				<span>40%</span>
			</div>
		</div>
		<div class="divisoes">
			<div class="eixo-x">
				<span>20%</span>
			</div>
		</div>
		<!-- <div class="divisoes"></div> -->
	</div>
	<div class="graficos-valores">
		<div class="divisoes"></div>
		<div class="divisoes div-left" data-indicador-id="<?php echo $variaveis['indicador_id'] ?>">
			<div class="valores-meta valores-meta-down" style="background-color: <?php echo $variaveis['colors'][0] . '99' ?>;">
				<span><?php echo format_real($metas->valor_previsto, 2) ?></span>
			</div>
			<div class="valores-meta valores-meta-up" data-indicador-id="<?php echo $variaveis['indicador_id'] ?>" style="height: <?php echo $porcentMeta ?>%; background-color: <?php echo $variaveis['colors'][0] ?>;">
				<span><?php echo format_real($metas->valor, 2) ?></span>
				<div class="value-float-left value-float-left-<?php echo $variaveis['indicador_id'] ?>" style="display: none;"><?php echo $porcentMeta ?>%</div>
			</div>
			<div class="legend-y">
				<div class="legend-top">% METAS</div>
				<div class="legend-bottom">no ano</div>
			</div>
		</div>
		<div class="divisoes"></div>
		<div class="divisoes div-right" data-indicador-id="<?php echo $variaveis['indicador_id'] ?>">
			<div class="valores-acoes valores-acoes-down" style="background-color: <?php echo $variaveis['colors'][1] . '99' ?>;">
				<span><?php echo $acoes['total_acoes'] ?></span>
			</div>
			<div class="valores-acoes valores-acoes-up" style="height: <?php echo $acoes['media_percentual_cumprido'] ?>%; background-color: <?php echo $variaveis['colors'][1] ?>;">
				<span><?php echo format_real($valor_real_acoes, 2) ?></span>
				<div class="value-float-right value-float-right-<?php echo $variaveis['indicador_id'] ?>" style="display: none;"><?php echo $acoes['media_percentual_cumprido'] ?>%</div>
			</div>
			<div class="legend-y">
				<div class="legend-top">% AÇÕES</div>
				<div class="legend-bottom">no ano</div>
			</div>
		</div>
		<div class="divisoes"></div>
	</div>
</div>