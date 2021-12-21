<?php
defined('ABSPATH') or die('No script kiddies please!');
$indicador = $variaveis;

if ($indicador->acoes) {
	$ordernar = classificar_acoes_por_eixo($indicador->acoes);
	$ordernar = classificar_por_objetivo_especifico($ordernar);
}

$i = 0;
?>
<nav>
	<ul class="nav nav-tabs nav-tabs-eixos" id="nav-tab" role="tablist">
		<?php if ($ordernar) : ?>
			<?php foreach ($ordernar as $eixo => $ordernar__) : ?>
				<li class="nav-item">
					<a class="nav-link <?php echo ($i == 0) ? 'active' : '' ?>" id="nav-eixo<?php echo $eixo ?>-tab" data-toggle="tab" href="#nav-eixo<?php echo $eixo ?>" role="tab" aria-controls="nav-eixo<?php echo $eixo ?>" aria-selected="<?php echo ($i == 0) ? 'true' : 'false' ?>">Eixo <?php echo $eixo ?></a>
				</li>
				<?php $i++; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</ul>
</nav>
<div class="tab-content" id="nav-tabEixos">
	<?php if ($ordernar) : ?>
		<?php $y == 0; ?>
		<?php foreach ($ordernar as $eixo => $ordernar__) : ?>
			<div class="tab-pane fade <?php echo ($y == 0) ? 'show active' : '' ?>" id="nav-eixo<?php echo $eixo ?>" role="tabpanel" aria-labelledby="nav-eixo<?php echo $eixo ?>-tab">
				<?php foreach ($ordernar__ as $key => $value) : ?>
					<div class="nav-labels">
						Objetivos Específicos
					</div>
					<div class="nav-texts">
						<?php $obj = pdi_get_objetivo_especifico(['id' => intval($key)]) ?>
						<?php echo $obj[0]->descricao ?>
					</div>
					<table class="table-acoes">
						<thead>
							<tr>
								<th>Ação</th>
								<th>Ator Envolvido</th>
								<?php foreach ($indicador->indicadores_anos as $anos) : ?>
									<th class="tb-anos"><?php echo $anos->ano ?></th>
								<?php endforeach; ?>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($value as $acao) : ?>
								<?php $ator = pdi_get_atores(['id' => $acao->ator]) ?>
								<tr>
									<td class="td-acao"><?php echo $acao->descricao_acao ?></td>
									<td><?php echo $ator[0]->descricao ?></td>
									<?php foreach ($indicador->indicadores_anos as $anos) : ?>
										<td class="tb-anos"><?php echo ($acao->ano_acao == $anos->ano) ? $acao->percentual_cumprido . '%' : '-' ?></td>
									<?php endforeach; ?>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				<?php endforeach; ?>
			</div>
			<?php $y++; ?>
		<?php endforeach; ?>
	<?php endif; ?>
</div>