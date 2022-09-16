<?php
defined('ABSPATH') or die('No script kiddies please!');

function pdi_get_logs_all(array $filter = array())
{
	return PDI_DB::get_table(TABLE_LOGS, $filter);
}

function pdi_get_logs_all_query(string $query)
{
	return PDI_DB::get_option_query(TABLE_LOGS, $query);
}

function pdi_get_logs(array $args)
{
	return PDI_DB::get_option(TABLE_LOGS, $args);
}

function pdi_set_logs(array $args, array $format = null)
{
	return PDI_DB::set_option(TABLE_LOGS, $args, $format);
}

function pdi_insert_logs(string $log, string $status, $infos)
{
	if (!$log) return false;
	if (!$status) return false;

	if (is_array($infos) || is_object($infos)) {
		if (!is_serialized($infos)) {
			$infos = maybe_serialize($infos);
		}
	}

	$args = array(
		'log'						=> $log,
		'status'				=> $status,
		'infos'					=> $infos,
		'user_id'				=> get_current_user_id(),
		'created_at'		=> date('Y-m-d H:i:s'),
	);

	$format = array(
		'%s',
		'%s',
		'%s',
		'%d',
		'%s',
	);

	return pdi_set_logs($args, $format);
}

function pdi_get_configs_all(array $filter = array())
{
	return PDI_DB::get_table(TABLE_CONFIGS, $filter);
}

function pdi_get_configs(array $args)
{
	return PDI_DB::get_option(TABLE_CONFIGS, $args);
}

function pdi_set_configs(array $args, array $format = null)
{
	return PDI_DB::set_option(TABLE_CONFIGS, $args, $format);
}

function pdi_update_configs(array $args, array $where = null, array $format = null, array $where_format = null)
{
	return PDI_DB::update_option(TABLE_CONFIGS, $args, $where, $format, $where_format);
}

function pdi_get_ods_all(array $filter = array())
{
	return PDI_DB::get_table(TABLE_ODS, $filter);
}

function pdi_get_ods(array $args)
{
	return PDI_DB::get_option(TABLE_ODS, $args);
}

function pdi_set_ods(array $args, array $format = null)
{
	return PDI_DB::set_option(TABLE_ODS, $args, $format);
}

function pdi_update_ods(array $args, array $where, array $format = null, array $where_format = null)
{
	return PDI_DB::update_option(TABLE_ODS, $args, $where, $format, $where_format);
}

function pdi_get_pne_all(array $filter = array())
{
	return PDI_DB::get_table(TABLE_PNE, $filter);
}

function pdi_get_pne(array $args)
{
	return PDI_DB::get_option(TABLE_PNE, $args);
}

function pdi_set_pne(array $args, array $format = null)
{
	return PDI_DB::set_option(TABLE_PNE, $args, $format);
}

function pdi_update_pne(array $args, array $where, array $format = null, array $where_format = null)
{
	return PDI_DB::update_option(TABLE_PNE, $args, $where, $format, $where_format);
}

function pdi_get_objetivos_ouse_all(array $filter = array(), int $per_page = null,  int $page = 1,  string $order = 'descricao',  string $orderby = 'ASC', string $query_string = null)
{
	return PDI_DB::get_table(TABLE_OBJETIVOS_OUSE, $filter, $per_page, $page, $order, $orderby, $query_string);
}

function pdi_get_objetivos_ouse(array $args)
{
	return PDI_DB::get_option(TABLE_OBJETIVOS_OUSE, $args);
}

function pdi_set_objetivos_ouse(array $args, array $format = null)
{
	return PDI_DB::set_option(TABLE_OBJETIVOS_OUSE, $args, $format);
}

function pdi_update_objetivos_ouse(array $args, array $where, array $format = null, array $where_format = null)
{
	return PDI_DB::update_option(TABLE_OBJETIVOS_OUSE, $args, $where, $format, $where_format);
}

function pdi_delete_objetivos_ouse(array $args, array $format = null)
{
	return PDI_DB::delete_option(TABLE_OBJETIVOS_OUSE, $args, $format);
}

function pdi_get_indicadores_all(array $filter = array(), int $per_page = null, int $page = 1, string $order = null, string $orderby = 'ASC', string $query_string = null)
{
	return PDI_DB::get_table(TABLE_INDICADORES, $filter, $per_page, $page, $order, $orderby, $query_string);
}

function pdi_count_indicadores_all(array $filter = array())
{
	return PDI_DB::count_table(TABLE_INDICADORES, $filter);
}

function pdi_get_indicadores(array $args)
{
	return PDI_DB::get_option(TABLE_INDICADORES, $args);
}

function pdi_set_indicadores(array $args, array $format = null)
{
	return PDI_DB::set_option(TABLE_INDICADORES, $args, $format);
}

function pdi_update_indicadores(array $args, array $where, array $format = null, array $where_format = null)
{
	return PDI_DB::update_option(TABLE_INDICADORES, $args, $where, $format, $where_format);
}

function pdi_delete_indicadores(array $args, array $format = null)
{
	return PDI_DB::delete_option(TABLE_INDICADORES, $args, $format);
}

function pdi_get_indicadores_anos_all(array $filter = array())
{
	return PDI_DB::get_table(TABLE_INDICADORES_ANOS, $filter);
}

function pdi_get_indicadores_anos(array $args)
{
	return PDI_DB::get_option(TABLE_INDICADORES_ANOS, $args);
}

function pdi_set_indicadores_anos(array $args, array $format = null)
{
	return PDI_DB::set_option(TABLE_INDICADORES_ANOS, $args, $format);
}

function pdi_update_indicadores_anos(array $args, array $where, array $format = null, array $where_format = null)
{
	return PDI_DB::update_option(TABLE_INDICADORES_ANOS, $args, $where, $format, $where_format);
}

function pdi_delete_indicadores_anos(array $args, array $format = null)
{
	return PDI_DB::delete_option(TABLE_INDICADORES_ANOS, $args, $format);
}

function pdi_get_grande_tema_all(array $filter = array(), int $per_page = null,  int $page = 1,  string $order = 'descricao',  string $orderby = 'ASC', string $query_string = null)
{
	return PDI_DB::get_table(TABLE_GRANDE_TEMA, $filter, $per_page, $page, $order, $orderby, $query_string);
}

function pdi_get_grande_tema(array $args)
{
	return PDI_DB::get_option(TABLE_GRANDE_TEMA, $args);
}

function pdi_set_grande_tema(array $args, array $format = null)
{
	return PDI_DB::set_option(TABLE_GRANDE_TEMA, $args, $format);
}

function pdi_update_grande_tema(array $args, array $where, array $format = null, array $where_format = null)
{
	return PDI_DB::update_option(TABLE_GRANDE_TEMA, $args, $where, $format, $where_format);
}

function pdi_delete_grande_tema(array $args, array $format = null)
{
	return PDI_DB::delete_option(TABLE_GRANDE_TEMA, $args, $format);
}

function pdi_get_eixo_all(array $filter = array())
{
	return PDI_DB::get_table(TABLE_EIXO, $filter);
}

function pdi_get_eixo(array $args)
{
	return PDI_DB::get_option(TABLE_EIXO, $args);
}

function pdi_set_eixo(array $args, array $format = null)
{
	return PDI_DB::set_option(TABLE_EIXO, $args, $format);
}

function pdi_update_eixo(array $args, array $where, array $format = null, array $where_format = null)
{
	return PDI_DB::update_option(TABLE_EIXO, $args, $where, $format, $where_format);
}

function pdi_get_acoes_all(array $filter = array(), int $per_page = null, int $page = 1, string $order = null, string $orderby = 'ASC')
{
	return PDI_DB::get_table(TABLE_ACOES, $filter, $per_page, $page, $order, $orderby);
}

function pdi_get_acoes(array $args)
{
	return PDI_DB::get_option(TABLE_ACOES, $args);
}

function pdi_set_acoes(array $args, array $format = null)
{
	return PDI_DB::set_option(TABLE_ACOES, $args, $format);
}

function pdi_update_acoes(array $args, array $where, array $format = null, array $where_format = null)
{
	return PDI_DB::update_option(TABLE_ACOES, $args, $where, $format, $where_format);
}

function pdi_delete_acoes(array $args, array $format = null)
{
	return PDI_DB::delete_option(TABLE_ACOES, $args, $format);
}

function pdi_get_atores_all(array $filter = array())
{
	return PDI_DB::get_table(TABLE_ATORES, $filter);
}

function pdi_get_atores(array $args)
{
	return PDI_DB::get_option(TABLE_ATORES, $args);
}

function pdi_set_atores(array $args, array $format = null)
{
	return PDI_DB::set_option(TABLE_ATORES, $args, $format);
}

function pdi_update_atores(array $args, array $where, array $format = null, array $where_format = null)
{
	return PDI_DB::update_option(TABLE_ATORES, $args, $where, $format, $where_format);
}

function pdi_delete_atores(array $args, array $format = null)
{
	return PDI_DB::delete_option(TABLE_ATORES, $args, $format);
}

function pdi_get_objetivo_especifico_all(array $filter = array())
{
	return PDI_DB::get_table(TABLE_OBJETIVO_ESPECIFICO, $filter);
}

function pdi_get_objetivo_especifico(array $args)
{
	return PDI_DB::get_option(TABLE_OBJETIVO_ESPECIFICO, $args);
}

function pdi_set_objetivo_especifico(array $args, array $format = null)
{
	return PDI_DB::set_option(TABLE_OBJETIVO_ESPECIFICO, $args, $format);
}

function pdi_update_objetivo_especifico(array $args, array $where, array $format = null, array $where_format = null)
{
	return PDI_DB::update_option(TABLE_OBJETIVO_ESPECIFICO, $args, $where, $format, $where_format);
}

function pdi_set_notification(array $args, array $format = null)
{
	return PDI_DB::set_option(TABLE_NOTIFICATION, $args, $format);
}

function pdi_get_comments_all(array $filter = array(), int $per_page = null, int $page = 1, string $order = null, string $orderby = 'ASC')
{
	return PDI_DB::get_table(TABLE_COMMENTS, $filter, $per_page, $page, $order, $orderby);
}

function pdi_count_comments_all(array $filter = array())
{
	return PDI_DB::count_table(TABLE_COMMENTS, $filter);
}

function pdi_get_comments(array $args)
{
	return PDI_DB::get_option(TABLE_COMMENTS, $args);
}

function pdi_set_comments(array $args, array $format = null)
{
	return PDI_DB::set_option(TABLE_COMMENTS, $args, $format);
}

function pdi_get_notification_all(array $filter = array(), int $per_page = null, int $page = 1, string $order = null, string $orderby = 'ASC')
{
	return PDI_DB::get_table(TABLE_NOTIFICATION, $filter, $per_page, $page, $order, $orderby);
}

/**
 * Insere templates contidos dentro da pasta /frontend
 * @param string $path (Caminho do arquivo dentro da pasta sem a extencao do arquivo)
 * @param object $variaveis (Variáveis enviadas para template)
 * @return string Estrutura do front para exibição 
 */
function pdi_get_template_front(string $path, $variaveis = null)
{

	if (file_exists(PDI_FRONT . $path . '.php')) {
		$variaveis = $variaveis;
		include PDI_FRONT . $path . '.php';
	}
}

function convert_data_db($data)
{
	$data = explode('/', $data);
	return $data[2] . '-' . $data[1] . '-' . $data[0];
}

function convert_data_front($data)
{
	$data = explode('-', $data);
	return $data[2] . '/' . $data[1] . '/' . $data[0];
}

function format_real($number, $decimal = 2)
{
	return number_format($number, $decimal, ',', '.');
}

function get_anos_de_referencia($indicadores_anos)
{
	$anos = [];
	foreach ($indicadores_anos as $indicador_anos) {
		$anos[] = $indicador_anos->ano;
	}
	$anos = array_unique($anos, SORT_STRING);
	rsort($anos);
	return $anos;
}

function gerar_array_js_anos($indicadores_anos)
{
	foreach ($indicadores_anos as $indicador_anos) {
		$anos[] = $indicador_anos->ano;
	}
	$anos_ = array_unique($anos, SORT_STRING);
	sort($anos_);
	$r = '[';
	foreach ($anos_ as $a) {
		$r .= $a . ', ';
	}
	$r = rtrim($r, ', ');
	$r .= ']';

	return $r;
}

function gerar_array_js_valores($indicadores_anos)
{
	foreach ($indicadores_anos as $indicador_anos) {
		$anos[] = $indicador_anos->valor;
	}
	$anos_ = array_unique($anos, SORT_STRING);
	sort($anos_);
	$r = '[';
	foreach ($anos_ as $a) {
		$r .= $a . ', ';
	}
	$r = rtrim($r, ', ');
	$r .= ']';

	return $r;
}

function return_maior($array)
{
	$r = 0;
	foreach ($array as $a) {
		if (intval($a) > $r) {
			$r = $a;
		}
	}
	return $r;
}

function colors_card()
{
	return [
		// Vermelho
		["#C4806E", "#A44B3A"],
		// Amarelo
		["#D4D284", "#C9C12C"],
		// Verde
		["#5D856E", "#215A36"],
		// Azul
		["#70809F", "#2E668C"],
		// Cinza
		["#768A88", "#5F726A"],
	];
}

function filtrar_acoes_por_ano($acoes)
{
	$ac = [];
	foreach ($acoes as $acao) {
		$ac[$acao->indicador_id][$acao->ano_acao][] = $acao;
	}
	return $ac;
}

function filtrar_metas_por_ano($metas)
{
	$m = [];
	foreach ($metas as $meta) {
		$m[$meta->ano] = $meta;
	}
	return $m;
}

function calc_valores_acoes($dados)
{
	$ac = [];
	$acoes = [];
	foreach ($dados as $indicador_id => $dado) {
		foreach ($dado as $key => $value) {
			$ac[$key]['total_acoes'] = count($value);
			$ac[$key]['media_percentual_cumprido'] = calcular_porcentagem_acoes_concluidas($value);
		}
		krsort($ac);
		$acoes[$indicador_id] = $ac;
	}

	return $acoes;
}

function calc_porcent_meta($vlrInicial, $vlrAtual)
{

	$vlr1 = ($vlrInicial / 100);
	if ($vlr1 > 0) {
		$calc = $vlrAtual / $vlr1;
		return number_format($calc, 1);
	} else {
		return 0;
	}
}

function calc_valores_indicares_linha($valorInicial, $valorFinal, $valorAtual)
{
	$vlr1 = $valorFinal;
	$vlr2 = $vlr1 / 100;
	$vlr3 = $valorAtual / $vlr2;
	return number_format($vlr3 / 100, 2);
}

function calcular_porcentagem_acoes_concluidas($acoes)
{
	$valor = 0.00;
	$i = 0;
	foreach ($acoes as $acao) {
		$valor = $valor + floatval($acao->percentual_cumprido);
		$i++;
	}

	return number_format($valor / $i, 0);
}

function classificar_acoes_por_eixo($acoes)
{
	$a = [];
	foreach ($acoes as $acao) {
		$a[$acao->eixo_id][] = $acao;
	}
	ksort($a);
	return $a;
}

function classificar_por_objetivo_especifico($acoes)
{
	$a = [];
	foreach ($acoes as $key => $value) {
		foreach ($value as $v) {
			$ob = json_decode($v->objetivo_especifico);
			if ($ob) {
				foreach ($ob as $obj) {
					$a[$key][$obj][] = $v;
				}
			} else {
				$a[$key][0][] = $v;
			}
		}
	}
	return $a;
}

function classificar_comentarios($comments)
{
	$r = [];
	foreach ($comments as $comment) {
		$r[$comment->id] = $comment;
	}

	foreach ($r as $k => $v) {
		$parent = pdi_get_comments_all(['indicador_id' => intval($v->indicador_id), 'active' => 1, 'comment_parent'  => intval($k)]);
		$r[$k]->respostas = $parent;
	}

	krsort($r);
	return $r;
}

function convert_real_float($valor)
{
	return  str_replace(',', '.', str_replace('.', '', $valor));
}

function gerarSlug($str)
{
	$str = mb_strtolower($str); //Vai converter todas as letras maiúsculas pra minúsculas
	$str = preg_replace('/(â|á|ã)/', 'a', $str);
	$str = preg_replace('/(ê|é)/', 'e', $str);
	$str = preg_replace('/(í|Í)/', 'i', $str);
	$str = preg_replace('/(ú)/', 'u', $str);
	$str = preg_replace('/(ó|ô|õ|Ô)/', 'o', $str);
	$str = preg_replace('/(_|\/|!|\?|#)/', '', $str);
	$str = preg_replace('/( )/', '-', $str);
	$str = preg_replace('/ç/', 'c', $str);
	$str = preg_replace('/(-[-]{1,})/', '-', $str);
	$str = preg_replace('/(,)/', '-', $str);
	$str = strtolower($str);
	return $str;
	/*Significa que vai procurar por  qualquer um desses â|á|ã ou as outras 
	letras e, i, o, u e caracteres especiais e vai trocar pela letra normal ou pelo -*/
}

function pdi_update_metas_email($indicador_id)
{
	$indicador = pdi_get_indicadores(['id' => intval($indicador_id)]);
	$notifications = pdi_get_notification_all(['indicador_id' => intval($indicador_id)]);
	$subject  = "Unifesp || Atualização Meta " . $indicador[0]->id;
	$headers[] = 'Content-Type: text/html; charset=UTF-8';
	$headers[] = 'From: PDI Unifesp <' . EMAIL_PDI . '>';

	$sends = [];

	foreach ($notifications as $notification) {
		$message = msg_email_update_metas($indicador, $notification);
		$sends[] = wp_mail($notification->email, $subject, $message, $headers);
	}

	return $sends;
}

function msg_email_update_metas($indicador, $notification)
{
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

		.unifesp-icons>a {
			color: #fff;
			padding: 5px;
		}

		.unifesp-icons>a:hover {
			text-decoration: none;
		}

		.unifesp-icons>a>svg {
			color: #fff;
			width: 20px;
			height: 20px;
			vertical-align: middle;
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
								<td style="border: none; text-align: center; color: <?php echo $color[1] ?>; font-size: 1.5rem; font-weight: 600;">
									<p>Olá, <?php $notification->nome ?></p>
									<p>A Meta <?php echo $indicador[0]->id ?> foi atualizada!</p>

								</td>
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

function limit_words($string, $word_limit)
{
	$words = explode(' ', $string, ($word_limit + 1));
	if (count($words) > $word_limit) {
		array_pop($words);
		array_push($words, '...');
	}
	return implode(' ', $words);
}
