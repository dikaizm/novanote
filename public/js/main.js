document.addEventListener('DOMContentLoaded', function () {
    $("#nav-menu")
        .on("mouseenter", "#menu-item", function () {
            $("#product-dropdown").show();

            $(this)
                .find("#product-dropdown")
                .removeClass("opacity-0")
                .addClass("opacity-100");

            $("#menu-area").show();
        })
        .on("mouseleave", "#menu-item", function () {
            $(this)
                .find("#product-dropdown")
                .addClass("opacity-0")
                .removeClass("opacity-100");

            setTimeout(function () {
                $("#product-dropdown").hide();
                $("#menu-area").hide();
            }, 300);
        });
})


