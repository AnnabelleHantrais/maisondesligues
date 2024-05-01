$(document).ready(function () {
    $("#success-alert").hide();
    $("#myWish").click(function showAlert() {
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function () {
            $("#success-alert").slideUp(500);
        });
    });

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


