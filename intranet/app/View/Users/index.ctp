<?php $this->extend('/Users/template') ?>

<table class="table table-striped table-bordered table-hover">
	<tr>
		<th>Usuario</th>
		<th>Nome</th>
		<th>Rol</th>
		<th>Creado</th>
		<th></th>
		<th></th>
	</tr>
	<?php foreach($users as $u) : ?>
		<tr>
			<td><?php echo $u['User']['username'] ?></td>
			<td><?php echo $u['User']['name'] ?></td>
			<td><?php echo $u['User']['role'] ?></td>
			<td><?php echo $u['User']['created'] ?></td>
			<td><?php echo $this->Html->link('Editar', array('controller'=>'Users', 'action'=>'edit', $u['User']['id'])) ?></td>
			<td><?php echo $this->Html->link('Eliminar', array('controller'=>'Users', 'action'=>'delete', $u['User']['id'])) ?></td>
		</tr>
	<?php endforeach ?>
</table>

<?php echo $this->Html->link('Crear', array('controller'=>'Users', 'action'=>'add'), array('class'=>'btn-primary')) ?>
