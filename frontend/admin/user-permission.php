<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
global $current_user;
$users = get_users();
$autores = pdi_get_atores_all(['active' => 1]);

if (in_array('pdi_nivel_1', $current_user->roles) || in_array('pdi_nivel_2', $current_user->roles)) :
	pdi_get_template_front('admin/no-permission');
else :
?>
	<div class="container-fluid pdi-container">
		<div class="pdi-plugin-title">
			<span class="dashicons dashicons-analytics"></span>
			PDI / Permissões de Usuários
		</div>
		<div class="row">
			<div class="card col-md-5 mr-5">
				<form action="" id="pdi-users-premission">
					<div class="form-row">
						<div class="form-groud col-md-12">
							<label for="user">Usuário</label>
							<select name="user" id="user" class="form-control">
								<option value="">
									Selecione o Usuário...
								</option>
								<?php foreach ($users as $user) : ?>
									<option value="<?php echo $user->id ?>">
										<?php echo $user->display_name ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-groud col-md-12">
							<label for="user-group">Grupo</label>
							<select name="user_group" id="user-group" class="form-control">
								<option value="">Selecione o Grupo...</option>
								<?php foreach ($autores as $autor) : ?>
									<option value="<?php echo $autor->id ?>">
										<?php echo $autor->descricao ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-groud col-md-12 text-right">
							<button type="button" class="button button-primary add-user-permission">Adicionar</button>
						</div>
				</form>
			</div>
		</div>
		<div class="col-md-6">
			<div class="pdi-box-premmission">
				<?php pdi_get_template_front('admin/table-user-permission') ?>
			</div>
		</div>
	</div>
	</div>
<?php endif; ?>