<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
if ($variaveis) {
	$acoes = $variaveis;
} else {
	$acoes = pdi_get_acoes_all();
}
?>

<table class="wp-list-table widefat fixed striped pdi-table">
	<tbody>
		<?php if (!$acoes['error']) : ?>
			<?php foreach ($acoes as $acao) : ?>
				<tr>
					<td data-acao-id="<?php echo $acao->id ?>">
						<a href="?page=pdi-acoes&acao_id=<?php echo $acao->id ?>"><?php echo $acao->descricao_acao ?></a>
					</td>
					<td class="td-disabled">
						<a title="<?php echo ($acao->active != 0) ? 'Desabilitar' : 'Habilitar' ?>" class="btn-disabled btn-status-acao <?php echo ($acao->active != 0) ? 'enabled' : 'disabled' ?>" data-acao-id="<?php echo $acao->id ?>" data-acao-status="<?php echo ($acao->active != 0) ? 'true' : 'false' ?>">
							<i class="fas fa-power-off"></i>
							<span><?php echo ($acao->active != 0) ? 'Ativado' : 'Desativado' ?></span>
						</a>
					</td>
					<td class="td-remove">
						<a title="Remover" class="btn-remove btn-remove-acao" data-acao-id="<?php echo $acao->id ?>">
							<i class="fas fa-trash-alt"></i>
							<span>Remover</span>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php else : ?>
			<tr>
				<td><?php echo $acoes['error'] ?></td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>