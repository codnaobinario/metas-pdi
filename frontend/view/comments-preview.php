<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
global $current_user;
$view_comments = 5;
$page = 1;

if(isset($_GET['page'])) $page = $_GET['page'];
if($variaveis['page']) $page = $variaveis['page'];

if(isset($_GET['indicador_id'])) $indicador_id = $_GET['indicador_id'];
if($variaveis['indicador_id'] && $variaveis != null) $indicador_id = $variaveis['indicador_id'];

$count_comments = pdi_count_comments_all(['indicador_id' => intval($indicador_id), 'active' => 1, 'comment_parent'  => intval(0)]);
$pagnation = ceil(intval($count_comments) / $view_comments);

$comments = pdi_get_comments_all(['indicador_id' => intval($indicador_id), 'active' => 1, 'comment_parent'  => intval(0)], $view_comments, $page);

if ($comments) {
	$comments_ = classificar_comentarios($comments);
}
?>
<?php if ($comments) : ?>
	<label for=""><?php echo (count($comments) > 0) ? count($comments) : 0 ?> comentário<?php echo (count($comments) > 1) ? 's' : '' ?></label>
	<div class="indicador-comments">
		<?php foreach ($comments_ as $comment) : ?>
			<div class="comment">
				<div class="comment-img">
					<div class="view-image">
						<img src="<?php echo PDI_PLUGIN_URL . 'assets/images/usuario-default.jpg' ?>" alt="">
					</div>
				</div>
				<div class="comment-content">
					<div class="comment-name">
						<?php echo $comment->name ?>
					</div>
					<div class="comment-text">
						<?php echo $comment->comment ?>
					</div>
					<div class="comment-actions">
						<div class="comment-date">
							<?php echo date('d/m/Y H:i', strtotime($comment->created_at)) ?>
						</div>
						<div class="comment-reply">
							<span class="reply_comment" data-comment-id="<?php echo $comment->id ?>" data-indicador_id="<?php echo $indicador_id ?>">
								Responder
							</span>
						</div>
						<?php if ($current_user->id == $comment->user_id || $current_user->user_level == 10) : ?>
							<div class="comment-delete">
								<span class="delete-comment" data-comment-id="<?php echo $comment->id ?>" data-indicador_id="<?php echo $indicador_id ?>" data-reply="false">
									Excluir
								</span>
							</div>
						<?php endif; ?>
					</div>
					<div class="comment-reply-form" data-preview-reply="false" style="display: none;"></div>
				</div>
			</div>
			<?php if ($comment->respostas) : ?>
				<?php foreach ($comment->respostas as $comment_r) : ?>
					<div class="comment comment-sub">
						<div class="comment-img">
							<div class="view-image">
								<img src="<?php echo PDI_PLUGIN_URL . 'assets/images/usuario-default.jpg' ?>" alt="">
							</div>
						</div>
						<div class="comment-content">
							<div class="comment-name">
								<?php echo $comment_r->name ?>
							</div>
							<div class="comment-text">
								<?php echo $comment_r->comment ?>
							</div>
							<div class="comment-actions">
								<div class="comment-date">
									<?php echo date('d/m/Y H:i', strtotime($comment_r->created_at)) ?>
								</div>
								<?php if ($current_user->id == $comment_r->user_id || $current_user->user_level == 10) : ?>
									<div class="comment-delete">
										<span class="delete-comment" data-comment-id="<?php echo $comment_r->id ?>" data-indicador_id="<?php echo $indicador_id ?>" data-reply="true">
											Excluir
										</span>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		<?php endforeach; ?>
		<div class="pdi-pagination pagination-front">
			<button type="button" class="btn pdi-pagination-prev" data-page="<?php echo $page - 1 ?>" data-indicador="<?php echo $indicador_id ?>" <?php echo ($page <= 1) ? 'disabled' : '' ?>>Anterior</button>
			<?php for ($i = 0; $i < $pagnation; $i++) : ?>
				<button type="button" class="btn pdi-pagination-btn <?php echo ($i + 1 == $page) ? 'active' : '' ?>" data-page="<?php echo $i + 1 ?>" data-indicador="<?php echo $indicador_id ?>" <?php echo ($i + 1 == $page) ? 'disabled' : '' ?>>
					<?php echo $i + 1 ?>
				</button>
			<?php endfor; ?>
			<button type="button" class="btn pdi-pagination-next" data-page="<?php echo $page + 1 ?>" data-indicador="<?php echo $page + 1 ?>" <?php echo ($page >= $pagnation) ? 'disabled' : '' ?>>Próximo</button>
		</div>
	</div>
<?php else : ?>
	<div class="indicador-comments">
		<label for="">0 Comentário</label>
		<div class="no-comments">Nenhum comentário</div>
	</div>
<?php endif; ?>