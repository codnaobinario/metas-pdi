<?php
defined('ABSPATH') or die('No script kiddies please!');
if ($variaveis) {
	$grandeTemaId = $variaveis;
	$objetivosOuse = pdi_get_objetivos_ouse(['grande_tema_id' => $grandeTemaId]);
} else {
	$objetivosOuse = pdi_get_objetivos_ouse_all();
}
?>

<table class="wp-list-table widefat fixed striped pdi-table">
	<?php if (!$objetivosOuse) : ?>
		<tbody>
			<tr>
				<td><?php _e('Nenhum registro escontrado', PDI_TEXT_DOMAIN) ?></td>
			</tr>
		</tbody>
	<?php else : ?>
		<tbody>
			<?php if (!$objetivosOuse['error']) : ?>
				<?php foreach ($objetivosOuse as $ouse) : ?>
					<tr>
						<td data-ouse-id="<?php echo $ouse->id ?>">
							<a href="?page=pdi-objetivos-ouse&edit=<?php echo $ouse->id ?>">
								<?php $ouseNumber = $ouse->number ? $ouse->number : $ouse->id ?>
								<?php echo $ouse->id . ' - ' . $ouse->descricao ?>
							</a>
						</td>
						<td class="td-remove">
							<a title="Remover" class="btn-remove btn-remove-objetivos-ouse" data-objetivo-ouse-id="<?php echo $ouse->id ?>">
								<i class="fas fa-trash-alt"></i>
								<span><?php _e('Remover', PDI_TEXT_DOMAIN) ?></span>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr>
					<td><?php echo $objetivosOuse['error'] ?></td>
				</tr>
			<?php endif; ?>
		</tbody>
	<?php endif; ?>
</table>
