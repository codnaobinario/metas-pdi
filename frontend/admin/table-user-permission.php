<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$users = get_users();
?>
<table class="wp-list-table widefat fixed striped pdi-table">
	<thead>
		<tr>
			<th>Usuário</th>
			<th>Grupo</th>
			<th class="col-remove"></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $user) : ?>
			<?php $user_ator = get_user_meta($user->id, 'pdi_ator') ?>
			<?php if ($user_ator) : ?>
				<?php $ator = pdi_get_atores(['id' => intval($user_ator[0])]) ?>
				<tr>
					<td><?php echo $user->display_name ?></td>
					<td><?php echo $ator[0]->descricao ?></td>
					<td class="remove-premission">
						<a class="delete-permission" title="Remover" data-user-id="<?php echo $user->id ?>">
							<i class="fas fa-trash-alt"></i>
						</a>
					</td>
				</tr>
			<?php endif; ?>
		<?php endforeach; ?>
	</tbody>
</table>