function typeFields() {
    const selector = document.querySelector('.productType').value;

    jQuery.ajax({
        type: "POST",
        url: '/add-product',
        data: {selector},

        success: function (data) {
            $(".type-field").html(data);
        }
    });
}


const sku = document.getElementById('sku');
const name = document.getElementById('name');
const price = document.getElementById('price');
const typeSwitcher = document.getElementById('productType');

const size = document.getElementById('size');

const height = document.getElementById('height');
const width = document.getElementById('width');
const length = document.getElementById('length');

const wight = document.getElementById('weight');

const REQUIRED_DATA = 'Please submit required data';
const INDICATED_TYPE = 'Please, provide the data of indicated type';

const form = document.getElementById('product_form');

function showMessage(input, message, type) {
    const msg = input.parentNode.querySelector('small');
    msg.innerText = message;
    input.className = type ? 'success' : 'error';
    return type;
}

function showError(input, message) {
    return showMessage(input, message, false);
}

function showSuccess(input) {
    return showMessage(input, "", true);
}

function hasValue(input, message) {
    if (input.value.trim() === "") {
        return showError(input, message);
    }
    return showSuccess(input);
}

form.addEventListener('submit', (event) => {
    event.preventDefault();

    let skuValid = hasValue(form.elements['sku'], REQUIRED_DATA);
    let nameValid = hasValue(form.elements['name'], REQUIRED_DATA);
    let priceValid = hasValue(form.elements['price'], REQUIRED_DATA);
    let typeValid = hasValue(form.elements['productType'], REQUIRED_DATA);

    if (skuValid && nameValid && priceValid && typeValid) {
        let sizeValid = hasValue(form.elements['size'], REQUIRED_DATA);
        let heightValid = hasValue(form.elements['height'], REQUIRED_DATA);
        let widthValid = hasValue(form.elements['width'], REQUIRED_DATA);
        let lengthValid = hasValue(form.elements['length'], REQUIRED_DATA);
        let weightValid = hasValue(form.elements['weight'], REQUIRED_DATA);

        if (sizeValid || (heightValid && widthValid && lengthValid) || weightValid) {
        }
    }
})
