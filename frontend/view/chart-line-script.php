<?php
$grandeTema = pdi_get_grande_tema(array('id' => $indicador->grande_tema_id));
$gtLayout = json_decode($grandeTema[0]->layout);

$indicares_anos = pdi_get_indicadores_anos_all(['indicador_id' => $indicador->id]);
// $valores1 = [];
$valores1_view = [];
// $valores2 = [];
$valores2_view = [];
$anos = [];
foreach ($indicares_anos as $indic_anos) {
	// $valores1[] = calc_valores_indicares_linha($indicador->valor_inicial, $indicador->valor_meta, $indic_anos->valor);
	$valores1_view[] = $indic_anos->valor;
	// $valores2[] = calc_valores_indicares_linha($indicador->valor_inicial, $indicador->valor_meta, $indic_anos->valor_previsto);
	$valores2_view[] = $indic_anos->valor_previsto;
	$anos[] = intval($indic_anos->ano);
}

// $valorInicial = $indicador->valor_inicial;
$valorInicial = pdi_calc_val_chart_line(null, $indicador->valor_meta, $indicador->valor_inicial);
/* $anos = [2021, 2022, 2023, 2024, 2025];
$valores1 = [0.25, 0.48, 0.61, 0, 0];
$valores2 = [0, 0.68, 0.71, 0.88, 1]; */
$anoInicial = intval(date('Y', strtotime($indicador->data_registro)));
// $anoInicial = $anos[0];

// print_r(json_encode($valores2_view));
// print_r($indicador->valor_inicial);
?>
<script>
	(function($) {
		$(document).ready(function() {

			const labels = ['<?php echo $anoInicial ?>'];
			<?php foreach ($anos as $ano) : ?>
				labels.push('<?php echo $ano ?>')
			<?php endforeach; ?>

			const data1 = [<?php echo $indicador->valor_inicial ?>];
			<?php foreach ($valores1_view as $val1) : ?>
				data1.push('<?php echo $val1 ?>')
			<?php endforeach; ?>

			const data2 = [<?php echo $indicador->valor_inicial ?>];
			<?php foreach ($valores2_view as $val2) : ?>
				data2.push('<?php echo $val2 ?>')
			<?php endforeach; ?>

			const ctx = document.getElementById(`myChart-line-<?php echo $indicador->id ?>`).getContext('2d');
			const myChart = new Chart(ctx, {
				type: 'line',
				data: {
					labels,
					datasets: [{
							label: 'Série Histórica',
							data: data1,
							backgroundColor: [
								'<?php echo $gtLayout[1] ?>',
							],
							borderColor: [
								'<?php echo $gtLayout[1] ?>',
							],
							borderWidth: 8,
							tension: 0,
						},
						{
							label: 'Metas Previstas',
							data: data2,
							backgroundColor: [
								'#5b5b5b',
							],
							borderColor: [
								'#5b5b5b',
							],
							borderWidth: 8,
							tension: 0,
						},
					]
				},
				options: {
					tooltips: {
						enabled: false
					},
					plugins: {
						legend: {
							display: true,
							position: 'bottom',
							labels: {
								boxHeight: 3,
							},
						},
					},
					scales: {
						y: {
							min: 0,
							ticks: {
								callback: function(value) {
									return value + "%"
								},
							},
							scaleLabel: {
								display: true,
								labelString: "Percentage",
							},
						},
					},
				}
			});
		})
	})(jQuery)
</script>
