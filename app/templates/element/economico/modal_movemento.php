<div id="<?= $id ?>" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= $titulo ?></h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="celda-titulo text-center">Data</th>
                                <th class="celda-titulo text-center">Importe</th>
                                <th class="celda-titulo text-center">Comisión</th>
                                <th class="celda-titulo text-center">Subarea</th>
                                <th class="celda-titulo text-center">Tempada</th>
                                <th class="celda-titulo text-center">Observacións</th>
                                <th class="celda-titulo text-center">Referencia</th>
                                <th class="celda-titulo"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($movementos as $m) : ?>
                                <tr>
                                    <td class="text-center"><?= $m->data->format('Y-m-d') ?></td>
                                    <td class="text-right <?= $m->importe<0 ? 'text-danger' : ''?>"><?= $this->Number->currency($m->importe, 'EUR') ?></td>
                                    <td class="text-right <?= $m->comision<0 ? 'text-danger' : ''?>"><?= empty($m->comision) ? '' : $this->Number->currency($m->comision, 'EUR') ?></td>
                                    <td class="text-center"><?= $m->subarea->nome ?></td>
                                    <td class="text-center"><?= $tempadas[$m->tempada] ?></td>
                                    <td><?= $m->descricion ?></td>
                                    <td><?= $m->referencia ?></td>
                                    <td class="text-center"><?= $this->AgfgForm->editButton(['controller'=>'Economico', 'action'=>'detalleMovemento', $m->id]) ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>