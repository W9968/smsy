<?php
$cookie_value = "a-users-add";
setcookie("routing", $cookie_value, time() + (86400 * 30), "/");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../styles/form.module.css?v=<?php echo time() ?>">
    <script src="../../javascript/fallbacks.js"></script>
</head>

<body>
    <form action="../functions/add_user_data.php" method="post" class="form" enctype="multipart/form-data">
        <h1>ajouter un utilisateur</h1>
        <div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="nom">nom</label>
                    <input type="text" placeholder="nom..." name="nom" id="nom" required>
                </div>
                <div class="form-group">
                    <label for="prenom">prenom</label>
                    <input type="text" placeholder="prenom..." name="prenom" id="prenom" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email">email</label>
                <input type="email" placeholder="foulen@foulen.exp" name="email" id="email" required>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="cin">CIN</label>
                    <input type="number" placeholder="xxxxxxxx" name="cin" id="cin" required>
                </div>
                <div class="form-group">
                    <label for="password">mot de passe</label>
                    <input type="password" placeholder="mot de passe..." name="password" id="password" required>
                </div>
            </div>

            <div class="form-group">
                <label for="add1">address 1</label>
                <input type="text" placeholder="addresse..." name="add1" id="add1" required>
            </div>

            <div class="form-group">
                <label for="add2">address 2</label>
                <input type="text" placeholder="optional..." name="add2" id="add2">
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="cite">cite</label>
                    <input type="text" placeholder="cite..." name="cite" id="cite" required>
                </div>
                <div class="form-group">
                    <label for="state">state</label>
                    <input type="text" placeholder="state..." name="state" id="state" required>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="zip">code postale</label>
                    <input type="text" placeholder="code postale..." name="zip" id="zip" required>
                </div>
                <div class="form-group">
                    <label>type</label>
                    <select name="role" class="selection" required>
                        <option value="" disabled selected>selectionner option</option>
                        <option value="student">etudiant</option>
                        <option value="teacher">enseignant</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>sex</label>
                <span>
                    <input type="radio" name="r1" value="femme" required> femme
                </span>
                <span>
                    <input type="radio" name="r1" value="homme" required> homme
                </span>
            </div>

            <div class="form-group">
                <label for="file_upload">image de profile</label>
                <input type="file" name="file_upload" id="file_upload" accept="image/*">
                <div id="image-translate">
                    <img id="profile-pic" src="https://t3.ftcdn.net/jpg/03/46/83/96/360_F_346839683_6nAPzbhpSkIpb8pmAwufkC7c5eD7wYws.jpg">
                    <p id="picture-name">photo de profile</p>
                </div>
            </div>


            <div class="form-group">
                <button type="submit" name="ajouter">sauvgarder</button>
            </div>

        </div>
    </form>

    <script src="../javascript/fileReader.js"></script>
</body>

</html>