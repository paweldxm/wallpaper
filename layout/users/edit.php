<aside>
    <div>
        <h3>EDYTUJ UŻYTKOWNIKA
            <?php
                echo ' <b><u>' . $_SESSION['editlogin'] . '</u></b>';
            
            ?>
        </h3>
        <form class="aside-form" action="./users.php" method="POST" ENCTYPE="multipart/form-data">
            <div class="form">
                <label for="login">Zmień login</label>
                <input type="text" name="login" required/>
            </div>
            <div class="form">
                <label for="passwd">Zmień hasło</label>
                <input type="password" name="passwd" required/>
            </div>
            <div class="form">
                <label for="passwd">Powtórz hasło</label>
                <input type="password" name="passwd2" required/>
            </div>
            <button class="btn" type="submit">Wyślij</button>
        </form>
    </div>