$(document).ready(function () {
    $("#alert-success").hide();
    $("#alert-danger").hide();

    $("#alert-success").fadeTo(2000, 500).slideUp(500, function () {
        $("#alert-success").slideUp(500);
    });

    $("#alert-danger").fadeTo(2000, 500).slideUp(500, function () {
        $("#alert-danger").slideUp(500); 
    });


    //verifier que plus de 5 ateliers ne sont pas choisis 
    /**
     * @TODO: paramétrer le nb d'ateliers en fonction du nombre de vacations distinctes
     */
    $(".ateliers-ckc").on('change', function () {
        let nbAteliers = 0;

        $(".ateliers-ckc:checked").each(function () {
            nbAteliers += 1;
        });
        console.log(nbAteliers);
        if (nbAteliers > 5) {
            $(".ateliers-ckc").each(function () {
                $(this).removeAttr('checked');
                $("#max-ateliers").css('color', 'red');

            });

        }
        $(this).removeAttr('checked');
    });




});


