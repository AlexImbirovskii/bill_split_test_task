<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="/assets/ajax.js"></script>

    <style>
        .table-wrapper {
            max-height: 200px;
            overflow-y: auto;
        }
    </style>

    <script>
        fetchUsers();
    </script>

    <style>
        html, body {
            height: 100%;
        }

        .full-height {
            height: 100vh;
        }
    </style>
</head>
<body>

    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="toast" class="toast align-items-center border-0 text-bg-success text-light" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="toastText">

                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <div class="container-fluid full-height d-flex justify-content-center align-items-center">
        <div class="row w-100">
            <div class="col-12 col-md-4 mx-auto bg-light p-5 rounded-2 border border-1">
                <form id="userForm">

                    <div id="errors"></div>

                    <div class="form-group mb-3">
                        <input type="text" class="form-control" id="nameInput" placeholder="Name">
                    </div>

                    <div class="form-group mb-3">
                        <input type="email" class="form-control" id="emailInput" placeholder="E-mail">
                    </div>

                    <button id="userFormSubmit" class="btn btn-primary w-100 mb-2">Submit</button>

                    <hr>

                    <p>Users to pay:</p>
                    <div class="table-wrapper mb-3">
                        <table class="table table-bordered" id="usersTable">
                            <thead class="table-dark">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">To Pay</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <button id="userReset" class="btn btn-danger w-100">Reset</button>

                </form>

            </div>
        </div>
    </div>

</body>
</html>