document.querySelector('#send').addEventListener('click', function (e) {
    e.preventDefault()

    let address_1 = document.querySelector('#address-line-1').value
    let address_2 = document.querySelector('#address-line-2').value
    let city = document.querySelector('#city').value
    let state = document.querySelector('#state').value
    let zip_code = document.querySelector('#zip-code').value

    let xhr = new XMLHttpRequest();
    let url = 'backend.php';
    let data = new FormData();

    data.append('address_1', address_1);
    data.append('address_2', address_2);
    data.append('city', city);
    data.append('state', state);
    data.append('zip-code', zip_code);

    xhr.open('POST', url, true);
    // xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {//Call a function when the state changes.
        if(xhr.readyState === 4 && xhr.status === 200) {
            alert(xhr.responseText);
        }
    }
    xhr.send(data);
})