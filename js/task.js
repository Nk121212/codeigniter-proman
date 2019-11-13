$("#tunit").change(function(){
    var other = $("#tunit").val();
    if(other == ''){
        $("#unit_hide").show();
        $("#tunit2").focus();                
    }else{
    	$("#tunit2").val('');
        $("#unit_hide").hide();                
    }   
})

function res_cek(){
    var a = $("#tresource").val();
    //alert(a);
    if(a == '1'){

        //alert("internal");
        $(".r_hide1").show();
        $(".r_hide2").hide();
        $("#r_ext").val('');
        //$(".r_ext").val('');

    }else if(a == '2'){

        //alert("external");
        $(".r_hide2").show();
        $(".r_hide1").hide();
        $("#r_int").val('');
        //$(".r_int").val('');

    }else if(a == '1,2'){

        //alert("internal dan external");
        $(".r_hide1").show();
        $(".r_hide2").show();

    }else{

        $(".r_hide1").hide();
        $(".r_hide2").hide();
        $("#r_int").val('');
        $("#r_ext").val('');
        //$(".r_int").val('');
        //$(".r_ext").val('');
    }
}

function budget_cek(){
    var a = $("#tbudget").val();
    if(a == '1'){
        //alert("internal");
        $(".b_hide1").show();
        $(".b_hide2").hide();
        $(".b_hide3").hide();

        $("#be_est").val('');
        $("#be_eai").val('');
        $("#bm_emq").val('');
        $("#bm_ems").val('');
        $("#bm_emv").val('');

    }else if(a == '2'){
        $(".b_hide1").hide();
        $(".b_hide2").show();
        $(".b_hide3").hide();

        $("#bi_etw").val('');
        $("#bi_ehw").val('');
        $("#bm_emq").val('');
        $("#bm_ems").val('');
        $("#bm_emv").val('');
        //alert("external");
    }else if(a == '3'){
        $(".b_hide1").hide();
        $(".b_hide2").hide();
        $(".b_hide3").show();

        $("#bi_etw").val('');
        $("#bi_ehw").val('');
        $("#be_est").val('');
        $("#be_eai").val('');
        //alert("material req");
    }else if(a == '1,2'){
        $(".b_hide1").show();
        $(".b_hide2").show();
        $(".b_hide3").hide();

        $("#bm_emq").val('');
        $("#bm_ems").val('');
        $("#bm_emv").val('');
        //alert("internal dan external");
    }else if(a == '1,3'){
        $(".b_hide1").show();
        $(".b_hide2").hide();
        $(".b_hide3").show();

        $("#be_est").val('');
        $("#be_eai").val('');
        
        //alert("internal dan material req");
    }else if(a == '2,3'){
        $(".b_hide1").hide();
        $(".b_hide2").show();
        $(".b_hide3").show();

        $("#bi_etw").val('');
        $("#bi_ehw").val('');
        //alert("external dan material req");
    }else if(a == '1,2,3'){
        $(".b_hide1").show();
        $(".b_hide2").show();
        $(".b_hide3").show();
        //alert("internal, external, dan material req");
    }else{
        $(".b_hide1").hide();
        $(".b_hide2").hide();
        $(".b_hide3").hide();

        $("#be_est").val('');
        $("#be_eai").val('');
        $("#bm_emq").val('');
        $("#bm_ems").val('');
        $("#bm_emv").val('');
        $("#bi_etw").val('');
        $("#bi_ehw").val('');
    }
}