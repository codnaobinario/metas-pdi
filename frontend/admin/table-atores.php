<?php
defined('ABSPATH') or die('No script kiddies please!');
if ($variaveis) {
	$atorId = $variaveis;
	$atores = pdi_get_atores_all();
} else {
	$atores = pdi_get_atores_all();
}
?>
<table class="wp-list-table widefat fixed striped pdi-table">
	<?php if (!$atores) : ?>
		<tbody>
			<tr>
				<td><?php _e('Nenhum registro escontrado', PDI_TEXT_DOMAIN) ?></td>
			</tr>
		</tbody>
	<?php else : ?>
		<tbody>
			<?php foreach ($atores as $ator) : ?>
				<tr>
					<td data-ator-id="<?php echo $ator->id ?>">
						<a href="?page=pdi-ator&edit=<?php echo $ator->id ?>">
							<?php echo $ator->id . ' - ' . $ator->descricao ?>
						</a>
					</td>
					<td class="td-remove">
						<a title="Remover" class="btn-remove btn-remove-ator" data-ator-id="<?php echo $ator->id ?>">
							<i class="fas fa-trash-alt"></i>
							<span><?php _e('Remover', PDI_TEXT_DOMAIN) ?></span>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	<?php endif; ?>
</table>
