<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
global $current_user;
if (in_array('pdi_nivel_1', $current_user->roles) || in_array('pdi_nivel_2', $current_user->roles)) :
	pdi_get_template_front('admin/no-permission');
else :
	if ($_FILES['file_import_metas']) {
		if (!class_exists('XLSXWriter')) {
			include_once('/inc/XLSXReader.php');
		}
		if ($_GET['type'] == 'metas') {
			$target_file = PDI_UPLOAD . $_FILES['file_import_metas']['name'];
			$upload = move_uploaded_file($_FILES['file_import_metas']["tmp_name"], $target_file);
			echo "<p>Importantdo arquivo <strong>{$_FILES['file_import_metas']['name']}</strong></p>";
			$xlsx = new XLSXReader($target_file);

			$sheetNames = $xlsx->getSheetNames();
			foreach ($sheetNames as $sheetName) {
				$sheet = $xlsx->getSheet($sheetName);
				echo "<p>Nome da tabela <strong>{$sheetName}</strong></p>";
				$xlsx_data = $sheet->getData();
				$header_row_xlsx = array_shift($xlsx_data);
				$headerInit = array(
					'DESC_TEMA',
					'DESC_OUSE',
					'COD_META',
					'TITULO_INDICADOR',
					'DESC_META',
					'ODS',
					'PNE',
					'META_INDICADOR',
					'META_INICIAL',
					'DATA REGISTRO',
					'ANO_INDICADOR',
					'META_ANUAL_INDICADOR',
					'VALOR_INDICADOR',
					'DATA_RESGISTO_ANO',
					'JUSTIVICATIVA_INDICADOR'
				);
				foreach ($header_row_xlsx as $header) {
					if (!in_array($header, $headerInit)) {
						echo "<p>Tabela com campos incompatíveis. {$header}</p>";
						echo '<a href="?page=pdi-import" class="button button-primary">Voltar para á página de importação</a>';
						exit;
					}
				}
				echo '<p>Iniciando processo de importação.</p>';
				echo '<p><strong style="color:red">Aguarde a conclusão!</strong></p>';
				echo '<p>Não feche a página de evitar erros.</p>';
				global $wpdb;

				echo "<p>Limpando registros do banco de dados</p>";
				// Remove Indicadores
				$query = "TRUNCATE " . PREFIXO_TABLE . TABLE_INDICADORES;
				$wpdb->query(
					$wpdb->prepare($query)
				);

				// Remove Indicadores Anos
				$query = "TRUNCATE " . PREFIXO_TABLE . TABLE_INDICADORES_ANOS;
				$wpdb->query(
					$wpdb->prepare($query)
				);
				$x = 0;
				foreach ($xlsx_data as $row_xlsx) {
					echo "<p>Inserindo Meta {$x}</p>";
					// Insert Indocadores
					$grandeTema = pdi_get_grande_tema(['descricao' => $row_xlsx[0]]);
					$objetivoOuse = pdi_get_objetivos_ouse(['descricao' => $row_xlsx[1]]);
					$odss = $row_xlsx[5];
					$explode_ods = explode(';', $odss);
					$ods = [];
					foreach ($explode_ods as $ods_desc) {
						$ods_ = pdi_get_ods(['titulo' => $ods_desc]);
						$ods[] = $ods_[0]->id;
					}
					$pnes = $row_xlsx[6];
					$explode_pne = explode(';', $pnes);

					$pne = [];
					foreach ($explode_pne as $pne_desc) {
						$pne_ = pdi_get_pne(['titulo' => $pne_desc]);
						$pne[] = $pne_[0]->id;
					}

					$data = [
						'grande_tema_id' => intval($grandeTema[0]->id),
						'objetivo_ouse_id' => intval($objetivoOuse[0]->id),
						'titulo' => $row_xlsx[3],
						'descricao' => $row_xlsx[4],
						'ods' => json_encode($ods),
						'pne' => json_encode($pne),
						'valor_meta' => convert_real_float($row_xlsx[7]),
						'valor_inicial' => convert_real_float($row_xlsx[8]),
						'data_registro' => convert_data_db($row_xlsx[9]),
						'active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s'),
					];

					$format = [
						'%d',
						'%d',
						'%s',
						'%s',
						'%s',
						'%s',
						'%f',
						'%f',
						'%s',
						'%d',
						'%s',
						'%s',
					];

					$insert = pdi_set_indicadores($data, $format);

					// Insert Indicadores Anos
					$anoIndicador = explode(';', $row_xlsx[10]);
					$valorPrevisto = explode(';', $row_xlsx[11]);
					$valorMeta = explode(';', $row_xlsx[12]);
					$dataRegistroAno = explode(';', $row_xlsx[13]);
					$justificativa = explode(';', $row_xlsx[14]);

					for ($i = 0; $i < count($anoIndicador); $i++) {
						$dataAno = [
							'indicador_id' => intval($insert),
							'ano' => $anoIndicador[$i],
							'valor' => $valorMeta[$i],
							'valor_previsto' => $valorPrevisto[$i],
							'data_registro' => convert_data_db($dataRegistroAno[$i]),
							'justificativa' => $justificativa[$i],
							'active' => 1,
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s'),
						];

						$formatAno = [
							'%d',
							'%d',
							'%f',
							'%f',
							'%s',
							'%s',
							'%d',
							'%s',
							'%s',
						];

						$insertAno = pdi_set_indicadores_anos($dataAno, $formatAno);
					}

					$x++;
				}
			}
			echo '<p style="color: green"><strong>Processo de importação finalizado!!</strong></p>';
			echo '<p><strong>Total de Metas importadas ' . $x . '</strong></p>';
			echo '<a href="?page=pdi-import" class="button button-primary">Voltar para á página de importação</a>';
		}
		exit;
	} // Import Metas

	if ($_FILES['file_import_acoes']) {
		if (!class_exists('XLSXWriter')) {
			include_once('/inc/XLSXReader.php');
		}

		if ($_GET['type'] == 'acoes') {
			$target_file = PDI_UPLOAD . $_FILES['file_import_acoes']['name'];
			$upload = move_uploaded_file($_FILES['file_import_acoes']["tmp_name"], $target_file);
			echo "<p>Importantdo arquivo <strong>{$_FILES['file_import_acoes']['name']}</strong></p>";
			$xlsx = new XLSXReader($target_file);

			$sheetNames = $xlsx->getSheetNames();
			foreach ($sheetNames as $sheetName) {
				$sheet = $xlsx->getSheet($sheetName);
				echo "<p>Nome da tabela <strong>{$sheetName}</strong></p>";
				$xlsx_data = $sheet->getData();
				$header_row_xlsx = array_shift($xlsx_data);
				$headerInit = array(
					'COD_META',
					'EIXO_ESTRUTURANTE',
					'DESC_OBJETIVO_ESPECIFICO',
					'ATOR_ENVOLVIDO',
					'DESC_ACAO',
					'ANO_ACAO',
					'PERCENTUAL_CUMPRIDO',
					'DATA_REGISTRO',
					'JUSTIFICATIVA_PLANO',
				);
				foreach ($header_row_xlsx as $header) {
					if (!in_array($header, $headerInit)) {
						echo "<p>Tabela com campos incompatíveis. {$header}</p>";
						echo '<a href="?page=pdi-import" class="button button-primary">Voltar para á página de importação</a>';
						exit;
					}
				}

				echo '<p>Iniciando processo de importação.</p>';
				echo '<p><strong style="color:red">Aguarde a conclusão!</strong></p>';
				echo '<p>Não feche a página de evitar erros.</p>';
				global $wpdb;

				echo "<p>Limpando registros do banco de dados</p>";
				// Remove Indicadores
				$query = "TRUNCATE " . PREFIXO_TABLE . TABLE_ACOES;
				$wpdb->query(
					$wpdb->prepare($query)
				);

				$x = 0;
				foreach ($xlsx_data as $row_xlsx) {
					echo "<p>Inserindo Ação {$x}</p>";
					$ator =  pdi_get_atores(['descricao' => $row_xlsx[3]]);

					$objivosEspecificos = explode(';', $row_xlsx[2]);
					$objEsp = [];
					foreach ($objivosEspecificos as $objetivo) {
						$get = pdi_get_objetivo_especifico(['descricao' => $objetivo]);
						if ($get) {
							$objEsp[] = intval($get[0]->id);
						} else {
							$dataObj = [
								'descricao' => $objetivo,
								'active' => 1,
								'created_at' => date('Y-m-d H:i:s'),
								'updated_at' => date('Y-m-d H:i:s'),
							];
							$formatObj = [
								'%s',
								'%d',
								'%s',
								'%s',
							];
							$set = pdi_set_objetivo_especifico($dataObj, $formatObj);
							$objEsp[] = intval($set);
						}
					} // Foreach Objetivo Específico

					$dataAcao = [
						'indicador_id' => intval($row_xlsx[0]),
						'eixo_id' => intval($row_xlsx[1]),
						'objetivo_especifico' => json_encode($objEsp),
						'descricao_acao' => $row_xlsx[4],
						'ator' => intval($ator[0]->id),
						'justificativa' => $row_xlsx[8],
						'percentual_cumprido' => convert_real_float($row_xlsx[6]),
						'data_registro' => convert_data_db($row_xlsx[7]),
						'ano_acao' => $row_xlsx[5],
						'user_id' => 0,
						'active' => 1,
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s'),
					];

					$formatAcao = [
						'%d',
						'%d',
						'%s',
						'%s',
						'%d',
						'%s',
						'%f',
						'%s',
						'%d',
						'%d',
						'%d',
						'%s',
						'%s',
					];

					$insert = pdi_set_acoes($dataAcao, $formatAcao);

					$x++;
				}
			}
			echo '<p style="color: green"><strong>Processo de importação finalizado!!</strong></p>';
			echo '<p><strong>Total de Ações importadas ' . $x . '</strong></p>';
			echo '<a href="?page=pdi-import" class="button button-primary">Voltar para á página de importação</a>';
		}
		exit;
	} // Import Ações
?>
	<div class="container-fluid pdi-container">
		<div class="pdi-plugin-title">
			<span class="dashicons dashicons-analytics"></span>
			PDI / Importar
		</div>
		<div class="row pdi-row-import">
			<div class="card col-md-5 card-import">
				<h4>Exportar Metas</h4>
				<span>Exportar todas as metas para arquivos xlsx.</span>
				<form id="export-metas" action="<?php echo admin_url('admin-ajax.php?action=pdi_export_metas') ?>" method="POST">
					<div class="form-row">
						<div class="form-group col-md-12 text-center">
							<button type="submit" class="btn btn-primary btn-export btn-export-metas" data-type-import="metas">
								Exportar
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="card col-md-5 card-import">
				<h4>Exportar Ações</h4>
				<span>Exportar todas as ações para arquivos xlsx.</span>
				<form id="export-acoes" action="<?php echo admin_url('admin-ajax.php?action=pdi_export_acoes') ?>" method="POST">
					<div class="form-row">
						<div class="form-group col-md-12 text-center">
							<button type="submit" class="btn btn-primary btn-export btn-export-acoes" data-type-import="acoes">
								Exportar
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="card col-md-5 card-import">
				<h4>Importar Metas</h4>
				<span>A importação da tabela irá substituir todos os dados existentes.</span>
				<form id="import-metas" action="?page=pdi-import&type=metas" method="POST" enctype="multipart/form-data">
					<div class="form-row">
						<div class="form-group col-md-12">
							<input type="file" class="form-control" name="file_import_metas" accept=".csv, .xls, .xlsx">
						</div>
						<div class="form-group col-md-12 text-center">
							<button type="button" class="btn btn-primary btn-import btn-import-metas" data-type-import="metas">
								Importar
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="card col-md-5 card-import">
				<h4>Importar Ações</h4>
				<span>A importação da tabela irá substituir todos os dados existentes.</span>
				<form id="import-acoes" action="?page=pdi-import&type=acoes" method="POST" enctype="multipart/form-data">
					<div class="form-row">
						<div class="form-group col-md-12">
							<input type="file" class="form-control" name="file_import_acoes" accept=".csv, .xls, .xlsx">
						</div>
						<div class="form-group col-md-12 text-center">
							<button type="button" class="btn btn-primary btn-import btn-import-acoes" data-type-import="acoes">
								Importar
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php endif; ?>