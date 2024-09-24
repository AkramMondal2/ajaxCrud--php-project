<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajax CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand mb-0 h1" href="#">AjaxCrud</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" id="search" type="search" placeholder="Search" aria-label="Search">

                </form>
            </div>
        </div>
    </nav>

    <!-- alert -->
    <div class="alert alert-secondary alert-dismissible fade hide" id="showAlert" role="alert">
        <strong id="alertText"></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
   
    <h1 class="text-center mt-5">Ajax CRUD</h1>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Record</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editFrm">

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container d-flex">
        <!-- Form Started -->
        <div class="container col-md-4">
            <form id="frm" class="mt-5">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button type="submit" class="btn btn-primary" id="saveBtn">Submit</button>
            </form>
        </div>
        <!-- Table Started -->
        <div class="container col-md-6">
            <table class="table table-success table-striped mt-5 ">
                <thead>
                    <tr>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="show">

                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            //show data
            function lodeData() {
                $.ajax({
                    url: "showdata.php",
                    type: "GET",
                    success: function(data) {
                        $("#show").html(data);
                    }
                });
            };
            lodeData();

            //insert data
            $("#saveBtn").on("click", function(e) {
                e.preventDefault();
                var email = $("#email").val();
                var password = $("#password").val();
                if (email == "" || password == "") {
                    $("#showAlert").addClass("show");
                    $("#alertText").text("All filed require");
                } else {
                    $.ajax({
                        url: "insert.php",
                        type: "POST",
                        data: {
                            email: email,
                            password: password
                        },
                        success: function(data) {
                            if (data) {
                                $("#frm").trigger("reset");
                                lodeData();
                            }
                        }
                    });
                }
            });

            //delete data
            $(document).on("click", "#deletebtn", function() {
                var id = $(this).data("id");
                element = this;

                $.ajax({
                    url: "delete.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        if (data == 1) {
                            $(element).closest("tr").fadeOut();
                        } else {
                            $("#showAlert").addClass("show");
                             $("#alertText").text("Can't Delete");
                        };
                    }
                })
            });

            //loade Edit data
            $(document).on("click", "#editbtn", function() {
                var id = $(this).data("id");

                $.ajax({
                    url: "loadeEditData.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $("#editFrm").html(data);
                    }
                })
            });

            //Update Edit data
            $(document).on("click", "#updateBtn", function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                var email = $("#editEmail").val();
                var password = $("#editPassword").val();

                $.ajax({
                    url: "updateEdit.php",
                    type: "POST",
                    data: {
                        id: id,
                        email: email,
                        password: password
                    },
                    success: function(data) {
                        if (data == 1) {
                            lodeData();
                            $("#exampleModal").modal("hide");
                        } else {
                            alert("can't update record");
                        };
                    }
                });
            });

            // Live Search
            $("#search").on("keyup", function(e) {
                var sValue = $("#search").val();
                console.log(sValue)
                $.ajax({
                    url: "search.php",
                    type: "GET",
                    data: {
                        sValue: sValue
                    },
                    success: function(data) {
                        console.log(data)
                        $("#show").html(data);
                    }
                })
            })
        });
    </script>

</body>

</html>