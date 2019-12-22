    // menu lateral

    function mostraInputName() {
        var password = document.getElementById("password");

        if(password.value == "sudo"){
            $("#name").show();
        } else {
            $("#name").hide();
        }
    };

    function showMenuLateral() {
        if ($('#sideBarLeft').css('display') == 'none') {

            $('#sideBarLeft').show();

            $('#userNewForm').removeClass('col-md-offset-3');
            $('#userNewForm').addClass('col-md-offset-1');

            $('#infoPanel').removeClass('col-md-10');
            $('#infoPanel').addClass('col-md-8');
        } else {

            $('#sideBarLeft').hide();

            $('#userNewForm').removeClass('col-md-offset-1');
            $('#userNewForm').addClass('col-md-offset-3');

            $('#infoPanel').removeClass('col-md-8');
            $('#infoPanel').addClass('col-md-10');
        }
    };

    function userExcluir(id) {
        alert(id);
    };