// Select proper fields for selected product
function typeFields() {
    const selector = document.querySelector('.productType').value;

    $.ajax({
        type: "POST",
        url: '/add-product',
        data: {selector},

        success: function (data) {
            $(".type-field").html(data);
        }
    });
}

// Validate input fields und submit data
$(document).ready(function () {
    $('#product_form').submit(function (e) {

        const form = {
            sku: $('input[name="sku"]').val(),
            name: $('input[name="name"]').val(),
            price: $('input[name="price"]').val(),
            type: $('select[name="type"]').val(),
            attributes: $('.attribute').serializeArray()
        };

        $.ajax({
            type: "POST",
            url: '/add-product/store',
            data: form,
            dataType: "json",
            encode: true,
            success: function (data) {
                if (!data.errors) {
                    window.location.replace('/');
                } else {
                    $.each(data, function (key, val) {
                        const field = document.getElementsByClassName(key);
                        $(field).html(val);
                    });
                }
            }
        })
        e.preventDefault();
    });
});
