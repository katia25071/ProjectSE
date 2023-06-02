<html>

<head>

    <meta charset="utf-8" />
    <title>Book Recomandations</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/project/style/style.css" />

    <style>
        .mb-sm-0,
        .my-sm-0 {
            margin-bottom: 10px !important;
        }

        th {
            text-align: center;
        }

        td {
            text-align: center !important;
            vertical-align: middle !important;
        }
    </style>
 

</head>

<?php
include("/Applications/XAMPP/xamppfiles/htdocs/project/authentication.php");
// include("auth.php");
if (isset($_SESSION['type']) & ($_SESSION['type'] == 'admin' || $_SESSION['type'] == 'Simpleadmin')) {
    ?>

    <html>

    <body style="background-image: url(image/bg.png)">
        <?php
        include '/Applications/XAMPP/xamppfiles/htdocs/project/nav.php';
        require('/Applications/XAMPP/xamppfiles/htdocs/project/db.php');


        ?>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <?php
                    require '/Applications/XAMPP/xamppfiles/htdocs/project/menu.php';
                    ?>

                    <div class="seearch">
                        <nav class="navbar navbar-light center">
                            <form class="form-inline" method="POST">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search"
                                    aria-label="Search">
                                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"
                                    name="seearch">Search</button>
                            </form>
                        </nav>
                        

                        <?php
                        if (isset($_POST['seearch'])) {
                            $s = $_POST['search'];
                            $sql = "select * from review r , books b where b.bid=r.bid and (b.bid='$s' or b.title name like '%$s%')";
                        } else
                            $sql = "select * from review r , books b where b.bid=r.bid ";

                        $result = mysqli_query($con, $sql);
                        $crow = mysqli_num_rows($result);

                        if (!$crow)
                            echo "<br><center><h2><b><i>No Results</i></b></h2></center>";
                        else {

                            ?>
                            <div class="over">
                                <table class="table table-striped bg-white center" style="width:100%; ">
                                    <thead>
                                        <tr>
                                            <th>BookId</th>
                                            <th>Title</th>
                                            <th>User fullname</th>
                                            <th>Review</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($row = mysqli_fetch_array($result)) {
                                            $rid= $row['id'];
                                            $id = $row['bid'];
                                            $title = $row['title'];
                                            $name = $row['name'];
                                            $review =$row['review'];
                                          

                                            ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo $id ?>
                                                </th>
                                               
                                                <td>
                                                    <?php echo $title ?>
                                                </td>
                                                <td>
                                                    <?php echo $name ?>
                                                </td>
                                                <td>
                                                    <?php echo $review ?>
                                                </td>
                                    
                                                <td><button class='btn btn-danger'><a style='color:white;text-decoration:none'
                                                           onclick="f()">Delete</a></button>
                                                </td>


                                            </tr>

                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <?php
            require '/Applications/XAMPP/xamppfiles/htdocs/project/footer.php';
            ?>

        </body>
        <?php
                        }

                        ?>

    </html>
    <script>

function f() {
    if (confirm("Are you sure you want to delete this recomandation?")) {
        window.location. href='/project/admin/deletereview.php?id=<?php echo $rid ?>';
    }
}

</script>
    <?php
} else {
    header("Location:/project/login.php");
}
?>