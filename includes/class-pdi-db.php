<?php
defined('ABSPATH') or die('No script kiddies please!');

/**
 * PDI - Núcleo Digital
 * Developer: Igor Sacramento
 *
 * Class PDI_DB
 */

class PDI_DB
{

	private static $prefix_table								= PREFIXO_TABLE;
	private static $table_objetivos_ouse				= TABLE_OBJETIVOS_OUSE;
	private static $table_ods										= TABLE_ODS;
	private static $table_pne										= TABLE_PNE;
	private static $table_indicadores_anos			= TABLE_INDICADORES_ANOS;
	private static $table_indicadores						= TABLE_INDICADORES;
	private static $table_grande_tema						= TABLE_GRANDE_TEMA;
	private static $table_eixo									= TABLE_EIXO;
	private static $table_acoes									= TABLE_ACOES;
	private static $table_atores								= TABLE_ATORES;
	private static $table_objetivo_especifico		= TABLE_OBJETIVO_ESPECIFICO;
	private static $table_notification					= TABLE_NOTIFICATION;
	private static $table_comments							= TABLE_COMMENTS;
	private static $table_configs								= TABLE_CONFIGS;
	private static $table_logs									= TABLE_LOGS;

	/**
	 * Verifica se a tablela está criada no banco de dados
	 * 
	 * @param string $table (Nome da tabela)
	 * @return bool
	 */
	public static function check_tables(string $table)
	{
		global $wpdb;
		$select = $wpdb->query(
			$wpdb->prepare(
				"SELECT * FROM " . self::$prefix_table . $table
			)
		);

		return ($select) ? true : false;
	}

	/**
	 * Criar tabelas de configurações
	 */
	public static function create_table_configs()
	{
		if (self::check_tables(self::$table_configs)) {
			return false;
		}

		global $wpdb;
		$query = "CREATE TABLE " . self::$prefix_table . self::$table_configs . " ( "
			. "id bigint unsigned NOT NULL AUTO_INCREMENT, "
			. "meta_key varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL, "
			. "meta_value longtext COLLATE utf8_unicode_ci, "
			. "PRIMARY KEY (id) "
			. ") ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Criar tabelas de logs
	 */
	public static function create_table_logs()
	{
		if (self::check_tables(self::$table_logs)) {
			return false;
		}

		global $wpdb;
		$query = "CREATE TABLE " . self::$prefix_table . self::$table_logs . " (
			`id` INT AUTO_INCREMENT,
			`log` LONGTEXT NULL,
			`status` LONGTEXT NULL,
			`infos` LONGTEXT NULL,
			`user_id` INT NULL,
			`created_at` DATETIME NULL,
			PRIMARY KEY (`id`),
			UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
			ENGINE = InnoDB
			DEFAULT CHARACTER SET = utf8mb4
			COLLATE = utf8mb4_unicode_ci";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Criar tabela Objetivos no banco de dados
	 */
	public static function create_table_objetivos_ouse()
	{
		if (self::check_tables(self::$table_objetivos_ouse)) {
			return false;
		}

		global $wpdb;
		$query = "CREATE TABLE " . self::$prefix_table . self::$table_objetivos_ouse . " ( "
			. "id bigint unsigned NOT NULL AUTO_INCREMENT,  "
			. "descricao varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,  "
			. "grande_tema_id bigint(20) DEFAULT NULL,  "
			. "active tinyint(1) DEFAULT '1',  "
			. "created_at timestamp NULL DEFAULT NULL,  "
			. "updated_at timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,  "
			. "PRIMARY KEY (id) "
			. ")ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Criar tabela Ods no banco de dados
	 */
	public static function create_table_ods()
	{
		if (self::check_tables(self::$table_ods)) {
			return false;
		}

		global $wpdb;
		$query = "CREATE TABLE " . self::$prefix_table . self::$table_ods . " ( "
			. "id bigint unsigned NOT NULL AUTO_INCREMENT,  "
			. "titulo varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,  "
			. "slug varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,  "
			. "img longtext COLLATE utf8mb4_unicode_ci,  "
			. "active tinyint(1) DEFAULT '1',  "
			. "created_at timestamp NULL DEFAULT NULL,  "
			. "updated_at timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,  "
			. "PRIMARY KEY (id) "
			. ")ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Criar tabela pne no banco de dados
	 */
	public static function create_table_pne()
	{
		if (self::check_tables(self::$table_pne)) {
			return false;
		}

		global $wpdb;
		$query = "CREATE TABLE " . self::$prefix_table . self::$table_pne . " ( "
			. "id bigint unsigned NOT NULL AUTO_INCREMENT,  "
			. "titulo varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,  "
			. "slug varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,  "
			. "active tinyint(1) DEFAULT '1',  "
			. "created_at TIMESTAMP NULL DEFAULT NULL,  "
			. "updated_at timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,  "
			. "PRIMARY KEY (id) "
			. ")ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Criar tabela indicadores_anos no banco de dados
	 */
	public static function create_table_indicadores_anos()
	{
		if (self::check_tables(self::$table_indicadores_anos)) {
			return false;
		}

		global $wpdb;
		$query = "CREATE TABLE " . self::$prefix_table . self::$table_indicadores_anos . " ( "
			. "id bigint unsigned NOT NULL AUTO_INCREMENT,  "
			. "indicador_id bigint NOT NULL,  "
			. "ano int NOT NULL,  "
			. "valor decimal(15, 2) DEFAULT NULL,  "
			. "valor_previsto decimal(15, 2) DEFAULT NULL,  "
			. "data_registro date NOT NULL,  "
			. "justificativa longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,  "
			. "active tinyint(1) DEFAULT '1',  "
			. "created_at timestamp NULL DEFAULT NULL,  "
			. "updated_at timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,  "
			. "PRIMARY KEY (id) "
			. ")ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Criar tabela indicadores no banco de dados
	 */
	public static function create_table_indicadores()
	{
		if (self::check_tables(self::$table_indicadores)) {
			return false;
		}

		global $wpdb;
		$query = "CREATE TABLE " . self::$prefix_table . self::$table_indicadores . " ( "
			. "id bigint unsigned NOT NULL AUTO_INCREMENT,  "
			. "number int(10) DEFAULT NULL,  "
			. "grande_tema_id bigint NOT NULL,  "
			. "objetivo_ouse_id bigint NOT NULL,  "
			. "titulo varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,  "
			. "descricao longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,  "
			. "ods longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,  "
			. "pne longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,  "
			. "valor_meta decimal(15, 2) DEFAULT NULL,  "
			. "justif_valor_meta longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,"
			. "valor_inicial decimal(15, 2) DEFAULT NULL,  "
			. "justif_valor_inicial longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,"
			. "data_registro date NOT NULL,  "
			. "active tinyint(1) DEFAULT '1',  "
			. "created_at timestamp NULL DEFAULT NULL,  "
			. "updated_at timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,  "
			. "PRIMARY KEY (id) "
			. ")ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Criar tabela grande_tema no banco de dados
	 */
	public static function create_table_grande_tema()
	{
		if (self::check_tables(self::$table_grande_tema)) {
			return false;
		}

		global $wpdb;
		$query = "CREATE TABLE " . self::$prefix_table . self::$table_grande_tema . " ( "
			. "id bigint unsigned NOT NULL AUTO_INCREMENT,  "
			. "descricao varchar(255) COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,  "
			. "layout varchar(255) COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,  "
			. "active tinyint(1) DEFAULT '1',  "
			. "created_at timestamp NULL DEFAULT NULL,  "
			. "updated_at timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,  "
			. "PRIMARY KEY (id) "
			. ")ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

		//return $query;

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Criar tabela eixo no banco de dados
	 */
	public static function create_table_eixo()
	{
		if (self::check_tables(self::$table_eixo)) {
			return false;
		}

		global $wpdb;
		$query = "CREATE TABLE " . self::$prefix_table . self::$table_eixo . " ( "
			. "id bigint unsigned NOT NULL AUTO_INCREMENT,  "
			. "descricao varchar(255) COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,  "
			. "active tinyint(1) DEFAULT '1',  "
			. "created_at timestamp NULL DEFAULT NULL,  "
			. "updated_at timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,  "
			. "PRIMARY KEY (id) "
			. ")ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Criar tabela acoes_estrategicas no banco de dados
	 */
	public static function create_table_acoes()
	{
		if (self::check_tables(self::$table_acoes)) {
			return false;
		}

		global $wpdb;
		$query = "CREATE TABLE " . self::$prefix_table . self::$table_acoes . " ( "
			. "id bigint unsigned NOT NULL AUTO_INCREMENT,  "
			. "indicador_id bigint NOT NULL,  "
			. "eixo_id bigint NOT NULL,  "
			. "objetivo_especifico longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,  "
			. "descricao_acao longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,  "
			. "ator bigint NOT NULL,  "
			. "justificativa longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,  "
			. "percentual_cumprido decimal(15, 2) NOT NULL,  "
			. "data_registro date NOT NULL,  "
			. "ano_acao int(11) NOT NULL,  "
			. "prazo_execucao varchar(255) NOT NULL,  "
			. "user_id int(11) DEFAULT NULL,  "
			. "active tinyint(1) DEFAULT '1',  "
			. "created_at timestamp NULL DEFAULT NULL,  "
			. "updated_at timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,  "
			. "PRIMARY KEY (id) "
			. ")ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Criar tabela atores no banco de dados
	 */
	public static function create_atores()
	{
		if (self::check_tables(self::$table_atores)) {
			return false;
		}

		global $wpdb;
		$query = "CREATE TABLE " . self::$prefix_table . self::$table_atores . " ( "
			. "id bigint unsigned NOT NULL AUTO_INCREMENT,  "
			. "descricao varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,  "
			. "active tinyint(1) DEFAULT '1',  "
			. "created_at timestamp NULL DEFAULT NULL,  "
			. "updated_at timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,  "
			. "PRIMARY KEY (id) "
			. ")ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Criar tabela objetivo_especifico no banco de dados
	 */
	public static function create_objetivo_especifico()
	{
		if (self::check_tables(self::$table_objetivo_especifico)) {
			return false;
		}

		global $wpdb;
		$query = "CREATE TABLE " . self::$prefix_table . self::$table_objetivo_especifico . " ( "
			. "id bigint unsigned NOT NULL AUTO_INCREMENT,  "
			. "descricao varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,  "
			. "active tinyint(1) DEFAULT '1',  "
			. "created_at timestamp NULL DEFAULT NULL,  "
			. "updated_at timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,  "
			. "PRIMARY KEY (id) "
			. ")ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Criar tabela notification no banco de dados
	 */
	public static function create_table_notification()
	{
		if (self::check_tables(self::$table_notification)) {
			return false;
		}

		global $wpdb;
		$query = "CREATE TABLE " . self::$prefix_table . self::$table_notification . " ( "
			. "id bigint unsigned NOT NULL AUTO_INCREMENT,  "
			. "indicador_id bigint(20) NOT NULL,  "
			. "nome varchar(255) COLLATE utf8_unicode_ci NOT NULL,  "
			. "email varchar(255) COLLATE utf8_unicode_ci NOT NULL,  "
			. "active tinyint(1) DEFAULT '1',  "
			. "created_at timestamp NULL DEFAULT NULL,  "
			. "updated_at timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,  "
			. "PRIMARY KEY (id) "
			. ")ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Criar tabela comments no banco de dados
	 */
	public static function create_table_comments()
	{
		if (self::check_tables(self::$table_comments)) {
			return false;
		}

		global $wpdb;
		$query = "CREATE TABLE " . self::$prefix_table . self::$table_comments . " ( "
			. "id bigint unsigned NOT NULL AUTO_INCREMENT,  "
			. "indicador_id bigint(20) NOT NULL,  "
			. "user_id bigint(20) DEFAULT NULL,  "
			. "name varchar(255) COLLATE utf8_unicode_ci NOT NULL,  "
			. "comment longtext COLLATE utf8_unicode_ci NOT NULL,  "
			. "comment_parent bigint(20) DEFAULT '0',"
			. "active tinyint(1) DEFAULT '1',  "
			. "created_at timestamp NULL DEFAULT NULL,  "
			. "updated_at timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,  "
			. "PRIMARY KEY (id) "
			. ")ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Inserir configurações padrão
	 */
	public static function insert_configs()
	{
		if (pdi_get_configs_all()) {
			return false;
		}
		global $wpdb;

		$query = "INSERT INTO " . self::$prefix_table . self::$table_configs . " (meta_key, meta_value) VALUES "
			. "('title_filters', 'Use uma das opções abaixo para filtrar as metas:'), "
			. "('filter_active', '1')";

		$insert = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $insert;
	}


	/**
	 * Adicionar conteúdo a tabela Grande Tema
	 */
	public static function insert_grande_tema()
	{
		if (pdi_get_grande_tema_all()) {
			return false;
		}

		global $wpdb;

		$query = "INSERT INTO `pdi_grande_tema` (`id`,  `descricao`,  `layout`,  `active`,  `created_at`,  `updated_at`) VALUES
		(1,  'Defesa da vida,  da educação pública e da dignidade humana',  '[\"#C4806E\", \"#A44B3A\"]',  1,  NOW(),  NOW()), 
		(2,  'Universidade plural,  democrática e articulada com a sociedade',  '[\"#D4D284\", \"#C9C12C\"]',  1,  NOW(),  NOW()), 
		(3,  'Ciência,  educação e inovação com impacto social e em cooperação',  '[\"#5D856E\", \"#215A36\"]',  1,  NOW(),  NOW()), 
		(4,  'Articulação pedagógica e multiunidades',  '[\"#70809F\", \"#2E668C\"]',  1,  NOW(),  NOW()), 
		(5,  'Completar e consolidar a expansão',  '[\"#768A88\", \"#5F726A\"]',  1,  NOW(),  NOW());";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Adicionar conteúdo a tabela Objetivo Ouse
	 */
	public static function insert_objetivos_ouse()
	{
		if (pdi_get_objetivos_ouse_all()) {
			return false;
		}

		global $wpdb;

		$query = "INSERT INTO `pdi_objetivos_ouse` (`id`,  `descricao`, `grande_tema_id`,  `active`,  `created_at`,  `updated_at`) VALUES 
		(1, 'AMPLIAR A FORMAÇÃO DE PROFESSORES PARA A EDUCAÇÃO BÁSICA', 1, 1, NOW(), NOW()), 
		(2, 'AMPLIAR A GOVERNANÇA PARTICIPATIVA', 2, 1, NOW(), NOW()), 
		(3, 'AMPLIAR A INTERNACIONALIZAÇÃO SUL-SUL', 3, 1, NOW(), NOW()), 
		(4, 'AMPLIAR A PRODUÇÃO E IMPACTO DA PESQUISA', 4, 1, NOW(), NOW()), 
		(5, 'AMPLIAR AÇÕES AMBIENTAIS', 4, 1, NOW(), NOW()), 
		(6, 'AMPLIAR COLABORAÇÕES EM TEMAS ESTRATÉGICOS', 3, 1, NOW(), NOW()), 
		(7, 'AMPLIAR COLETA SELETIVA SOLIDÁRIA', 2, 1, NOW(), NOW()), 
		(8, 'AMPLIAR ELOS COM MUNDO DO TRABALHO', 2, 1, NOW(), NOW()), 
		(9, 'AMPLIAR ESTRUTURAS CONVERGENTES', 4, 1, NOW(), NOW()), 
		(10, 'AMPLIAR INTERAÇÃO COM NOSSOS ENTORNOS', 2, 1, NOW(), NOW()), 
		(11, 'AMPLIAR O DIÁLOGO E A ARTICULAÇÃO COM A SOCIEDADE', 2, 1, NOW(), NOW()), 
		(12, 'AMPLIAR OS ACERVOS FÍSICOS E DIGITAIS DA REDE DE BIBLIOTECAS', 5, 1, NOW(), NOW()), 
		(13, 'AMPLIAR PRODUÇÃO DE CONHECIMENTO COM ACESSO ABERTO', 3, 1, NOW(), NOW()), 
		(14, 'AMPLIAR RELAÇÃO COM O SETOR PRODUTIVO', 3, 1, NOW(), NOW()), 
		(15, 'AMPLIAR TROCAS ENTRE COMUNIDADES CIENTÍFICAS E TRADICIONAIS,  SABERES POPULARES E MOVIMENTOS SOCIAIS', 2, 1, NOW(), NOW()), 
		(16, 'APOIAR A PRODUÇÃO DE CONHECIMENTO NA ESCOLA PAULISTINHA DE EDUCAÇÃO', 3, 1, NOW(), NOW()), 
		(17, 'APOIAR SOFTWARES LIVRES', 3, 1, NOW(), NOW()), 
		(18, 'ATUAR EM ÁREAS VULNERÁVEIS COM AS ORGANIZAÇÕES LOCAIS', 1, 1, NOW(), NOW()), 
		(19, 'ATUAR POR RECURSOS COMPLEMENTARES PARA OBRAS', 5, 1, NOW(), NOW()), 
		(20, 'AUMENTAR A TAXA DE SUCESSO DA GRADUAÇÃO', 4, 1, NOW(), NOW()), 
		(21, 'AUMENTAR A TAXA DE SUCESSO DA PÓS-GRADUAÇÃO', 4, 1, NOW(), NOW()), 
		(22, 'COMPLETAR A EXPANSÃO CONFORME PLANEJADA E PACTUADA', 5, 1, NOW(), NOW()), 
		(23, 'CONSOLIDAR OS OBSERVATÓRIOS COMO INSTRUMENTO DE CIDADANIA ATIVA', 2, 1, NOW(), NOW()), 
		(24, 'CONSTRUIR METAS SOCIAIS PÚBLICAS', 2, 1, NOW(), NOW()), 
		(25, 'DEMOCRATIZAR A EDUCAÇÃO EM SAÚDE', 1, 1, NOW(), NOW()), 
		(26, 'DESENVOLVER PARCERIAS PARA PROJETOS COM IMPACTO SOCIAL', 2, 1, NOW(), NOW()), 
		(27, 'ELABORAR E IMPLANTAR PLANOS AMBIENTAIS EM TODOS OS CAMPI', 5, 1, NOW(), NOW()), 
		(28, 'ESTABELECER REDES COOPERATIVAS DE INOVAÇÃO COM IMPACTO SOCIAL', 3, 1, NOW(), NOW()), 
		(29, 'ESTIMULAR CULTURA DE INOVAÇÃO NA UNIFESP', 3, 1, NOW(), NOW()), 
		(30, 'ESTIMULAR PÓS-GRADUAÇÃO PROFISSIONAL COM IMPACTO SOCIAL', 3, 1, NOW(), NOW()), 
		(31, 'FOMENTAR INTEGRAÇÃO MULTIUNIDADES PELA PÓS-GRADUAÇÃO E PESQUISA', 4, 1, NOW(), NOW()), 
		(32, 'FOMENTAR PRÁTICAS COLABORATIVAS E DE INTERCÂMBIO MULTIUNIDADES', 4, 1, NOW(), NOW()), 
		(33, 'FOMENTO À ECONOMIA SOLIDÁRIA NO ENTORNO DOS CAMPI', 3, 1, NOW(), NOW()), 
		(34, 'FOMENTO À PÓS-GRADUAÇÃO E PESQUISA NOS CAMPI DE EXPANSÃO', 5, 1, NOW(), NOW()), 
		(35, 'FORMAÇÃO DIRIGIDA A REDUZIR DESIGUALDADES', 1, 1, NOW(), NOW()), 
		(36, 'FORMAÇÕES EM SAÚDE PARA TODOS', 1, 1, NOW(), NOW()), 
		(37, 'FORTALECER A ATUAÇÃO NA EDUCAÇÃO PÚBLICA', 1, 1, NOW(), NOW()), 
		(38, 'FORTALECER A ATUAÇÃO NO SUS', 1, 1, NOW(), NOW()), 
		(39, 'FORTALECER A DEMOCRACIA DIGITAL NA UNIFESP', 2, 1, NOW(), NOW()), 
		(40, 'FORTALECER AÇÕES DE PERMANÊNCIA ESTUDANTIL NA (PÓS-)PANDEMIA', 1, 1, NOW(), NOW()), 
		(41, 'FORTALECER IMAGEM PÚBLICA DA UNIFESP', 2, 1, NOW(), NOW()), 
		(42, 'FUNDAÇÃO DE APOIO FAP-SUSTENTÁVEL', 3, 1, NOW(), NOW()), 
		(43, 'GARANTIR OS NAE EM TODOS OS CAMPI', 5, 1, NOW(), NOW()), 
		(44, 'GARANTIR RESTAURANTE UNIVERSITÁRIO EM TODOS OS CAMPI', 5, 1, NOW(), NOW()), 
		(45, 'GESTÃO COM PESSOAS E FORMAÇÃO DE SERVIDORES NA (PÓS-)PANDEMIA.', 1, 1, NOW(), NOW()), 
		(46, 'IMPLEMENTAÇÃO PPI,  DIRETRIZES A CONSIDERAR', 4, 1, NOW(), NOW()), 
		(47, 'IMPLEMENTAÇÃO PPI,  DIRETRIZES A INSTITUIR', 4, 1, NOW(), NOW()), 
		(48, 'IMPLEMENTAÇÃO PPI,  FORTALECER DIRETRIZES INSTITUÍDAS', 4, 1, NOW(), NOW()), 
		(49, 'IMPLEMENTAR MORADIAS ESTUDANTIS', 5, 1, NOW(), NOW()), 
		(50, 'MELHORAR CONTINUAMENTE AS INFRAESTRUTURAS', 5, 1, NOW(), NOW()), 
		(51, 'MELHORAR O CONCEITO DE CURSO DA GRADUAÇÃO', 4, 1, NOW(), NOW()), 
		(52, 'MELHORAR O CONCEITO DE CURSO DA PÓS-GRADUAÇÃO', 4, 1, NOW(), NOW()), 
		(53, 'MODERNIZAR E INTEGRAR SISTEMAS DE TI', 4, 1, NOW(), NOW()), 
		(54, 'MODERNIZAR INFRAESTRUTURA DE TI', 5, 1, NOW(), NOW()), 
		(55, 'PLURALIZAR CURRICULOS', 2, 1, NOW(), NOW()), 
		(56, 'POLÍTICA DE EQUIDADE NO DIMENSIONAMENTO DE SERVIDORES ENTRE OS CAMPI', 5, 1, NOW(), NOW()), 
		(57, 'POPULARIZAR CONHECIMENTO PARA FORTALECER LAÇOS SOCIAIS', 2, 1, NOW(), NOW()), 
		(58, 'POSSIBILITAR PERCURSOS FORMATIVOS', 4, 1, NOW(), NOW()), 
		(59, 'PRODUZIR CONHECIMENTO EM DEFESA DA VIDA', 1, 1, NOW(), NOW()), 
		(60, 'PROMOVER A CULTURA DE DIREITOS HUMANOS', 1, 1, NOW(), NOW()), 
		(61, 'PROMOVER A EQUIDADE E O COMBATE AO RACISMO', 2, 1, NOW(), NOW()), 
		(62, 'PROMOVER CONDIÇÕES DE PERMANÊNCIA ESTUDANTIL COM QUALIDADE', 4, 1, NOW(), NOW()), 
		(63, 'PROMOVER FORMAÇÃO INTEGRAL EM CONTEXTOS COMPLEXOS', 4, 1, NOW(), NOW()), 
		(64, 'PROMOVER FORMAÇÃO MULTIUNIDADES E INTERDISCIPLINAR DESDE A GRADUAÇÃO', 4, 1, NOW(), NOW()), 
		(65, 'PROPICIAR INCLUSÃO COTIDIANA DA SOCIEDADE NAS NOSSAS ATIVIDADES', 2, 1, NOW(), NOW()), 
		(66, 'REALIZAR OBRAS PLANEJADAS NOS CAMPI', 5, 1, NOW(), NOW()), 
		(67, 'REVISÃO DE PPC EM ACORDO COM NOVO PPI E TEMAS CONVERGENTES', 4, 1, NOW(), NOW()), 
		(68, 'SIMPLIFICAR PROCESSOS PARA COOPERAÇÕES INSTITUCIONAIS', 3, 1, NOW(), NOW()), 
		(69, 'SISTEMAS UNIVERSITÁRIOS QUE FORTALEÇAM A EQUIDADE', 1, 1, NOW(), NOW()), 
		(70, 'TECNOLOGIAS DE SAÚDE DIGITAL: Disseminar de forma crítica,  reflexiva e analítica,  as tecnologias de saúde digital síncronas e assíncronas', 3, 1, NOW(), NOW()), 
		(71, 'UNIFESP CADA VEZ MAIS PLURAL E INCLUSIVA', 2, 1, NOW(), NOW()), 
		(72, 'VALORAÇÃO ACADÊMICA RECONHECENDO DIFERENÇAS ENTRE ÁREAS', 3, 1, NOW(), NOW());";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Adicionar conteúdo a tabela ODS
	 */
	public static function insert_ods()
	{
		if (pdi_get_ods_all()) {
			return false;
		}

		global $wpdb;

		$query = "INSERT INTO `pdi_ods` (`id`,  `titulo`,  `slug`,  `img`,  `active`,  `created_at`,  `updated_at`) VALUES
		(1,  'Erradicação da pobreza',  'erradicacao-da-pobreza',  'assets/images/ods/erradicacao-da-pobreza',  1,  NOW(),  NOW()), 
		(2,  'Fome zero e agricultura sustentável',  'fome-zero-e-agricultura-sustentavel',  'assets/images/ods/fome-zero-e-agricultura-sustentavel',  1,  NOW(),  NOW()), 
		(3,  'Saúde e bem estar',  'saude-e-bem-estar',  'assets/images/ods/saude-e-bem-estar',  1,  NOW(),  NOW()), 
		(4,  'Educação de qualidade',  'educacao-de-qualidade',  'assets/images/ods/educacao-de-qualidade',  1,  NOW(),  NOW()), 
		(5,  'Igualdade de gênero',  'igualdade-de-genero',  'assets/images/ods/igualdade-de-genero',  1,  NOW(),  NOW()), 
		(6,  'Água potável e saneamento',  'agua-potavel-e-saneamento',  'assets/images/ods/agua-potavel-e-saneamento',  1,  NOW(),  NOW()), 
		(7,  'Energia acessível e limpa',  'energia-acessivel-e-limpa',  'assets/images/ods/energia-acessivel-e-limpa',  1,  NOW(),  NOW()), 
		(8,  'Trabalho decente e crescimento econômico',  'trabalho-decente-e-crescimento-economico',  'assets/images/ods/trabalho-decente-e-crescimento-economico',  1,  NOW(),  NOW()), 
		(9,  'Indústria,  inovação e infraestrutura',  'industria-inovacao-e-infraestrutura',  'assets/images/ods/industria-inovacao-e-infraestrutura',  1,  NOW(),  NOW()), 
		(10,  'Redução das desigualdades',  'reducao-das-desigualdades',  'assets/images/ods/reducao-das-desigualdades',  1,  NOW(),  NOW()), 
		(11,  'Cidades e comunidades sustentáveis',  'cidades-e-comunidades-sustentaveis',  'assets/images/ods/cidades-e-comunidades-sustentaveis',  1,  NOW(),  NOW()), 
		(12,  'Consumo de produção sustentável',  'consumo-de-producao-sustentavel',  'assets/images/ods/consumo-de-producao-sustentavel',  1,  NOW(),  NOW()), 
		(13,  'Ação contra a mudança global do clima',  'acao-contra-a-mudanca-global-do-clima',  'assets/images/ods/acao-contra-a-mudanca-global-do-clima',  1,  NOW(),  NOW()), 
		(14,  'Vida na água',  'vida-na-agua',  'assets/images/ods/vida-na-agua',  1,  NOW(),  NOW()), 
		(15,  'Vida terrestre',  'vida-terrestre',  'assets/images/ods/vida-terrestre',  1,  NOW(),  NOW()), 
		(16,  'Paz,  justiça e instituições eficazes',  'paz-justica-e-instituicoes-eficazes',  'assets/images/ods/paz-justica-e-instituicoes-eficazes',  1,  NOW(),  NOW()), 
		(17,  'Parcerias e meios de implementação',  'parcerias-e-meios-de-implementacao',  'assets/images/ods/parcerias-e-meios-de-implementacao',  1,  NOW(),  NOW());";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Adicionar conteúdo a tabela PNE
	 */
	public static function insert_pne()
	{
		if (pdi_get_pne_all()) {
			return false;
		}

		global $wpdb;

		$query = "INSERT INTO `pdi_pne` (`id`,  `titulo`,  `slug`,  `active`,  `created_at`,  `updated_at`) VALUES
		(1,  'Educação Infantil',  'educacao-infantil',  1,  NOW(),  NOW()), 
		(2,  'Ensino fundamental',  'ensino-fundamental',  1,  NOW(),  NOW()), 
		(3,  'Ensino médio',  'ensino-medio',  1,  NOW(),  NOW()), 
		(4,  'Educação especial/inclusiva',  'educacao-especial-inclusiva',  1,  NOW(),  NOW()), 
		(5,  'Alfabetização',  'alfabetizacao',  1,  NOW(),  NOW()), 
		(6,  'Educação integral',  'educacao-integral',  1,  NOW(),  NOW()), 
		(7,  'Aprendizado adequado na idade certa',  'aprendizado-adequado-na-idade-certa',  1,  NOW(),  NOW()), 
		(8,  'Escolaridade média',  'escolaridade-media',  1,  NOW(),  NOW()), 
		(9,  'Alfabetização e alfabetismo funcional',  'alfabetizacao-e-alfabetismo-funcional',  1,  NOW(),  NOW()), 
		(10,  'EJA integrada à Educação Profissional',  'eja-integrada-a-educacao-profissional',  1,  NOW(),  NOW()), 
		(11,  'Educação profissional',  'educacao-profissional',  1,  NOW(),  NOW()), 
		(12,  'Educação superior',  'educacao-superior',  1,  NOW(),  NOW()), 
		(13,  'Titulação de professores da educação superior',  'titulacao-de-professores-da-educacao-superior',  1,  NOW(),  NOW()), 
		(14,  'Pós-graduação',  'pos-graduacao',  1,  NOW(),  NOW()), 
		(15,  'Formação de professores',  'formacao-de-professores',  1,  NOW(),  NOW()), 
		(16,  'Formação continuada e pós-graduação',  'formacao-continuada-e-pos-graduacao',  1,  NOW(),  NOW()), 
		(17,  'Valorização do professor',  'valorizacao-do-professor',  1,  NOW(),  NOW()), 
		(18,  'Plano de carreira docente',  'plano-de-carreira-docente',  1,  NOW(),  NOW()), 
		(19,  'Gestão democrática',  'gestao-democratica',  1,  NOW(),  NOW()), 
		(20,  'Financiamento da educação',  'financiamento-da-educacao',  1,  NOW(),  NOW());";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Adicionar conteúdo a tabela Atores
	 */
	public static function insert_atores()
	{
		if (pdi_get_atores_all()) {
			return false;
		}

		global $wpdb;

		$query = "INSERT INTO `pdi_atores` (`id`,  `descricao`,  `active`,  `created_at`,  `updated_at`) VALUES
		(1,  'PROGRAD',  1,  NOW(),  NOW()), 
		(2,  'PROPLAN',  1,  NOW(),  NOW()), 
		(3,  'STI',  1,  NOW(),  NOW());";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Adicionar conteúdo a tabela Eixos
	 */
	public static function insert_eixos()
	{
		if (pdi_get_eixo_all()) {
			return false;
		}

		global $wpdb;

		$query = "INSERT INTO `pdi_eixo` (`id`,  `descricao`,  `active`,  `created_at`,  `updated_at`) VALUES
		(1,  'Eixo 1',  1,  NOW(),  NOW()), 
		(2,  'Eixo 2',  1,  NOW(),  NOW()), 
		(3,  'Eixo 3',  1,  NOW(),  NOW()), 
		(4,  'Eixo 4',  1,  NOW(),  NOW()), 
		(5,  'Eixo 5',  1,  NOW(),  NOW());";

		$create = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $create;
	}

	/**
	 * Busca todos os dados de uma tabela
	 * 
	 * @param string $table (Nome da tabela a ser buscada)
	 * @return object
	 */
	public static function get_table(string $table,  array $filter = array(),  int $per_page = null,  int $page = 1,  string $order = null,  string $orderby = 'ASC', string $query_string = null, array $multi_order = [])
	{
		global $wpdb;
		$query = "SELECT * FROM " . self::$prefix_table . $table;

		if ($filter) {
			$where = " WHERE ";
			$where_or = "";
			foreach ($filter as $key => $value) {
				if (is_array($value)) {
					$where_or .= "(";
					foreach ($value as $k => $v) {
						if (is_numeric($v)) {
							$where_or .= "{$key}={$v} OR ";
						} elseif (is_string($v)) {
							$where_or .= "{$key}='{$v}' OR ";
						} else {
							$where_or .= "{$key}='' OR ";
						}
					}
					$where_or = rtrim($where_or,  ' OR ');
					$where_or .= ")";
				} else {
					if (is_numeric($value)) {
						$where .= "{$key}={$value} AND ";
					} elseif (is_string($value)) {
						$where .= "{$key}='{$value}' AND ";
					} else {
						$where .= "{$key}='' AND ";
					}
				}
			}
			$where = (!$where_or) ? rtrim($where,  ' AND ') : $where;
			$query = $query . $where . $where_or;
		}

		if ($order) {
			$query .= " ORDER BY {$order} {$orderby}";
		}

		if ($multi_order) {
			$query .= " ORDER BY";
			foreach ($multi_order as $order_ => $order_by) {
				$query .= " {$order_} {$order_by}";
			}
		}

		if ($multi_order)

			if ($per_page) {
				$offset = ($per_page * ($page - 1));
				$query .= " LIMIT {$per_page} OFFSET {$offset}";
			}

		if ($query_string) {
			$query .= $query_string;
		}

		// return $query;

		$select = $wpdb->get_results(
			$wpdb->prepare(
				$query
			)
		);

		return $select;
	}

	/**
	 * Conta todos os dados de uma tabela
	 * 
	 * @param string $table (Nome da tabela a ser buscada)
	 * @return object
	 */
	public static function count_table(string $table,  array $filter = array())
	{
		global $wpdb;
		$query = "SELECT * FROM " . self::$prefix_table . $table;

		if ($filter) {
			$where = " WHERE ";
			$where_or = "";
			foreach ($filter as $key => $value) {
				if (is_array($value)) {
					$where_or .= "(";
					foreach ($value as $k => $v) {
						if (is_numeric($v)) {
							$where_or .= "{$key}={$v} OR ";
						} elseif (is_string($v)) {
							$where_or .= "{$key}='{$v}' OR ";
						} else {
							$where_or .= "{$key}='' OR ";
						}
					}
					$where_or = rtrim($where_or,  ' OR ');
					$where_or .= ")";
				} else {
					if (is_numeric($value)) {
						$where .= "{$key}={$value} AND ";
					} elseif (is_string($value)) {
						$where .= "{$key}='{$value}' AND ";
					} else {
						$where .= "{$key}='' AND ";
					}
				}
			}
			$where = (!$where_or) ? rtrim($where,  ' AND ') : $where;
			$query = $query . $where . $where_or;
		}

		$select = $wpdb->query(
			$wpdb->prepare(
				$query
			)
		);

		return $select;
	}

	/**
	 * Busca ocorrencias em tabela do PDI
	 * 
	 * @param string $table (Nome da tabela a ser buscada)
	 * @param array $args (array com filtros da busca sendo o key = campo e value = valor buscado)
	 * @return object
	 */
	public static function get_option(string $table,  array $args = array())
	{
		global $wpdb;
		$query = "SELECT * FROM " . self::$prefix_table . $table;

		if ($args) :
			$conditions = " ";
			foreach ($args as $key => $value) {
				if (is_numeric($value)) {
					$conditions .= "{$key}={$value} AND ";
				} elseif (is_string($value)) {
					$conditions .= "{$key}='{$value}' AND ";
				} else {
					$conditions .= "{$key}='' AND ";
				}
			}
			$conditions = rtrim($conditions,  ' AND ');
			$query = $query . ' WHERE' . $conditions;

		endif; // $args

		$consulta = $wpdb->get_results(
			$wpdb->prepare(
				$query
			)
		);

		return ($consulta) ? $consulta : false;
	}

	/**
	 * Insere dados em tabela do PDI
	 * 
	 * @param string $table (Nome da tabela a onde os dados serão inseridos)
	 * @param array $args (array com dados a serem iseridos,  sendo o key = campo e value = valor buscado)
	 * @param array $format (array com o formato dos dados na mesma ordem do args (%d,  %s,  $f))
	 * @return object
	 */
	public static function set_option(string $table,  array $args,  $format = null)
	{
		global $wpdb;

		$insert = $wpdb->insert(
			self::$prefix_table . $table,
			$args,
			$format
		);

		return ($insert) ? $wpdb->insert_id : $insert;
	}

	/**
	 * Atualiza dados em tabela do PDI ou insere caso a linha não exista
	 * 
	 * @param string $table (Nome da tabela a onde os dados serão inseridos)
	 * @param array $args (array com dados a serem alterados,  sendo o key = campo e value = valor)
	 * @param array $where (array com dados where,  sendo o key = campo e value = valor)
	 * @param array $where (array com o formato dos dados na mesma ordem do args (%d,  %s,  $f))
	 * @param array $where_format (array com o formato dos dados na mesma ordem do where (%d,  %s,  $f))
	 * @return object
	 */
	public static function update_option(string $table,  array $args,  array $where,  $format = null,  $where_format = null)
	{
		global $wpdb;

		$update = $wpdb->update(
			self::$prefix_table . $table,
			$args,
			$where,
			$format,
			$where_format,
		);

		return $args;

		if (!$update) {
			return ($wpdb->insert_id) ? $wpdb->insert_id : false;
		}

		return ($update) ? true : false;
	}

	public static function delete_option(string $table,  array $args,  $format = null)
	{
		global $wpdb;

		$delete = $wpdb->delete(
			self::$prefix_table . $table,
			$args,
			$format
		);

		return $delete;
	}

	public static function get_option_query(string $table, string $args_query = null)
	{
		global $wpdb;
		$query = "SELECT * FROM " . self::$prefix_table . $table;

		if ($args_query) {
			$query = $query . ' ' . $args_query;
		}

		// return $query;

		$select = $wpdb->get_results(
			$wpdb->prepare(
				$query
			)
		);

		return $select;
	}

	public static function get_table_query(string $table, string $select = '*', string $query_string = null)
	{
		global $wpdb;
		$query = "SELECT ${select} FROM " . self::$prefix_table . $table . ' as indicadores ' . $query_string;
		// print_r($query);
		// return $query;

		$select = $wpdb->get_results(
			$wpdb->prepare(
				$query
			)
		);

		return $select;
	}
}
