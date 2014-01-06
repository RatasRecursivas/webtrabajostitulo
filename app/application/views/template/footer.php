<!-- Footer -->

<footer class="row">
    <div class="large-12 columns">
        <hr>
        <div class="row">
            <div class="large-6 columns">
                <p>Copyright Las Ratas Recursivas 2013</p>
            </div>
        </div>
    </div>
</footer>

<script src="<?= base_url() . '/js/vendor/jquery.js'; ?>"></script>
<script src="<?= base_url() . '/js/vendor/fastclick.js'; ?>"></script>
<script src="<?= base_url() . '/js/foundation.min.js'; ?>"></script>
<script src="<?= base_url() . '/js/vendor/pickadate/picker.js'; ?>"></script>
<script src="<?= base_url() . '/js/vendor/pickadate/picker.date.js'; ?>"></script>
<script src="<?= base_url() . '/js/vendor/pickadate/picker.time.js'; ?>"></script>
<script src="<?= base_url() . '/js/vendor/pickadate/legacy.js'; ?>"></script>
<script src="<?= base_url() . '/js/vendor/pickadate/main.js'; ?>"></script>
<script> $(document).foundation();</script>
<script type="text/javascript">
    $('.input_date').pickadate({
        monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        weekdaysShort: ['do', 'lun', 'mar', 'mié', 'jue', 'vie', 'sab'],
        today: '',
        clear: 'borrar',
        firstDay: 1,
        format: 'dd !de mmmm !de yyyy',
        formatSubmit: 'yyyy-mm-dd',
        hiddenSuffix: '_putrido'}
    );
    $('.input_time').pickatime({
        format: 'HH:i:00 ',
        editable: true,
        interval: 60,
        min: [8, 00],
        max: [17, 0]

    });

</script>
</body>
</html>

