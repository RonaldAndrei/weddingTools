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
    function userExcluir(id) {
        alert(id);
    };

    function preenchePassword() {
        var password = document.getElementById("family");
        $("#password").val(password.value);
        $("#password-confirm").val(password.value);
    };