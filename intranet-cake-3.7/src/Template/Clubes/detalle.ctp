<?php $this->extend('template') ?>

<div class="users form">
    <?= $this->Form->create($clube, ['url'=>['action'=>'gardar']]) ?>
        <?= $this->Form->hidden('id') ?>
        <fieldset>
            <legend><?= __('Clube') ?></legend>
            <?= $this->Form->input('nome') ?>
        </fieldset>
    <?= $this->Form->button(__('Enviar'), ['class'=>'btn btn-primary']); ?>
    <?= $this->Form->end() ?>
</div>

<?php if(!empty($clube->id)) : ?>
	<h3>Equipas</h3>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>Código</th>
				<th>Nome</th>
				<th>Logo</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($equipas as $e) : ?>
				<tr>
					<td><?= $e->codigo ?></td>
					<td><?= $e->nome ?></td>
		            <td><?= empty($e->logo) ? '' : $this->Html->image($e->logo, ['width'=>30,'height'=>30]) ?></td>
		            <td><?= $this->Html->link(__('Editar'), ['action'=>'detalleEquipa', $e->id_clube, $e->id]) ?></td>
		            <td><?= $this->Html->link(__('Eliminar'), ['action'=>'borrarEquipa', $e->id]) ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<?= $this->Html->link(__('Crear'), array('action'=>'detalleEquipa', $clube->id), array('class'=>'btn btn-primary')) ?>
<?php endif?>