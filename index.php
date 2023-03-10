<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<div class="container-sm">
    <div class="bg-light p-3">
        <form class="mt-5 bg-body p-3">
            <div class="mt-3 mb-2 d-flex flex-column">
                <span class="fw-bold mb-1">Address Validator</span>
                <span class="text-secondary">Validate/Standardizes addresses using USPS</span>
                <hr>
            </div>
            <div class="mb-3">
                <label for="address-line-1" class="form-label">Address Line 1</label>
                <input type="text" class="form-control" id="address-line-1">
            </div>
            <div class="mb-3">
                <label for="address-line-2" class="form-label">Address Line 2</label>
                <input type="text" class="form-control" id="address-line-2">
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city">
            </div>

            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <select class="form-control" id="state">
                    <?php
                    $states = ["Alaska",
                        "Alabama",
                        "Arkansas",
                        "American Samoa",
                        "Arizona",
                        "California",
                        "Colorado",
                        "Connecticut",
                        "District of Columbia",
                        "Delaware",
                        "Florida",
                        "Georgia",
                        "Guam",
                        "Hawaii",
                        "Iowa",
                        "Idaho",
                        "Illinois",
                        "Indiana",
                        "Kansas",
                        "Kentucky",
                        "Louisiana",
                        "Massachusetts",
                        "Maryland",
                        "Maine",
                        "Michigan",
                        "Minnesota",
                        "Missouri",
                        "Mississippi",
                        "Montana",
                        "North Carolina",
                        "North Dakota",
                        "Nebraska",
                        "New Hampshire",
                        "New Jersey",
                        "New Mexico",
                        "Nevada",
                        "New York",
                        "Ohio",
                        "Oklahoma",
                        "Oregon",
                        "Pennsylvania",
                        "Puerto Rico",
                        "Rhode Island",
                        "South Carolina",
                        "South Dakota",
                        "Tennessee",
                        "Texas",
                        "Utah",
                        "Virginia",
                        "Virgin Islands",
                        "Vermont",
                        "ngton",
                        "Wisconsin",
                        "West Virginia",
                        "Wyoming"];

                    ?>

                    <?php foreach ($states as $value) { ?>
                        <option value="<?= $value ?>"><?= $value ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="zip-code" class="form-label">Zip Code</label>
                <input type="text" class="form-control" id="zip-code">
            </div>
            <div id="send" class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Validate</button>
            </div>
        </form>
    </div>

    <div class="modal hidden">
        <div class="container">
            <div class="body">
                <div id="close">X</div>

                <p>Which address format do you want to save?</p>
                    <!-- Tab links -->
                    <div class="tab">
                        <button class="tablinks original" onclick="openTab(event, 'original')">Original</button>
                        <button class="tablinks usps" onclick="openTab(event, 'usps')">Usps</button>
                    </div>

                    <!-- Tab content -->
                    <div id="original" class="tabcontent">
                        <p id="error"></p>
                        <p id="address-1">
                        <p>
                        <p id="address-2">
                        <p>
                        <p id="city-1">
                        <p>
                        <p id="state-1">
                        <p>
                        <p id="zip-code-1">
                        <p>
                    </div>

                    <div id="usps" class="tabcontent">
                        <p id="usps-error"></p>
                        <div class="hello24"></div>
                        <p id="usps-address-1">
                        <p>
                        <p id="usps-address-2">
                        <p>
                        <p id="usps-city-1">
                        <p>
                        <p id="usps-state-1">
                        <p>
                        <p id="usps-zip-code-1">
                        <p>
                    </div>

                    <button id="save" type="submit" class="btn btn-primary">Save</button>
<!--                </div>-->
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>
</html>