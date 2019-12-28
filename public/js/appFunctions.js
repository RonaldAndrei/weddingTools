    //login
    function mostraInputName() {
        var password = document.getElementById("password");

        if(password.value == "sudo"){
            $("#name").show();
        } else {
            $("#name").hide();
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
                location.reload();
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
                location.reload();
            }
        );
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
    }