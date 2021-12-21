<?php
defined('ABSPATH') or die('No script kiddies please!');
if ($variaveis) {
	$grandeTemaId = $variaveis;
	$grande_tema = pdi_get_grande_tema_all();
} else {
	$grande_tema = pdi_get_grande_tema_all();
}
?>
<table class="wp-list-table widefat fixed striped pdi-table">
	<?php if (!$grande_tema) : ?>
		<tbody>
			<tr>
				<td><?php _e('Nenhum registro escontrado', PDI_TEXT_DOMAIN) ?></td>
			</tr>
		</tbody>
	<?php else : ?>
		<tbody>
			<?php foreach ($grande_tema as $gt) : ?>
				<tr>
					<td data-gt-id="<?php echo $gt->id ?>">
						<a href="?page=pdi-grande-tema&edit=<?php echo $gt->id ?>">
							<?php echo $gt->id . ' - ' . $gt->descricao ?>
						</a>
					</td>
					<td class="td-remove">
						<a title="Remover" class="btn-remove btn-remove-grande-tema" data-gt-id="<?php echo $gt->id ?>">
							<i class="fas fa-trash-alt"></i>
							<span><?php _e('Remover', PDI_TEXT_DOMAIN) ?></span>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	<?php endif; ?>
</table>