var modal = document.querySelector(".modal");
var container = modal.querySelector(".container");
let data = new FormData();

let address_1 = document.querySelector('#address-line-1').value
let address_2 = document.querySelector('#address-line-2').value
let city = document.querySelector('#city').value
let state = document.querySelector('#state').value
let zip_code = document.querySelector('#zip-code').value

data.append('address_1', address_1);
data.append('address_2', address_2);
data.append('city', city);
data.append('state', state);
data.append('zip-code', zip_code);

document.querySelector('#send').addEventListener('click', function (e) {
    e.preventDefault()

    let xhr = new XMLHttpRequest();
    let url = 'backend.php';

    xhr.open('POST', url, true);

    xhr.onreadystatechange = function() {//Call a function when the state changes.
        if(xhr.readyState === 4 && xhr.status === 200) {
            modal.classList.remove("hidden")
            let matchError = new RegExp(/error/)
            //matchError.test(xhr.responseText)

            if (matchError.test(xhr.responseText)) {
                document.querySelector('#error').innerHTML = xhr.responseText
                document.querySelector('#usps-error').innerHTML = xhr.responseText
                document.querySelector('#save').classList.add('d-none')
                data.delete('save_data');
            } else {

                document.querySelector('#usps-address-1').value = address_1;
                document.querySelector('#usps-address-2').value = address_2;
                document.querySelector('#usps-city-1').value = city;
                document.querySelector('#usps-state-1').value = state;
                document.querySelector('#usps-zip-code-1').value = zip_code;
                console.log(xhr.response);
                document.querySelector('#address-1').value = address_1;
                document.querySelector('#address-2').value = address_2;
                document.querySelector('#city-1').value = city;
                document.querySelector('#state-1').value = state;
                document.querySelector('#zip-code-1').value = zip_code;
                document.querySelector('#save').classList.remove('d-none')
            }
        }
    }
    xhr.send(data);
})

document.querySelector("#close").addEventListener("click", function (e) {
    modal.classList.add("hidden");
});

document.querySelector('#save').addEventListener('click', function (e) {
    e.preventDefault()

    data.append('save_data', true);

    let xhr = new XMLHttpRequest();
    let url = 'backend.php';

    xhr.open('POST', url, true);

    xhr.onreadystatechange = function() {//Call a function when the state changes.
        if(xhr.readyState === 4 && xhr.status === 200) {
            modal.classList.remove("hidden")

            let matchError = new RegExp(/error/)
            if (matchError.test(xhr.responseText)) {
                document.querySelector('#error').innerHTML = xhr.responseText
                document.querySelector('#save').classList.add('d-none')
            } else {
                document.querySelector('#address-1').value = address_1;
                document.querySelector('#address-2').value = address_2;
                document.querySelector('#city-1').value = city;
                document.querySelector('#state-1').value = state;
                document.querySelector('#zip-code-1').value = zip_code;

                document.querySelector('#save').classList.remove('d-none')
            }
        }
    }
    xhr.send(data);
})