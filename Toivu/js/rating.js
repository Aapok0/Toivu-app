$(document).ready(function() {
    $(".rating input:radio").attr("checked", false);

    $('.rating input').click(function () {
        $(".rating span").removeClass('checked');
        $(this).parent().addClass('checked');
    });

    $('input:radio').change(
        function() {
            var userRating = this.value;
            console.log(userRating);
    });
});