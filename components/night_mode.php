<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Add Font Awesome CSS link -->
    <link rel="stylesheet" href="../components/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            /* padding: 25px; */
            background-color: white;
            color: black;
            font-size: 25px;
        }

        .dark-mode {
            background-color: #343a40;
            color: white;
        }

        #dark_mode {
            color: white;

        }


        #dark_mode:hover {
            color: green;
            transition: all 0.8s;
        }
    </style>
</head>

<body>

    <!-- Use the Font Awesome icon here -->
    <a href="#" onclick="myFunction()">
        <i id="dark_mode" class="fa-regular fa-moon fa-lg "></i></a>
    <script>
        function myFunction() {
            var element = document.body;
            element.classList.toggle("dark-mode");
        }
    </script>

</body>

</html>