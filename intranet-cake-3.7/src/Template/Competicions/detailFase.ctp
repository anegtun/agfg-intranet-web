<?php $this->extend('template') ?>

<div class="users form">
    <?= $this->Form->create($fase, array('url'=>array('action'=>'saveFase'))) ?>
        <?= $this->Form->hidden('id') ?>
        <fieldset>
            <legend><?= __('Fase') ?></legend>
            <?= $this->Form->input('nome') ?>
            <?= $this->Form->input('tipo') ?>
        </fieldset>
    <?= $this->Form->button(__('Enviar'), array('class'=>'btn btn-primary')); ?>
    <?= $this->Form->end() ?>
</div>

<?php if(!empty($fase)) : ?>
    <table class="table table-striped table-bordered table-hover">
        <tr>
            <th>Data</th>
            <th>Equipo 1</th>
            <th>Equipo 2</th>
        </tr>
        <?php foreach($fase->partidos as $p) : ?>
            <tr>
                <td><?= $p->data_partido ?></td>
                <td><?= $p->id_equipo1 ?></td>
                <td><?= $p->id_equipo2 ?></td>
            </tr>
        <?php endforeach ?>
    </table>

<?php endif ?>