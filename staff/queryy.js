$(document).ready(function () {
    $("#courseType").on('change', function () {
        var courId = $(this).val();
        $.ajax({
            method: "POST",
            url: "dropdown.php",
            data: { id: courId },
            dataType: "html",
            success: function (data) {
                $("#courseName").html(data);
            }
        });
    });

    $("#courseName").on('change', function () {
        var courseName = $(this).val();
        $.ajax({
            method: "POST",
            url: "dropdown.php",
            data: { name: courseName },
            dataType: "html",
            success: function (data) {
                $("#courseFee").html(data);
            }
        });
    });

    $("#payMeth").on('change', function () {
        var payMeth = $(this).val();
        $.ajax({
            method: "POST",
            url: "dropdown.php",
            data: { meth: payMeth },
            dataType: "html",
            success: function (data) {
                $("#tranId").html(data);
            }
        });
    });
});