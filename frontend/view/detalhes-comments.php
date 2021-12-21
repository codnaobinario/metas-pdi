<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
global $current_user;
$indicador = $variaveis;

?>
<div class="pdi-comments">
	<div class="row">
		<?php if (intval($current_user->user_level) >= 2) : ?>
			<div class="col-md-12">
				<form action="" id="form-comments">
					<div class="form-row">
						<input type="hidden" name="indicador_id" value="<?php echo $indicador['indicador']->id ?>">
						<div class="form-group col-md-12">
							<label for="">Comente</label>
							<textarea name="text_comment" id="text-comment" rows="5" class="form-control"></textarea>
						</div>
						<div class="form-group col-md-12 button-comments">
							<button type="button" class="btn btn-primary add-comments">Enviar</button>
						</div>
					</div>
				</form>
			</div>
		<?php endif; ?>
		<div class="col-md-12 comments-previews">
			<?php pdi_get_template_front('view/comments-preview', ['indicador_id' => $indicador->id]) ?>
		</div>
	</div>
</div>