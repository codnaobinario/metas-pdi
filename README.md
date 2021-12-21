# PDI - Plano de Desenvolvimento Institucional

## Dados tabela

### `pdi_ods`
CREATE TABLE `pdi_ods` (\
  `id` int(11) NOT NULL AUTO_INCREMENT,\
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,\
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,\
  `img` longtext COLLATE utf8mb4_unicode_ci,\
  `created_at` timestamp NULL DEFAULT NULL,\
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,\
  PRIMARY KEY (`id`)\
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci\

### `pdi_pne`
CREATE TABLE `pdi_pne` (\
  `id` int(11) NOT NULL AUTO_INCREMENT,\
  `titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,\
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,\
  `created_at` timestamp NULL DEFAULT NULL,\
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,\
  PRIMARY KEY (`id`)\
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci\

## Insert Tables
### `ods`
INSERT INTO pdi_ods (titulo, slug, created_at, img) \
	VALUES ('Erradicação da pobreza', 'erradicacao-da-pobreza', now(), 'assets/images/ods/erradicacao-da-pobreza');\
INSERT INTO pdi_ods (titulo, slug, created_at, img) \
	VALUES ('Fome zero e agricultura sustentável', 'fome-zero-e-agricultura-sustentavel', now(), 'assets/images/ods/fome-zero-e-agricultura-sustentavel');\
INSERT INTO pdi_ods (titulo, slug, created_at, img) \
	VALUES ('Saúde e bem estar', 'saude-e-bem-estar', now(), 'assets/images/ods/saude-e-bem-estar');
INSERT INTO pdi_ods (titulo, slug, created_at, img) \
	VALUES ('Educação de qualidade', 'educacao-de-qualidade', now(), 'assets/images/ods/educacao-de-qualidade');\
INSERT INTO pdi_ods (titulo, slug, created_at, img) \
	VALUES ('Igualdade de gênero', 'igualdade-de-genero', now(), 'assets/images/ods/igualdade-de-genero');\
INSERT INTO pdi_ods (titulo, slug, created_at, img) \
	VALUES ('Água potável e saneamento', 'agua-potavel-e-saneamento', now(), 'assets/images/ods/agua-potavel-e-saneamento');\
INSERT INTO pdi_ods (titulo, slug, created_at, img) \
	VALUES ('Energia acessível e limpa', 'energia-acessivel-e-limpa', now(), 'assets/images/ods/energia-acessivel-e-limpa');\
INSERT INTO pdi_ods (titulo, slug, created_at, img) \
	VALUES ('Trabalho decente e crescimento econômico', 'trabalho-decente-e-crescimento-economico', now(), 'assets/images/ods/trabalho-decente-e-crescimento-economico');\
INSERT INTO pdi_ods (titulo, slug, created_at, img) \
	VALUES ('Indústria, inovação e infraestrutura', 'industria-inovacao-e-infraestrutura', now(), 'assets/images/ods/industria-inovacao-e-infraestrutura');\
INSERT INTO pdi_ods (titulo, slug, created_at, img) \
	VALUES ('Redução das desigualdades', 'reducao-das-desigualdades', now(), 'assets/images/ods/reducao-das-desigualdades');\
INSERT INTO pdi_ods (titulo, slug, created_at, img) \
	VALUES ('Cidades e comunidades sustentáveis', 'cidades-e-comunidades-sustentaveis', now(), 'assets/images/ods/cidades-e-comunidades-sustentaveis');\
INSERT INTO pdi_ods (titulo, slug, created_at, img) \
	VALUES ('Consumo de produção sustentável', 'consumo-de-producao-sustentavel', now(), 'assets/images/ods/consumo-de-producao-sustentavel');\
INSERT INTO pdi_ods (titulo, slug, created_at, img) \
	VALUES ('Ação contra a mudança global do clima', 'acao-contra-a-mudanca-global-do-clima', now(), 'assets/images/ods/acao-contra-a-mudanca-global-do-clima');\
INSERT INTO pdi_ods (titulo, slug, created_at, img) \
	VALUES ('Vida na água', 'vida-na-agua', now(), 'assets/images/ods/vida-na-agua');\
INSERT INTO pdi_ods (titulo, slug, created_at, img) \
	VALUES ('Vida terrestre', 'vida-terrestre', now(), 'assets/images/ods/vida-terrestre');\
INSERT INTO pdi_ods (titulo, slug, created_at, img) \
	VALUES ('Paz, justiça e instituições eficazes', 'paz-justica-e-instituicoes-eficazes', now(), 'assets/images/ods/paz-justica-e-instituicoes-eficazes');\
INSERT INTO pdi_ods (titulo, slug, created_at, img) \
	VALUES ('Parcerias e Meios de Implementação', 'parcerias-e-meios-de-implementacao', now(), 'assets/images/ods/parcerias-e-meios-de-implementacao');\

### `pne`
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('Educação Infantil', 'educacao-infantil', now());\
INSERT INTO pdi_pne (titulo, slug, created_at) 
	VALUES ('Ensino fundamental', 'ensino-fundamental', now());\
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('Ensino médio', 'ensino-medio', now());\
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('Educação especial/inclusiva', 'educacao-especial-inclusiva', now());\
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('Alfabetização', 'alfabetizacao', now());\
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('Educação integral', 'educacao-integral', now());\
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('Aprendizado adequado na idade certa', 'aprendizado-adequado-na-idade-certa', now());\
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('Escolaridade média', 'escolaridade-media', now());\
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('Alfabetização e alfabetismo funcional', 'alfabetizacao-e-alfabetismo-funcional', now());\
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('EJA integrada à Educação Profissional', 'eja-integrada-a-educacao-profissional', now());\
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('Educação profissional', 'educacao-profissional', now());\
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('Educação superior', 'educacao-superior', now());\
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('Titulação de professores da educação superior', 'titulacao-de-professores-da-educacao-superior', now());\
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('Pós-graduação', 'pos-graduacao', now());
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('Formação de professores', 'formacao-de-professores', now());\
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('Formação continuada e pós-graduação', 'formacao-continuada-e-pos-graduacao', now());\
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('Valorização do professor', 'valorizacao-do-professor', now());\
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('Plano de carreira docente', 'plano-de-carreira-docente', now());\
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('Gestão democrática', 'gestao-democratica', now());\
INSERT INTO pdi_pne (titulo, slug, created_at) \
	VALUES ('Financiamento da educação', 'financiamento-da-educacao', now());\

### `grande_tema`
INSERT INTO pdi_grande_tema (descricao, layout, created_at, updated_at) \
	VALUES ('Defesa da vida, da educação pública e da dignidade humana', '[\"#C4806E\",\"#A44B3A\"]', now(), now());\
INSERT INTO pdi_grande_tema (descricao, layout, created_at, updated_at) \
	VALUES ('Universidade plural, democrática e articulada com a sociedade', '[\"#D4D284\",\"#C9C12C\"]', now(), now());\
INSERT INTO pdi_grande_tema (descricao, layout, created_at, updated_at) \
	VALUES ('Ciência, educação e inovação com impacto social e em cooperação', '[\"#5D856E\",\"#215A36\"]', now(), now());\
INSERT INTO pdi_grande_tema (descricao, layout, created_at, updated_at) \
	VALUES ('Articulação pedagógica e multiunidades', '[\"#70809F\",\"#2E668C\"]', now(), now());\
INSERT INTO pdi_grande_tema (descricao, layout, created_at, updated_at) \
	VALUES ('Completar e consolidar a expansão', '[\"#768A88\",\"#5F726A\"]', now(), now());\

### `objetivos_ouse`

INSERT INTO pdi_objetivos_ouse(descricao, grande_tema_id, created_at, updated_at)\
	VALUES\
		('AMPLIAR A FORMAÇÃO DE PROFESSORES PARA A EDUCAÇÃO BÁSICA', 1, now(), now()),\
		('AMPLIAR A GOVERNANÇA PARTICIPATIVA', 2, now(), now()),\
		('AMPLIAR A INTERNACIONALIZAÇÃO SUL-SUL', 3, now(), now()),\
		('AMPLIAR A PRODUÇÃO E IMPACTO DA PESQUISA', 4, now(), now()),\
		('AMPLIAR AÇÕES AMBIENTAIS', 4, now(), now()),\
		('AMPLIAR COLABORAÇÕES EM TEMAS ESTRATÉGICOS', 3, now(), now()),\
		('AMPLIAR COLETA SELETIVA SOLIDÁRIA', 2, now(), now()),\
		('AMPLIAR ELOS COM MUNDO DO TRABALHO', 2, now(), now()),\
		('AMPLIAR ESTRUTURAS CONVERGENTES', 4, now(), now()),\
		('AMPLIAR INTERAÇÃO COM NOSSOS ENTORNOS', 2, now(), now()),\
		('AMPLIAR O DIÁLOGO E A ARTICULAÇÃO COM A SOCIEDADE', 2, now(), now()),\
		('AMPLIAR OS ACERVOS FÍSICOS E DIGITAIS DA REDE DE BIBLIOTECAS', 5, now(), now()),\
		('AMPLIAR PRODUÇÃO DE CONHECIMENTO COM ACESSO ABERTO', 3, now(), now()),\
		('AMPLIAR RELAÇÃO COM O SETOR PRODUTIVO', 3, now(), now()),\
		('AMPLIAR TROCAS ENTRE COMUNIDADES CIENTÍFICAS E TRADICIONAIS, SABERES POPULARES E MOVIMENTOS SOCIAIS', 2, now(), now()),\
		('APOIAR A PRODUÇÃO DE CONHECIMENTO NA ESCOLA PAULISTINHA DE EDUCAÇÃO', 3, now(), now()),\
		('APOIAR SOFTWARES LIVRES', 3, now(), now()),\
		('ATUAR EM ÁREAS VULNERÁVEIS COM AS ORGANIZAÇÕES LOCAIS', 1, now(), now()),\
		('ATUAR POR RECURSOS COMPLEMENTARES PARA OBRAS', 5, now(), now()),\
		('AUMENTAR A TAXA DE SUCESSO DA GRADUAÇÃO', 4, now(), now()),\
		('AUMENTAR A TAXA DE SUCESSO DA PÓS-GRADUAÇÃO', 4, now(), now()),\
		('COMPLETAR A EXPANSÃO CONFORME PLANEJADA E PACTUADA', 5, now(), now()),\
		('CONSOLIDAR OS OBSERVATÓRIOS COMO INSTRUMENTO DE CIDADANIA ATIVA', 2, now(), now()),\
		('CONSTRUIR METAS SOCIAIS PÚBLICAS', 2, now(), now()),\
		('DEMOCRATIZAR A EDUCAÇÃO EM SAÚDE', 1, now(), now()),\
		('DESENVOLVER PARCERIAS PARA PROJETOS COM IMPACTO SOCIAL', 2, now(), now()),\
		('ELABORAR E IMPLANTAR PLANOS AMBIENTAIS EM TODOS OS CAMPI', 5, now(), now()),\
		('ESTABELECER REDES COOPERATIVAS DE INOVAÇÃO COM IMPACTO SOCIAL', 3, now(), now()),\
		('ESTIMULAR CULTURA DE INOVAÇÃO NA UNIFESP', 3, now(), now()),\
		('ESTIMULAR PÓS-GRADUAÇÃO PROFISSIONAL COM IMPACTO SOCIAL', 3, now(), now()),\
		('FOMENTAR INTEGRAÇÃO MULTIUNIDADES PELA PÓS-GRADUAÇÃO E PESQUISA', 4, now(), now()),\
		('FOMENTAR PRÁTICAS COLABORATIVAS E DE INTERCÂMBIO MULTIUNIDADES', 4, now(), now()),\
		('FOMENTO À ECONOMIA SOLIDÁRIA NO ENTORNO DOS CAMPI', 3, now(), now()),\
		('FOMENTO À PÓS-GRADUAÇÃO E PESQUISA NOS CAMPI DE EXPANSÃO', 5, now(), now()),\
		('FORMAÇÃO DIRIGIDA A REDUZIR DESIGUALDADES', 1, now(), now()),\
		('FORMAÇÕES EM SAÚDE PARA TODOS', 1, now(), now()),\
		('FORTALECER A ATUAÇÃO NA EDUCAÇÃO PÚBLICA', 1, now(), now()),\
		('FORTALECER A ATUAÇÃO NO SUS', 1, now(), now()),\
		('FORTALECER A DEMOCRACIA DIGITAL NA UNIFESP', 2, now(), now()),\
		('FORTALECER AÇÕES DE PERMANÊNCIA ESTUDANTIL NA (PÓS-)PANDEMIA', 1, now(), now()),\
		('FORTALECER IMAGEM PÚBLICA DA UNIFESP', 2, now(), now()),\
		('FUNDAÇÃO DE APOIO FAP-SUSTENTÁVEL', 3, now(), now()),\
		('GARANTIR OS NAE EM TODOS OS CAMPI', 5, now(), now()),\
		('GARANTIR RESTAURANTE UNIVERSITÁRIO EM TODOS OS CAMPI', 5, now(), now()),\
		('GESTÃO COM PESSOAS E FORMAÇÃO DE SERVIDORES NA (PÓS-)PANDEMIA.', 1, now(), now()),\
		('IMPLEMENTAÇÃO PPI, DIRETRIZES A CONSIDERAR', 4, now(), now()),\
		('IMPLEMENTAÇÃO PPI, DIRETRIZES A INSTITUIR', 4, now(), now()),\
		('IMPLEMENTAÇÃO PPI, FORTALECER DIRETRIZES INSTITUÍDAS', 4, now(), now()),\
		('IMPLEMENTAR MORADIAS ESTUDANTIS', 5, now(), now()),\
		('MELHORAR CONTINUAMENTE AS INFRAESTRUTURAS', 5, now(), now()),\
		('MELHORAR O CONCEITO DE CURSO DA GRADUAÇÃO', 4, now(), now()),\
		('MELHORAR O CONCEITO DE CURSO DA PÓS-GRADUAÇÃO', 4, now(), now()),\
		('MODERNIZAR E INTEGRAR SISTEMAS DE TI', 4, now(), now()),\
		('MODERNIZAR INFRAESTRUTURA DE TI', 5, now(), now()),\
		('PLURALIZAR CURRICULOS', 2, now(), now()),\
		('POLÍTICA DE EQUIDADE NO DIMENSIONAMENTO DE SERVIDORES ENTRE OS CAMPI', 5, now(), now()),\
		('POPULARIZAR CONHECIMENTO PARA FORTALECER LAÇOS SOCIAIS', 2, now(), now()),\
		('POSSIBILITAR PERCURSOS FORMATIVOS', 4, now(), now()),\
		('PRODUZIR CONHECIMENTO EM DEFESA DA VIDA', 1, now(), now()),\
		('PROMOVER A CULTURA DE DIREITOS HUMANOS', 1, now(), now()),\
		('PROMOVER A EQUIDADE E O COMBATE AO RACISMO', 2, now(), now()),\
		('PROMOVER CONDIÇÕES DE PERMANÊNCIA ESTUDANTIL COM QUALIDADE', 4, now(), now()),\
		('PROMOVER FORMAÇÃO INTEGRAL EM CONTEXTOS COMPLEXOS', 4, now(), now()),\
		('PROMOVER FORMAÇÃO MULTIUNIDADES E INTERDISCIPLINAR DESDE A GRADUAÇÃO', 4, now(), now()),\
		('PROPICIAR INCLUSÃO COTIDIANA DA SOCIEDADE NAS NOSSAS ATIVIDADES', 2, now(), now()),\
		('REALIZAR OBRAS PLANEJADAS NOS CAMPI', 5, now(), now()),\
		('REVISÃO DE PPC EM ACORDO COM NOVO PPI E TEMAS CONVERGENTES', 4, now(), now()),\
		('SIMPLIFICAR PROCESSOS PARA COOPERAÇÕES INSTITUCIONAIS', 3, now(), now()),\
		('SISTEMAS UNIVERSITÁRIOS QUE FORTALEÇAM A EQUIDADE', 1, now(), now()),\
		('TECNOLOGIAS DE SAÚDE DIGITAL: Disseminar de forma crítica, reflexiva e analítica, as tecnologias de saúde digital síncronas e assíncronas', 3, now(), now()),\
		('UNIFESP CADA VEZ MAIS PLURAL E INCLUSIVA', 2, now(), now()),\
		('VALORAÇÃO ACADÊMICA RECONHECENDO DIFERENÇAS ENTRE ÁREAS', 3, now(), now());\
