<?php
namespace Blog\Views;
/**
 * Vue du layout du site
 */
class Layout {

    /**
     * Affichage du rendu du menu supérieur du layout
     * @param string $title titre
     * @param string $description description
     * @param string $cssFilePath chemin css
     * @param string $jsFilePath chemin js
     * @return void
     */
    public function renderTop(string $title, string $description, string $cssFilePath, string $jsFilePath): void {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <?php echo '<link rel="stylesheet" href="' . $cssFilePath . '">';?>
            <?php
            echo '<script src="_assets/javascript/layout.js"></script>';
            if ($jsFilePath) {
                echo '<script src="' . $jsFilePath . '"></script>';
            }?>
            <meta name="description" content="<?php echo $description; ?>">
            <meta name="keywords" content="Tenrac, tenders, poulet, raclette, secte">
            <meta name="author" content="KERBADOU Islem, ODERZO Flavio, TRAN Thomas, ALVARES Titouan, AVIAS Daphné">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" href="https://i.imgur.com/yoJJvM6.png">
            <title><?php echo $title; ?></title>
        </head>
        <body>
        <header>
            <div class="header-left">
                <div id="mySidenav" class="sidenav">
                    <a id="closeBtn" href="#" class="close">×</a>
                    <ul id = "menu">
                        <li><a class="a-header" href="#">REPAS</a></li>
                        <li><a class="a-header" href="/plats">PLATS</a></li>
                        <li><a class="a-header" href="#">L'ORDRE</a></li>
                        <li><a class="a-header" href="/members">MEMBRES</a></li>
                        <?php
                        if ($_SESSION['id_tenrac']) {
                            ?>
                            <li><a class="a-header" href="/account">DECONNEXION</a></li>
                        <?php }
                        else { ?>
                            <li><a class="a-header" href="/login">CONNEXION</a></li>
                            <?php
                        }?>
                    </ul>
                </div>
                <a href="#" id="openBtn">
                  <span class="burger-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                  </span>
                </a>
                <a href="/homepage"><img alt="Logo des tenracs" src="https://i.imgur.com/FR6znMh.png" width="220" height="65" class="logo"></a>
                <ul class="menu">
                    <li><a class="a-header" href="#">REPAS</a></li>
                    <li><a class="a-header" href="/plats">PLATS</a></li>
                    <li><a class="a-header" href="#">L'ORDRE</a></li>
                    <li><a class="a-header" href="/members">MEMBRES</a></li>
                    <?php
                    if ($_SESSION['id_tenrac']) {
                        ?>
                        <li><a class="a-header" href="/account">DECONNEXION</a></li>
                    <?php }
                    else { ?>
                        <li><a class="a-header" href="/login">CONNEXION</a></li>
                        <?php
                    }?>
                </ul>
            </div>
        <div class="header-right">
            <?php echo $_SESSION['id_tenrac'];?>
            <img alt="Icone de connexion" src="https://i.imgur.com/Uw4eL5a.png" width="40" height="38" class="logo">
        </div>
    </header>
<?php
    }

    /**
     * Rendu de la partie basse du layout
     * @return void
     */
    public function renderBottom(): void {
?>
    <footer>
        <div class="W3C-logo">
            <p>
                <a target="_blank" href="<?php echo 'https://validator.w3.org/nu/?doc=https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                    <img src="https://i.imgur.com/O6cKBc5.png"
                         alt="Validation HTML" id="html5Validator">
                </a>
            </p>
            <p>
                <a target="_blank" href="https://jigsaw.w3.org/css-validator/check/referer">
                    <img src="https://jigsaw.w3.org/css-validator/images/vcss-blue"
                         alt="Validation CSS" id="css3Validator">
                </a>
            </p>
        </div>
        <div class="footer-text">
            <p><strong>Adresse :</strong> 105 rue de la raclette, 1934 Bagnes, Suisse. - <strong>Email :</strong> tenrac@poulet.fr - <strong>Téléphone :</strong> 06.12.34.56.78</p>
        </div>
        <p class="copyright">© 2024 Tenrac - All Rights Reserved.</p>
    </footer>
    </body>
    </html>
<?php
    }
}
?>