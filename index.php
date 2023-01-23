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
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">ORIGINAL
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">STANDARDIZED (USPS)
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                         aria-labelledby="pills-home-tab">
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                             aria-labelledby="pills-profile-tab">
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
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                             aria-labelledby="pills-contact-tab">
                            <p id="usps-error"></p>
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
                    </div>
                        <button id="save" type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
    <script src="main.js"></script>
</body>
</html>