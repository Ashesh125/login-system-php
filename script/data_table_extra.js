$(document).ready(function() {
    $(".buttons-print").addClass("btn btn-secondary ms-2 my-2");
    $(".buttons-pdf").addClass("btn btn-secondary my-2");

    $('#btn-1').on("click", function() {
        $('#id').val("0");
        $('#name').val("");
        $('#price').val("");
        $('#discount').val("0");
        $('#qty').val("");

        $('#age').val("");
        $('#phone').val("");
        $("#email").val("");
        $('#deleteBtn').hide();
    });

});