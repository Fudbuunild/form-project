    var modal = document.querySelector(".modal");
    var container = modal.querySelector(".container");
    let data = new FormData();

    let address_1 = document.querySelector('#address-line-1').value
    let address_2 = document.querySelector('#address-line-2').value
    let city = document.querySelector('#city').value
    let state = document.querySelector('#state').value
    let zip_code = document.querySelector('#zip-code').value
    let validationResponse;

    data.append('address_1', address_1);
    data.append('address_2', address_2);
    data.append('city', city);
    data.append('state', state);
    data.append('zip-code', zip_code);

    console.log(address_1)
    console.log(address_2)
    console.log(city)

    document.querySelector('#send').addEventListener('click', function (e) {
        e.preventDefault()

        let xhr = new XMLHttpRequest();
        let url = 'backend.php';

        xhr.responseType = 'json';
        xhr.open('POST', url, true);

        xhr.onreadystatechange = function () {//Call a function when the state changes.
            if (xhr.readyState === 4 && xhr.status === 200) {
                modal.classList.remove("hidden")
                console.log(xhr.response)
                if (xhr.response['error'] !== undefined) {
                    document.querySelector('#error').innerHTML = xhr.response['error']
                    document.querySelector('#usps-error').textContent = xhr.response['error']
                    document.querySelector('#save').classList.add('d-none')
                    data.delete('save_data');
                } else {
                    document.querySelector('#usps-address-1').textContent = xhr.response['usps_address_1'];
                    document.querySelector('#usps-address-2').textContent = xhr.response['usps_address_2'];
                    document.querySelector('#usps-city-1').textContent = xhr.response['usps_city'];
                    document.querySelector('#usps-state-1').textContent = xhr.response['usps_state'];
                    document.querySelector('#usps-zip-code-1').textContent = xhr.response['usps_zip-code'];
                    console.log(xhr.response);
                    document.querySelector('#address-1').textContent = address_1;
                    document.querySelector('#address-2').textContent = address_2;
                    document.querySelector('#city-1').textContent = city;
                    document.querySelector('#state-1').textContent = state;
                    document.querySelector('#zip-code-1').textContent = zip_code;
                    document.querySelector('#save').classList.remove('d-none')
                }
            }
            validationResponse = xhr.response;
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
        let dataUsps

        xhr.open('POST', url, true);
        let active = document.querySelector('.active').textContent;
        console.log(active);
        xhr.onreadystatechange = function () {//Call a function when the state changes.
            if (xhr.readyState === 4 && xhr.status === 200) {
                modal.classList.remove("hidden")

                if (xhr.response['error'] !== undefined) {
                    document.querySelector('#error').textContent = xhr.responseText['error']
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
        if (active !== 'Original') {
            dataUsps = new FormData();
            dataUsps.append('address_1', validationResponse['usps_address_1']);
            dataUsps.append('address_2', validationResponse['usps_address_2']);
            dataUsps.append('city', validationResponse['usps_city']);
            dataUsps.append('state', validationResponse['usps_state']);
            dataUsps.append('zip-code', validationResponse['usps_zip-code']);
            xhr.send(dataUsps)
        } else {
            xhr.send(data);
        }
    });

function openTab(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// setTimeout(() => {
//     openTab(event, 'original')
// }, 500)


