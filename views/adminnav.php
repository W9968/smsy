<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <link rel="stylesheet" href="../../styles/navbar.module.css?v=<?php echo time(); ?>">
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>
    <nav class="nav">
        <a class="goto"><button><i style="height: 18px; width: 18px;margin-right: 10px;" data-feather="grid"></i>dashboard</button></a>
        <button class="accordion">
            <p class="label">classes</p>
            <div class="content">0</div>
        </button>
        <button class="accordion">
            <p class="label">departement</p>
            <div class="content">1</div>
        </button>
        <button class="accordion">
            <p class="label">gestion user</p>
            <div class="content">2</div>
        </button>

    </nav>
    <script src="../../config/feather.config.js"></script>
    <script src="../../javascript/dropDown.js"></script>
</body>

</html>