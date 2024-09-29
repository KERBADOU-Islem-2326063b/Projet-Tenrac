<?php
namespace Blog\Views;
/**
 * Vue du layout du site
 */
class Layout {
    private string $title;
    private string $description;
    private String $cssFilePath;
    private String $jsFilePath;
    public function __construct(string $title, string $description, string $cssFilePath, string $jsFilePath) {
        $this->title = $title;
        $this->description = $description;
        $this->cssFilePath = $cssFilePath;
        $this->jsFilePath = $jsFilePath;
    }

    /**
     * Affichage du rendu du menu supérieur du layout
     * @return void
     */
    public function renderTop(): void {
?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <?php echo '<link rel="stylesheet" href="' . $this->cssFilePath . '">';?>
        <?php
        echo '<script type ="text/javascript" src="_assets/javascript/layout.js"></script>';
        if ($this->jsFilePath) {
            echo '<script type ="text/javascript" src="' . $this->jsFilePath . '"></script>';
        }?>
        <meta name="description" content="<?php echo $this->description; ?>">
        <meta name="keywords" content="Tenrac, tenders, poulet, raclette, secte">
        <meta name="author" content="KERBADOU Islem, ODERZO Flavio, TRAN Thomas, ALVARES Titouan, AVIAS Daphné">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://i.imgur.com/yoJJvM6.png" />
        <title><?php echo $this->title; ?></title>
    </head>
    <body>
    <header>
        <div class="header-left">
            <div id="mySidenav" class="sidenav">
                <a id="closeBtn" href="#" class="close">×</a>
                <ul id = "menu">
                    <li><a class="a-header" href="#">REPAS</a></li>
                    <li><a class="a-header" href="#">PLATS</a></li>
                    <li><a class="a-header" href="/login">CONNEXION</a></li>
                    <li><a class="a-header" href="#">L'ORDRE</a></li>
                    <li><a class="a-header" href="/account">MON COMPTE</a></li>
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
                <li><a class="a-header" href="#">PLATS</a></li>
                <li><a class="a-header" href="/login">CONNEXION</a></li>
                <li><a class="a-header" href="#">L'ORDRE</a></li>
                <li><a class="a-header" href="/account">MON COMPTE</a></li>
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
        <p class="copyright">© Copyright 2024 Tenrac - All Rights Reserved.</p>
        <p><strong>Adresse :</strong> 105 rue de la raclette, 1934 Bagnes, Suisse. - <strong>Email :</strong> tenrac@poulet.fr - <strong>Téléphone :</strong> 06.12.34.56.78</p>
    </footer>
    </body>
    </html>
<?php
    }
}
?>