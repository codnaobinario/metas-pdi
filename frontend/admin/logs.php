<?php
defined('ABSPATH') or die('No script kiddies please!');

if ($variaveis) {
	$logId = $variaveis;
	$logs = pdi_get_logs_all();
} else {
	$logs = pdi_get_logs_all();
}

$users = get_users();

global $current_user;
if (in_array('pdi_nivel_2', $current_user->roles) || in_array('pdi_nivel_3', $current_user->roles) || in_array('pdi_nivel_4', $current_user->roles)) :
	pdi_get_template_front('admin/no-permission');
else :
?>

	<div class="container-fluid pdi-container">
		<div class="pdi-plugin-title">
			<span class="dashicons dashicons-analytics"></span>
			<?php _e('Logs Auditoria', PDI_TEXT_DOMAIN) ?>
		</div>
		<?php if ($_GET['edit']) : ?>
			<?php $log = pdi_get_logs(array('id' => intval($_GET['edit']))) ?>
			<?php $log = $log[0] ? $log[0] : $log ?>
			<div class="container-fluid pdi-container">
				<form action="" class="form-edit-pdi">
					<div class="form-row row">
						<div class="col-md-3 col-label">
							<?php _e('ID', PDI_TEXT_DOMAIN) ?>
						</div>
						<div class="form-group col-md-9">
							<input type="text" name="id" id="id" class="form-control w-100px" value="<?php echo $log->id ?>" readonly />
						</div>
						<div class="col-md-3 col-label">
							<?php _e('Data', PDI_TEXT_DOMAIN) ?>
						</div>
						<div class="form-group col-md-9">
							<input type="datetime" name="date" id="date" class="form-control" value="<?php echo date('d/m/Y H:i:s', strtotime($log->created_at)) ?>" readonly />
						</div>
						<div class="col-md-3 col-label">
							<?php _e('Usuário', PDI_TEXT_DOMAIN) ?>
						</div>
						<div class="form-group col-md-9">
							<?php $user = get_user_by('ID', $log->user_id) ?>
							<?php $userName = $user->display_name ? $user->display_name : $user->user_email ?>
							<input type="text" name="user_id" id="user_id" class="form-control" value="<?php echo $userName ?>" readonly />
						</div>
						<div class="col-md-3 col-label">
							<?php _e('Descrição', PDI_TEXT_DOMAIN) ?>
						</div>
						<div class="form-group col-md-9">
							<textarea type="text" name="log" id="log" class="form-control" readonly><?php echo $log->log ?></textarea>
						</div>
						<div class="col-md-3 col-label">
							<?php _e('Logs', PDI_TEXT_DOMAIN) ?>
						</div>
						<div class="form-group col-md-9">
							<?php $infos = is_serialized($log->infos) ? maybe_unserialize($log->infos) : $log->infos ?>
							<textarea type="text" name="infos" id="infos" rows="10" class="form-control" readonly><?php print_r($infos) ?></textarea>
						</div>
					</div>
					<div class="clear-line"></div>
					<div class="col-md-12">
						<p class="btn-actions">
							<button type="button" class="button button-primary <?php echo $_GET['edit'] !== 'new' ? 'btn-edit-grande-tema' : 'btn-save-grande-tema'  ?>" data-gt-id="<?php echo $gt[0]->id ?>">
								<?php _e('Salvar', PDI_TEXT_DOMAIN) ?>
							</button>
						</p>
					</div>
				</form>
			</div>
		<?php else : ?>
			<div class="row">
				<div class="col-md-6 mt-4">
					<label for="search-logs">
						<?php _e('Perquisar logs:', PDI_TEXT_DOMAIN) ?>
					</label>
					<input type="text" id="search-logs" class="search-logs">
					<button type="button" class="button button-primary btn-search-logs">
						<?php _e('Buscar', PDI_TEXT_DOMAIN) ?>
					</button>
				</div>
				<div class="col=md-6 mt-4 search-user">
					<label for="search-user">
						<?php _e('Perquisar por usuário:', PDI_TEXT_DOMAIN) ?>
					</label>
					<select id="search-user">
						<option value="">
							<?php _e('Selecione...', PDI_TEXT_DOMAIN) ?>
						</option>
						<?php foreach ($users as $user) : ?>
							<option value="<?php echo $user->ID ?>">
								<?php $userName = $user->display_name ? $user->display_name : $user->user_email ?>
								<?php echo $userName ?>
							</option>
						<?php endforeach; ?>
					</select>
					<button type="button" class="button button-primary btn-search-logs-user">
						<?php _e('Buscar', PDI_TEXT_DOMAIN) ?>
					</button>
				</div>
			</div>
			<div class="load-table" id="load-table-logs">
				<?php pdi_get_template_front('admin/table-logs') ?>
			</div>
		<?php endif; ?>

	</div>
<?php endif; ?>
