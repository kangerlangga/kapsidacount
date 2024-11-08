<!--   Core JS Files   -->
<script src="{{  url('') }}/assets/admin/js/core/jquery.3.2.1.min.js"></script>
<script src="{{  url('') }}/assets/admin/js/core/popper.min.js"></script>
<script src="{{  url('') }}/assets/admin/js/core/bootstrap.min.js"></script>

<!-- jQuery UI -->
<script src="{{  url('') }}/assets/admin/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="{{  url('') }}/assets/admin/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="{{  url('') }}/assets/admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


<!-- Chart JS -->
<script src="{{  url('') }}/assets/admin/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="{{  url('') }}/assets/admin/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="{{  url('') }}/assets/admin/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="{{  url('') }}/assets/admin/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="{{  url('') }}/assets/admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="{{  url('') }}/assets/admin/js/plugin/jqvmap/jquery.vmap.min.js"></script>
<script src="{{  url('') }}/assets/admin/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

<!-- Atlantis JS -->
<script src="{{  url('') }}/assets/admin/js/atlantis.min.js"></script>

<!-- Atlantis DEMO methods, don't include it in your project! -->
{{-- <script src="{{  url('') }}/assets/admin/js/setting-demo.js"></script>
<script src="{{  url('') }}/assets/admin/js/demo.js"></script> --}}
<script>
    Circles.create({
        id:'circles-1',
        radius:45,
        value:60,
        maxValue:100,
        width:7,
        text: 5,
        colors:['#f1f1f1', '#FF9E27'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    Circles.create({
        id:'circles-2',
        radius:45,
        value:70,
        maxValue:100,
        width:7,
        text: 36,
        colors:['#f1f1f1', '#2BB930'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    Circles.create({
        id:'circles-3',
        radius:45,
        value:40,
        maxValue:100,
        width:7,
        text: 12,
        colors:['#f1f1f1', '#F25961'],
        duration:400,
        wrpClass:'circles-wrp',
        textClass:'circles-text',
        styleWrapper:true,
        styleText:true
    })

    $('#lineChart').sparkline([105,103,123,100,95,105,115], {
        type: 'line',
        height: '70',
        width: '100%',
        lineWidth: '2',
        lineColor: '#ffa534',
        fillColor: 'rgba(255, 165, 52, .14)'
    });
</script>
