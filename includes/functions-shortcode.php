<?php
defined('ABSPATH') or die('No script kiddies please!');
function add_pdi_front_filters($atts = '')
{
	$grandeTema = pdi_get_grande_tema_all(['active' => 1]);
	$ObjetivosOuse = pdi_get_objetivos_ouse_all(['active' => 1]);
	$ods = pdi_get_ods_all(['active' => 1]);
	$indicadoresAnos = pdi_get_indicadores_anos_all(['active' => 1]);
	$anos = get_anos_de_referencia($indicadoresAnos);
	ob_start();
?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<form action="" id="filters-metas">
					<div class="form-row">
						<div class="form-group col-md-5 form-filter">
							<select name="grande_tema" id="grande-tema" class="form-control">
								<option value="">Grande Tema Estratégico</option>
								<?php if ($grandeTema) : ?>
									<?php foreach ($grandeTema as $gtTema) : ?>
										<option value="<?php echo $gtTema->id ?>">
											<?php echo $gtTema->descricao ?>
										</option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>
							<button type="button" class="btn btn-secondary filter-metas">Filtrar</button>
						</div>
						<div class="form-group col-md-1 form-filter mobile-none"></div>
						<div class="form-group col-md-5 form-filter">
							<select name="objetivo_ouse" id="objetivo-ouse" class="form-control">
								<option value="">Objetivo Ouse</option>
								<?php if ($ObjetivosOuse) : ?>
									<?php foreach ($ObjetivosOuse as $ouse) : ?>
										<option value="<?php echo $ouse->id ?>" title="<?php echo $ouse->descricao ?>">
											<?php echo mb_strimwidth($ouse->descricao, 0, 100, '...') ?>
										</option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>
							<button type="button" class="btn btn-secondary filter-metas">Filtrar</button>
						</div>
						<div class="form-group col-md-5 form-filter">
							<select name="ods" id="ods" class="form-control">
								<option value="">Objetivos de Desenvolvimento Sustentável</option>
								<?php if ($ods) : ?>
									<?php foreach ($ods as $ods_) : ?>
										<option value="<?php echo $ods_->id ?>">
											<?php printf('%s. %s', $ods_->id, $ods_->titulo) ?>
										</option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>
							<button type="button" class="btn btn-secondary filter-metas">Filtrar</button>
						</div>
						<div class="form-group col-md-1 form-filter mobile-none"></div>
						<div class="form-group col-md-5 form-filter">
							<select name="ano_referencia" id="ano_referencia" class="form-control">
								<option value="">Ano de Referência</option>
								<?php if ($anos) : ?>
									<?php foreach ($anos as $ano) : ?>
										<option value="<?php echo $ano ?>">
											<?php echo $ano ?>
										</option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>
							<button type="button" class="btn btn-secondary filter-metas">Filtrar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php
	return ob_get_clean();
}
add_shortcode('pdi_front_filters', 'add_pdi_front_filters');

function add_pdi_front_indicaroes($atts = '')
{
	$indicadores = pdi_get_indicadores_all(['active' => 1]);
	$grandeTema = pdi_get_grande_tema_all(['active' => 1]);
	$ObjetivosOuse = pdi_get_objetivos_ouse_all(['active' => 1]);
	$ods = pdi_get_ods_all(['active' => 1]);
	$indicadoresAnos = pdi_get_indicadores_anos_all(['active' => 1]);
	$anos = get_anos_de_referencia($indicadoresAnos);
	$title_filter = pdi_get_configs(array('meta_key' => 'title_filters'));
	$filter_active = pdi_get_configs(array('meta_key' => 'filter_active'));
	ob_start();

?>
	<?php if ($filter_active[0]->meta_value === '1') : ?>
		<div class="constiner-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="container-image-top">
						<div class="image-top">
							<img src="http://localhost/wordpress/wp-content/uploads/2021/12/logo-1.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid container-white">
			<div class="row">
				<div class="col-md-12">
					<div class="title-filter">
						<?php _e($title_filter[0]->meta_value, PDI_TEXT_DOMAIN) ?>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<form action="" id="filters-metas">
						<div class="form-row">
							<div class="form-group col-md-5 form-filter">
								<select name="grande_tema" id="grande-tema" class="form-control">
									<option value="">Grande Tema Estratégico</option>
									<?php if ($grandeTema) : ?>
										<?php foreach ($grandeTema as $gtTema) : ?>
											<option value="<?php echo $gtTema->id ?>">
												<?php echo $gtTema->descricao ?>
											</option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
								<button type="button" class="btn btn-secondary filter-metas">Filtrar</button>
							</div>
							<div class="form-group col-md-1 form-filter mobile-none"></div>
							<div class="form-group col-md-5 form-filter">
								<select name="objetivo_ouse" id="objetivo-ouse" class="form-control">
									<option value="">Objetivo Ouse</option>
									<?php if ($ObjetivosOuse) : ?>
										<?php foreach ($ObjetivosOuse as $ouse) : ?>
											<option value="<?php echo $ouse->id ?>">
												<?php echo $ouse->descricao ?>
											</option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
								<button type="button" class="btn btn-secondary filter-metas">Filtrar</button>
							</div>
							<div class="form-group col-md-5 form-filter">
								<select name="ods" id="ods" class="form-control">
									<option value="">Objetivos de Desenvolvimento Sustentável</option>
									<?php if ($ods) : ?>
										<?php foreach ($ods as $ods_) : ?>
											<option value="<?php echo $ods_->id ?>">
												<?php printf('%s. %s', $ods_->id, $ods_->titulo) ?>
											</option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
								<button type="button" class="btn btn-secondary filter-metas">Filtrar</button>
							</div>
							<div class="form-group col-md-1 form-filter mobile-none"></div>
							<div class="form-group col-md-5 form-filter">
								<select name="ano_referencia" id="ano_referencia" class="form-control">
									<option value="">Ano de Referência</option>
									<?php if ($anos) : ?>
										<?php foreach ($anos as $ano) : ?>
											<option value="<?php echo $ano ?>">
												<?php echo $ano ?>
											</option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
								<button type="button" class="btn btn-secondary filter-metas">Filtrar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="container-fluid container-white mb-5">
			<div class="row">
				<div class="col-md-12 p-4"></div>
			</div>
		</div>
	<?php endif; ?>
	<div class="container">
		<div class="row load-card-metas">
			<?php pdi_get_template_front('view/card-metas'); ?>
		</div>
	</div>


	<?php
	return ob_get_clean();
}

add_shortcode('pdi_front_indicadores', 'add_pdi_front_indicaroes');

function add_pdi_front_meta_detalhes($atts = '')
{
	ob_start();
	if (isset($_GET['indicador_id'])) :
		$args = [
			'get' => $_GET,
		]
	?>
		<div class="container interna">
			<div class="row">
				<?php pdi_get_template_front('view/meta-detalhes', $_GET); ?>
			</div>
		</div>
	<?php
	endif;
	return ob_get_clean();
}
add_shortcode('pdi_front_meta_detalhes', 'add_pdi_front_meta_detalhes');

function add_pdi_teste()
{
	$indicador = pdi_get_indicadores(['id' => 1]);
	$grande_tema = pdi_get_grande_tema(['id' => $indicador[0]->grande_tema_id]);
	$color = json_decode($grande_tema[0]->layout);
	ob_start();
	?>
	<style>
		.btn-ir {
			background-color: <?php echo $color[1] ?>;
			color: #fff;
			padding: 10px 50px;
			border-radius: 5px;
			border: 1px solid <?php echo $color[1] ?>;
			font-weight: 600;
			transition: .3s;
		}

		.btn-ir:hover {
			color: <?php echo $color[1] ?>;
			background-color: #fff;
			text-decoration: none
		}
	</style>
	<table style="border:0px; width: 100%;">
		<tbody>
			<tr style="text-align: center; background-color: #215A36;">
				<td>
					<img src="<?php echo PDI_IMAGES . '/Unifesp-marca.png' ?>" alt="" width="110">
				</td>
			</tr>
			<tr>
				<td style="border: none;">
					<table style="border:0px; width: 100%;">
						<tbody>
							<tr>
								<td style="border: none; text-align: center; padding: 20px 0;">
									<img src="<?php echo PDI_IMAGES . '/logo-pdi.png' ?>" alt="" width="250px">
								</td>
							</tr>
							<tr>
								<td style="border: none; text-align: center; color: <?php echo $color[1] ?>; font-size: 1.5rem; font-weight: 600;">A Meta <?php echo $indicador[0]->id ?> foi atualizada!</td>
							</tr>
							<tr style="text-align: center;">
								<td style="border: none;">
									Click no botão abaixo, ou <a href="<?php echo site_url() . '/detalhes-meta/?indicador_id=' . $indicador[0]->id ?>">aqui</a> para visualizar as atualizações
								</td>
							</tr>
							<tr style="text-align: center;">
								<td style="border: none; padding: 40px 0;">
									<a class="btn-ir" style="background-color: <?php echo $color[1] ?>; color: #fff; padding: 10px 50px; border-radius: 5px; border: 1px solid <?php echo $color[1] ?>; font-weight: 600; transition: .3s;" href="<?php echo site_url() . '/detalhes-meta/?indicador_id=' . $indicador[0]->id ?>">Visualizar META <?php echo $indicador[0]->id ?></a>
								</td>
							</tr>
							<tr>
								<td style="border: none; font-size: 10px;">
									<p>Para revover a sua inscrição nesta meta <a href="#">click aqui</a>, ou acesse <a href="https://www.ouvidoria.unifesp.br">https://www.ouvidoria.unifesp.br</a>.</p>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr style="text-align: right; background-color: #215A36; height: 50px; color: #fff; font-size: 12px">
				<td>
					<table style="border: 0; width: 100%;">
						<tbody>
							<tr>
								<td style="border: none; text-align: left; background-color: #215A36; height: 50px; color: #fff; font-size: 12px">
									Rua Sena Madureira, n.º 1.500
									<br>
									Vila Clementino - São Paulo - SP - CEP: 04021-001
								</td>
								<td style="border: none; text-align: right; " class="unifesp-icons">
									<a style="color: #fff; padding: 5px; vertical-align: text-top; text-decoration: none;" href="https://www.facebook.com/Unifespoficial/" target="_blank" rel="noopener noreferrer" title="Facebook Unifesp" aria-label="Facebook Unifesp">
										<img style="height: 20px;" src="<?php echo PDI_IMAGES . '/social/facebook-f-brands.png' ?>" alt="">
									</a>
									<a style="color: #fff; padding: 5px; vertical-align: text-top; text-decoration: none;" href="https://twitter.com/unifesp" target="_blank" rel="noopener noreferrer" title="Twitter Oficial" aria-label="Twitter Oficial">
										<img style="height: 20px;" src="<?php echo PDI_IMAGES . '/social/twitter-brands.png' ?>" alt="">
									</a>
									<a style="color: #fff; padding: 5px; vertical-align: text-top; text-decoration: none;" href="https://www.instagram.com/unifespoficial/" target="_blank" rel="noopener noreferrer" title="Instagram Unifesp" aria-label="Instagram Unifesp">
										<img style="height: 20px;" src="<?php echo PDI_IMAGES . '/social/instagram-brands.png' ?>" alt="">
									</a>
									<a style="color: #fff; padding: 5px; vertical-align: text-top; text-decoration: none;" href="https://www.youtube.com/channel/UCFVLZWcWoAHJVfc6CsXzqbw" target="_blank" rel="noopener noreferrer" title="Youtube Unifesp" aria-label="Youtube Unifesp">
										<img style="height: 20px;" src="<?php echo PDI_IMAGES . '/social/youtube-brands.png' ?>" alt="">
									</a>
									<a style="color: #fff; padding: 5px; vertical-align: text-top; text-decoration: none;" href="https://pt.linkedin.com/school/unifesp/" target="_blank" rel="noopener noreferrer" title="Linkedin Unifesp" aria-label="Linkedin Unifesp">
										<img style="height: 20px;" src="<?php echo PDI_IMAGES . '/social/linkedin-in-brands.png' ?>" alt="">
									</a>
									<a style="color: #fff; padding: 5px; vertical-align: text-top; text-decoration: none;" href="https://medium.com/@unifesp" target="_blank" rel="noopener noreferrer" title="Medium Unifesp" aria-label="Medium Unifesp">
										<img style="height: 20px;" src="<?php echo PDI_IMAGES . '/social/medium-m-brands.png' ?>" alt="">
									</a>
									<a style="color: #fff; padding: 5px; vertical-align: text-top; text-decoration: none;" href="https://www.flickr.com/photos/158442049@N04/albums" target="_blank" rel="noopener noreferrer" title="Flickr Unifesp" aria-label="Flickr Unifesp">
										<img style="height: 20px;" src="<?php echo PDI_IMAGES . '/social/flickr-brands.png' ?>" alt="">
										</svg>
									</a>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
<?php
	return ob_get_clean();
}
add_shortcode('pdi_teste', 'add_pdi_teste');
