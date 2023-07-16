$(document).ready(function() {

    const modalXornada = $('#modalXornada');
    const modalPartido = $('#modalPartido');

    $('#modal-xornada-button').click(function() {
        modalXornada.find('form')[0].reset();
        modalXornada.find('[name=id]').val('');
        modalXornada.find('[name=data_xornada]').val('');
        modalXornada.find('[name=numero]').val('');
        modalXornada.find('[name=descricion]').val('');
        modalXornada.modal("show");
    });

    $('a[data-xornada-id]').click(function(e) {
        e.preventDefault();
        modalXornada.find('[name=id]').val($(this).attr('data-xornada-id'));
        modalXornada.find('[name=data_xornada]').val($(this).attr('data-xornada-data'));
        modalXornada.find('[name=numero]').val($(this).attr('data-xornada-numero'));
        modalXornada.find('[name=descricion]').val($(this).attr('data-xornada-descricion'));
        modalXornada.modal("show");
    });

    $('#modal-partido-button').click(function() {
        modalPartido.find('form')[0].reset();
        modalPartido.find('[name=id]').val('');
        modalPartido.find('[name=id_xornada]').val('');
        modalPartido.find('[name=id_equipa1]').val('');
        modalPartido.find('[name=id_equipa2]').val('');
        modalPartido.find('[name=data_partido]').val('');
        modalPartido.find('[name=hora_partido]').val('');
        modalPartido.modal("show");
    });

    $('a[data-partido-id]').click(function(e) {
        e.preventDefault();
        modalPartido.find('[name="id"]').val($(this).attr('data-partido-id'));
        modalPartido.find('[name=id_xornada]').val($(this).attr('data-partido-id-xornada'));
        modalPartido.find('[name=id_equipa1]').val($(this).attr('data-partido-id-equipo1'));
        modalPartido.find('[name=id_equipa2]').val($(this).attr('data-partido-id-equipo2'));
        modalPartido.find('[name=data_partido]').val($(this).attr('data-partido-data'));
        modalPartido.find('[name=hora_partido]').val($(this).attr('data-partido-hora'));
        modalPartido.modal("show");
    });
});