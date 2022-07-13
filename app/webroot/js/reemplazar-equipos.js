$(document).ready(function() {

    $('#id-orixinal').change(function() {
        const id = $(this).val();
        $('.agfg-partido').hide();
        if(id) {
            $('.agfg-partido[data-equipa1='+id+']').show();
            $('.agfg-partido[data-equipa2='+id+']').show();
            $('.agfg-partido[data-umpire='+id+']').show();
        }
    }).change();

});