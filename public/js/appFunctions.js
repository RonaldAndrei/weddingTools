    //login
    function mostraInputName() {
        var password = document.getElementById("password");

        if(password.value == "sudo"){
            $("#nameDiv").collapse("show");
        } else {
            $("#nameDiv").collapse("hide");
        }
    };

    //menu lateral
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    function showMenuLateral() {
        if ($('#sideBarLeft').css('display') == 'none') {

            $('#sideBarLeft').show();
        } else {

            $('#sideBarLeft').hide();
        }
    };

    //usuarios
    function userExcluir(id, csrf_token) {
        $.post(
            "/user/delete", 
            {
                id: id,
                _token: csrf_token
            }, 
            function(result){
                location.reload();
            }
        );
    };

    function preenchePassword() {
        var password = document.getElementById("family");
        $("#password").val(password.value);
        $("#password-confirm").val(password.value);
    };

    //convidados
    function convidadoExcluir(id, csrf_token) {
        $.post(
            "/convidado/delete", 
            {
                id: id,
                _token: csrf_token
            }, 
            function(result){
                location.reload();
            }
        );
    };

    function convidadoPresente(id, csrf_token) {
        $.post(
            "/convidado/presente", 
            {
                id: id,
                _token: csrf_token
            }, 
            function(result){
                $("#convidadoPresencaModal").modal({show: true});
            }
        );
    };

    function convidadoAusente(id, csrf_token) {
        $.post(
            "/convidado/ausente", 
            {
                id: id,
                _token: csrf_token
            }, 
            function(result){
                $("#convidadoAusenciaModal").modal({show: true});
            }
        );
    };

    //truco
    function duplaTrucoExcluir(id, idParticipante1, idParticipante2, csrf_token) {
        $.post(
            "/truco/delete", 
            {
                id: id,
                idParticipante1: idParticipante1,
                idParticipante2: idParticipante2,
                _token: csrf_token
            }, 
            function(result){
                location.reload();
            }
        );
    };

    //informacoes
    function mostraInforCerimonia() {
        if($("#infoCerimonia").css('display') == 'none') {
            $("#abaCerimonia").addClass('active');
            $("#abaCerimonia").css('font-weight', 'bold');
            $("#infoCerimonia").show();

            $("#abaChurrasco").removeClass('active');
            $("#abaChurrasco").css('font-weight', 'normal');
            $("#infoChurrasco").hide();
        }
    };

    function mostraInforChurrasco() {
        if($("#infoChurrasco").css('display') == 'none') {
            $("#abaChurrasco").addClass('active');
            $("#abaChurrasco").css('font-weight', 'bold');
            $("#infoChurrasco").show();

            $("#abaCerimonia").removeClass('active');
            $("#abaCerimonia").css('font-weight', 'normal');
            $("#infoCerimonia").hide();
        }
    };

    //busca nas tabelas
    function tableSearch(input, table, coluna) {
        
        var inputValue, filter, tableValue, item, i, txtValue;
        
        inputValue = document.getElementById(input);
        filter = inputValue.value.toUpperCase();
        tableValue = document.getElementById(table);
        item = tableValue.getElementsByTagName('tr');

        for (i = 0; i < item.length; ++i) {
            txtValue = item[i].cells;
            txtValue = txtValue[coluna].innerText;

            if (item[i].cells[0].tagName == 'TD') {
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    item[i].style.display = "";
                } else {
                    item[i].style.display = "none";
                }
            }
        }
    };

    //busca nas divs
    function divSearch(input, div) {
        
        var inputValue, filter, divValue, item, i, txtValue;
        
        inputValue = document.getElementById(input);
        filter = inputValue.value.toUpperCase();
        divValue = document.getElementById(div);
        item = divValue.children;

        for (i = 0; i < item.length; ++i) {
            txtValue = item[i].innerText;
            if (item[i].tagName == 'DIV') {
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    item[i].style.display = "";
                } else {
                    item[i].style.display = "none";
                }
            }
        }
    };