<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Roles Permissions Testing</title>
</head>
<body>
    <h1>
        Test Page
    </h1>

    @can('view_site')
        <h2>
            Yes I can View
        </h2>
    @endcan

    @can('manage_site')
        <h3>
            Yes I can Manage
        </h3>
    @endcan
</body>
</html>
