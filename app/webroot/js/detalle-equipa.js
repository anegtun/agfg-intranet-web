$(document).ready(function() {
    const clubesAmalgamas = $('#clubes-amalgamas-container');
    const selectorAmalgama = $('#amalgama');

    function actualizarVisibilidadeClubesAmalgama() {
        clubesAmalgamas.toggle(selectorAmalgama.is(':checked'));
    }

    selectorAmalgama.on('change', actualizarVisibilidadeClubesAmalgama);
    actualizarVisibilidadeClubesAmalgama();
});
