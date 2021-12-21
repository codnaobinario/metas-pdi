<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if ($variaveis) {
	$indicadores = $variaveis;
} else {
	$indicadores = pdi_get_indicadores_all();
}
?>
<table class="wp-list-table widefat fixed striped pdi-table">
	<tbody>
		<?php if (!$indicadores['error']) : ?>
			<?php foreach ($indicadores as $indicador) : ?>
				<tr>
					<td data-indicador-id="<?php echo $indicador->id ?>">
						<a href="?page=pdi-metas&indicador_id=<?php echo $indicador->id ?>"><?php echo $indicador->id . ' - ' . $indicador->titulo ?></a>
					</td>
					<td class="td-disabled">
						<a title="<?php echo ($indicador->active != 0) ? 'Desabilitar' : 'Habilitar' ?>" class="btn-disabled btn-status-indicador <?php echo ($indicador->active != 0) ? 'enabled' : 'disabled' ?>" data-indicador-id="<?php echo $indicador->id ?>" data-indicador-status="<?php echo ($indicador->active != 0) ? 'true' : 'false' ?>">
							<i class="fas fa-power-off"></i>
							<span><?php echo ($indicador->active != 0) ? 'Ativado' : 'Desativado' ?></span>
						</a>
					</td>
					<td class="td-remove">
						<a title="Remover" class="btn-remove btn-remove-indicador" data-indicador-id="<?php echo $indicador->id ?>">
							<i class="fas fa-trash-alt"></i>
							<span>Remover</span>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php else : ?>
			<tr>
				<td><?php echo $indicadores['error'] ?></td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>