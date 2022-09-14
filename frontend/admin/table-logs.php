<?php
defined('ABSPATH') or die('No script kiddies please!');

if ($variaveis) {
	$logs = pdi_get_logs_all_query($variaveis);
} else {
	$logs = pdi_get_logs_all();
}


?>
<table class="wp-list-table widefat fixed striped pdi-table" id="table-logs">
	<?php if (!$logs) : ?>
		<tbody>
			<tr>
				<td><?php _e('Nenhum registro escontrado', PDI_TEXT_DOMAIN) ?></td>
			</tr>
		</tbody>
	<?php else : ?>
		<thead>
			<tr>
				<th class="id">#</th>
				<th class="log">Log</th>
				<th class="user">Usuário</th>
				<th class="date">Data</th>
				<th class="actions"></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($logs as $log) : ?>
				<?php $user = get_user_by('ID', $log->user_id); ?>
				<?php $userName = $user->display_name ? $user->display_name : $user->user_email ?>
				<tr>
					<td class="id">
						<a href="?page=pdi-logs&edit=<?php echo $log->id ?>">
							<?php echo $log->id ?>
						</a>
					</td>
					<td data-ator-id="<?php echo $log->id ?>">
						<a href="?page=pdi-logs&edit=<?php echo $log->id ?>">
							<?php echo $log->log ?>
						</a>
					</td>
					<td>
						<?php print_r($userName) ?>
					</td>
					<td>
						<?php echo date('d/m/Y H:i:s', strtotime($log->created_at)) ?>
					</td>
					<td class="td-remove">
						<a href="?page=pdi-logs&edit=<?php echo $log->id ?>" title="Visualizar" class="button btn-preview btn-preview-log" data-ator-id="<?php echo $log->id ?>">
							<i class="far fa-eye"></i>
							<span><?php _e('Visualizar', PDI_TEXT_DOMAIN) ?></span>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	<?php endif; ?>
</table>
