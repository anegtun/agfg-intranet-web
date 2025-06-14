<?php
$this->extend('template');

// Hack para que o datepicker non a líe formateando a data (alterna dia/mes). Asi forzamos o noso formato.
$data_str = empty($evento->data) ? NULL : $evento->data->format('d-m-Y');

$this->set('submenu_option', 'eventos');
$this->set('cabeceiraTitulo', empty($evento->id) ? 'Novo evento' : $evento->nome);
$this->set('cabeceiraMigas', [
    ['label'=>'Calendario'],
    ['label'=>'Eventos', 'url'=>['action'=>'eventos']],
    ['label'=>empty($evento->id) ? 'Novo evento' : $evento->nome]
]);

$emptyTemplates = [
    'inputContainer' => '{{content}}',
    'input' => '<input type="{{type}}" name="{{name}}" {{attrs}}/>',
];
?>

<?= $this->Form->create($evento, ['type'=>'post', 'url'=>['action'=>'gardarEvento']]) ?>
    <?= $this->Form->hidden('id') ?>
    <fieldset>
        <legend>Evento</legend>

        <div class="row">
            <div class="form-group col-lg-3">
                <?= $this->Form->control('nome', ['label'=>'Nome']) ?>
            </div>
            <div class="form-group col-lg-3">
                <?= $this->Form->control('data', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data', 'value'=>$data_str, 'templates'=>$emptyTemplates]) ?>
            </div>
            <div class="form-group col-lg-3">
                <?= $this->Form->control('lugar', ['label'=>'Lugar']) ?>
            </div>
            <div class="form-group col-lg-3">
                <?= $this->Form->control('tipo', ['options'=>$tipos, 'label'=>'Tipo', 'templates'=>$emptyTemplates]) ?>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-12">
                <?= $this->Form->control('imaxe', ['label'=>'Imaxe']) ?>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-12">
                <?= $this->Form->control('resumo', ['label'=>'Resumo']) ?>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-12">
                <?= $this->Form->control('observacions', ['label'=>'Observacións']) ?>
            </div>
        </div>

        <?= $this->Form->button('Gardar', ['class'=>'btn btn-primary glyphicon glyphicon-saved']); ?>
    </fieldset>
<?= $this->Form->end() ?>



<?php if(!empty($evento->id)) : ?>
    <div class="row" style="margin-top:2em;">
        <h3>Outras datas</h3>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th class="celda-titulo">Data inicio</th>
                    <th class="celda-titulo">Data fin</th>
                    <th class="celda-titulo"></th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($evento->datas)) : ?>
                    <?php foreach($evento->datas as $d) : ?>
                        <tr>
                            <td><?= $d->data_ini->format('Y-m-d') ?></td>
                            <td><?= $d->data_fin->format('Y-m-d') ?></td>
                            <td class="text-center"><?= $this->AgfgForm->deleteButton(['action'=>'borrarEventoData', $d->id]) ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            <tbody>
        </table>

        <?= $this->Form->create($evento, ['type'=>'post', 'url'=>['action'=>'engadirEventoData']]) ?>
            <?php echo $this->Form->input('id', ['type'=>'hidden', 'value'=>$evento->id]) ?>
            <div class="row">
                <div class="form-group col-lg-3">
                    <?= $this->Form->control('data_ini', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data inicio', 'templates'=>$emptyTemplates]) ?>
                </div>
                <div class="form-group col-lg-3">
                    <?= $this->Form->control('data_fin', ['type'=>'text', 'class'=>'form-control fld-date', 'label'=>'Data fin', 'templates'=>$emptyTemplates]) ?>
                </div>
            </div>
            <?= $this->Form->button('Gardar', ['class'=>'btn btn-default glyphicon glyphicon-upload']); ?>
        <?= $this->Form->end() ?>
    </div>
<?php endif ?>


<script type="module">
    import {
        ClassicEditor,
        Essentials,
        Paragraph,
        Bold,
        Italic,
        Font,
        List,
        Alignment,
        AutoLink,
        Link,
        Image,
        ImageResizeEditing,
        ImageResizeHandles,
        ImageInsert
    } from 'ckeditor5';

    ClassicEditor
        .create(document.querySelector('#observacions'), {
            licenseKey: 'GPL',
            plugins: [ Essentials, Paragraph, Bold, Italic, List, Alignment, AutoLink, Link, Image, ImageResizeEditing, ImageResizeHandles, ImageInsert ],
            toolbar: [ 'bold', 'italic', '|', 'alignment', '|', 'bulletedList', 'numberedList', '|', 'link', 'insertImage' ]
        })
        .then(newEditor => window.editor = newEditor)
        .catch(error => console.error(error));

    ClassicEditor
        .create(document.querySelector('#resumo'), {
            licenseKey: 'GPL',
            plugins: [ Essentials, Paragraph, Bold, Italic, List, Alignment, AutoLink, Link, Image, ImageResizeEditing, ImageResizeHandles, ImageInsert ],
            toolbar: [ 'bold', 'italic', '|', 'alignment', '|', 'bulletedList', 'numberedList', '|', 'link', 'insertImage' ]
        })
        .then(newEditor => window.editor = newEditor)
        .catch(error => console.error(error));
</script>