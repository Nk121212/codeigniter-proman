//datetimepicker schedule
// fungsi auto count hours dan durasi project name
        //=========================================================================== Start
        $('input[name="psc"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });    

        $('input[name="psc"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY')).trigger('change');

            var awal = picker.startDate.format('YYYY-MM-DD 00:00:00');
            var akhir = picker.endDate.format('YYYY-MM-DD 23:59:59');

            $('#psc_awal').val(awal);
            $('#psc_akhir').val(akhir);

            var date1 = new Date(awal);
            var date2 = new Date(akhir);
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); //hari
            var diffHours = Math.ceil(timeDiff / (1000 * 3600)); //jam
            //alert("Days :"+diffDays+"Hours :"+diffHours+"");

            $("#phours").val(diffHours).trigger('change');
            $("#pdurations").val(diffDays).trigger('change');

        });
        $('input[name="psc"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');        
        });  
        //=============================================================================== Finish

        //=========================================================================== Start
        $('input[name="ppres"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });    

        $('input[name="ppres"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

            var awal = picker.startDate.format('YYYY-MM-DD 00:00:00');
            var akhir = picker.endDate.format('YYYY-MM-DD 23:59:59');

            $('#ppres_awal').val(awal);
            $('#ppres_akhir').val(akhir);
        });
        $('input[name="ppres"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');        
        });  
        //=============================================================================== Finish

        //=========================================================================== Start
        $('input[name="psig"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });    

        $('input[name="psig"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

            var awal = picker.startDate.format('YYYY-MM-DD 00:00:00');
            var akhir = picker.endDate.format('YYYY-MM-DD 23:59:59');

            $('#psig_awal').val(awal);
            $('#psig_akhir').val(akhir);
        });
        $('input[name="psig"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');        
        });  
        //=============================================================================== Finish

        // fungsi auto count hours dan durasi task name
        //=========================================================================== Start
        $('input[name="tsc"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });    

        $('input[name="tsc"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY')).trigger('change');

            var awal = picker.startDate.format('YYYY-MM-DD 00:00:00');
            var akhir = picker.endDate.format('YYYY-MM-DD 23:59:59');

            $('#tsc_awal').val(awal);
            $('#tsc_akhir').val(akhir);

            var date1 = new Date(awal);
            var date2 = new Date(akhir);
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); //hari
            var diffHours = Math.ceil(timeDiff / (1000 * 3600)); //jam
            //alert("Days :"+diffDays+"Hours :"+diffHours+"");

            $("#thours").val(diffHours).trigger('change');
            $("#tdurations").val(diffDays).trigger('change');

        });
        $('input[name="tsc"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');        
        });  

        //=============================================================================== Finish

        $('input[name="modal_sch"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });   

        $('input[name="modal_sch"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY')).trigger("change");

            var awal = picker.startDate.format('YYYY-MM-DD 00:00:00');
            var akhir = picker.endDate.format('YYYY-MM-DD 23:59:59');

            $('#vs_modal_sch').val(awal);
            $('#ve_modal_sch').val(akhir);

            var date1 = new Date(awal);
            var date2 = new Date(akhir);
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); //hari
            var diffHours = Math.ceil(timeDiff / (1000 * 3600)); //jam
            //alert("Days :"+diffDays+"Hours :"+diffHours+"");

            $("#act_work").val(diffHours).trigger('change');
            $("#act_duration").val(diffDays).trigger('change');

        });
        $('input[name="modal_sch"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');        
        });  

        //=============================================================================== Finish

        

        