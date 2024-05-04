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
        if (nbAteliers > 5) {
            $(".ateliers-ckc").each(function () {
                $(this).removeAttr('checked');
                $("#max-ateliers").css('color', 'red');

            });
        }
        $(this).removeAttr('checked');
    });


//    $("#form-creation-vacation").submit(function (event) {
//
//        $("#erreur-date").remove();
//
//        let dateDebut = new Date($("#form_dateheuredebut").val());
//        let dateFin = new Date($("#form_dateheurefin").val());
//
//        let jourDebut = dateDebut.toISOString().slice(0, 10);
//        let jourFin = dateFin.toISOString().slice(0, 10);
//
//        console.log(jourDebut + "   " + jourFin );
//        
//        if (jourDebut !== jourFin) {
//            event.preventDefault();
//            $("#erreur-date").remove();
//            $("#form").append(`<div id="erreur-date" style="color:red;">Le jour de début doit être égal au jour de fin.</div>`);
//        }
//        if (dateFin < dateDebut) {
//            event.preventDefault();
//            $("#erreur-date").remove();
//            $("#form").append(`<div id="erreur-date" style="color:red;">La date de début doit être antérieure à la date de fin.</div>`);
//        }
//        else if (dateFin === dateDebut){
//            event.preventDefault();
//            $("#erreur-date").remove();
//            $("#form").append(`<div id="erreur-date" style="color:red;">La vacation ne peut pas avoir une durée nulle.</div>`);
//            
//        }
//
//    });

});


