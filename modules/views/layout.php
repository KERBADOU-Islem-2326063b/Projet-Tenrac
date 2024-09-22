<?php
namespace Blog\Views;
/**
 * Classe du layout du site
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
        <style>
            <?php include '_assets/styles/layout.css';
            if ($this->cssFilePath) {
                include $this->cssFilePath;
            }?>
        </style>
        <script>
            <?php require_once "_assets/javascript/layout.js";
            if ($this->jsFilePath) {
                include $this->jsFilePath;
            }?>
        </script>
        <meta charset="UTF-8">
        <meta name="description" content=<?php echo $this->description; ?>>
        <meta name="keywords" content="Tenrac, tenders, poulet, raclette, secte">
        <meta name="author" content="KERBADOU Islem, ODERZO Flavio, TRAN Thomas, ALVARES Titouan, AVIAS Daphné">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $this->title; ?></title>
    </head>
    <body>
    <header>
        <div class="header-left">
            <div id="mySidenav" class="sidenav">
                <a id="closeBtn" href="#" class="close">×</a>
                <ul id = "menu">
                    <li><a class="a-header" href="#">REPAS</a></li>
                    <li><a class="a-header" href="#">PLATS</a></li>
                    <li><a class="a-header" href="#">CONNEXION</a></li>
                    <li><a class="a-header" href="#">L'ORDRE</a></li>
                </ul>
            </div>

            <a href="#" id="openBtn">
                  <span class="burger-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                  </span>
            </a>
            <img alt="Logo des tenracs" src="https://i.imgur.com/FR6znMh.png" width="200px" height="80%" class="logo">
            <ul class="menu">
                <li><a class="a-header" href="#">REPAS</a></li>
                <li><a class="a-header" href="#">PLATS</a></li>
                <li><a class="a-header" href="#">CONNEXION</a></li>
                <li><a class="a-header" href="#">L'ORDRE</a></li>
            </ul>
        </div>
        <div class = "header-right">
            <a href="#"><img alt="Icone de connexion" src="https://i.imgur.com/Uw4eL5a.png" width="40px" height="38px" class="logo"></a>
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
        <div class="apropos">
            <p><strong>Adresse :</strong> 105 rue de la raclette, 1934 Bagnes, Suisse. </p>
            <p><strong>Email :</strong> tenrac@poulet.fr</p>
            <p><strong>Téléphone :</strong> 06.12.34.56.78</p>
            <div>
                <a href="#"><img alt="Redirection Instagram" src="https://i.imgur.com/0kZm59H.png" width="35px" height="80%"></a>
                <a href="#"><img alt="Redirection Twitter" src="https://i.imgur.com/CTTXkU7.png" width="35px" height="80%"></a>
                <a href="#"><img alt="Redirection Facebook" src="https://i.imgur.com/QwF9yiJ.png" width="35px" height="80%"></a>
            </div>
        </div>
        <p class="copyright">© Copyright 2024 Tenrac - All Rights Reserved.</p>
    </footer>
    </body>
    </html>
<?php
    }
}
?>