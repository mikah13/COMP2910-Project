$(document).ready(function() {
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#avatar-display').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#avatar").change(function() {
        readURL(this);
    });

    $('#submit').on('click', function() {
        let age = $('#age').val() | 1;
        let country = $('input[name=location]:checked').val();
        let gender = $('input[name=gender]:checked').val();
        let fav = $('input[name=fav]:checked');

        location.href = "menu.php";

    })
})
