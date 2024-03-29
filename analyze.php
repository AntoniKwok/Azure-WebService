<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Analyze</title>
    <style type="text/css">
        body { background-color: #fff; border-top: solid 10px #000;
            color: #333; font-size: .85em; margin: 20; padding: 20;
            font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
        }
        h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
        h1 { font-size: 2em; }
        h2 { font-size: 1.75em; }
        h3 { font-size: 1.2em; }
        table { margin-top: 0.75em; }
        th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
        td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
    </style>
    <link rel="stylesheet" href="/bulma/css/bulma.min.css">
</head>
<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="https://bluejack.azurewebsites.net/">
                    Register
                </a>

                <a class="navbar-item" href="https://bluejack.azurewebsites.net/analyze.php">
                    Analyze
                </a>
            </div>
        </div>
    </nav>
    <div class="container">
        <p class="title is-1">Upload Image!</p>
        <form method="post" action="upload.php" enctype="multipart/form-data">
            <div class="field">
                <label class="label">Image</label>
                <div class="control">
                    <input class="input" type="file" name="image" id="image">
                </div>
            </div>
            <input type="submit" name="submit" value="Submit" />
        </form>
    </div>
    
</body>
</html>