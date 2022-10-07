<?php
defined('ABSPATH') or die('No script kiddies please!');
$eixos = pdi_get_eixo_all();
?>

<table class="wp-list-table widefat fixed striped pdi-table">
	<?php if (!$eixos) : ?>
		<tbody>
			<tr>
				<td><?php _e('Nenhum registro escontrado', PDI_TEXT_DOMAIN) ?></td>
			</tr>
		</tbody>
	<?php else : ?>
		<tbody>
			<?php if (!$eixos['error']) : ?>
				<?php foreach ($eixos as $eixo) : ?>
					<tr>
						<td data-ouse-id="<?php echo $eixo->id ?>">
							<a href="?page=pdi-eixos&edit=<?php echo $eixo->id ?>">
								<?php echo $eixo->descricao ?>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr>
					<td><?php echo $eixos['error'] ?></td>
				</tr>
			<?php endif; ?>
		</tbody>
	<?php endif; ?>
</table>
