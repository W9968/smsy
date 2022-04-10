<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../../styles/form.module.css?v=<?php echo time() ?>">
</head>

<body>
    <form action="../../functions/account_add.php" method="post" class="form" enctype="multipart/form-data">
        <h1>ajouter un utilisateur</h1>

        <div class="fom-group">
            <p class="intro">en tant qu'un adminitrateur, vous serez capable d'ajouter tout les types d'utilisateur.<br />seuls les comptes de type <code>`TEACHER`, `STUDENT`</code> requis plus d'information a remplir par le moderateur.</p>
        </div>
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

            <div class="form-grid">
                <div class="form-group">
                    <label for="email">email</label>
                    <input type="email" placeholder="foulen@foulen.exp" name="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="cin">cin</label>
                    <input type="text" placeholder="xxxxxxxx" name="cin" id="cin" maxlength="8" required>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="add1">address 1</label>
                    <input type="text" placeholder="addresse..." name="add1" id="add1" required>
                </div>

                <div class="form-group">
                    <label for="add2">address 2</label>
                    <input type="text" placeholder="optional..." name="add2" id="add2">
                </div>
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
                    <input type="text" placeholder="code postale..." name="zip" id="zip" minlength="4" required>
                </div>
                <div class="form-group">
                    <label>type</label>
                    <select name="role" class="selection" required>
                        <option value="" disabled selected>selectionner option</option>
                        <option value="STUDENT">etudiant</option>
                        <option value="TEACHER">enseignant</option>
                        <option value="ADMINISTRATOR">Administrateur</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>sex</label>
                <span>
                    <input type="radio" name="r1" value="MALE" required> homme
                </span>
                <span>
                    <input type="radio" name="r1" value="FEMALE" required> femme
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

    <script src="../../javascript/fileReader.js"></script>
</body>

</html>