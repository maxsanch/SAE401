<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/controleur/ctlUser.php";

$Profil = new ctlUser;

$user = $Profil->RecupererUser();

$footer = 'test';

if ($user['niveau'] == 'admin') {

    $footer = '<div class="MiseEnPageRoue">
                <div class="MisePage">
                    <div class="Logo"><img src="../img/Logo.svg" alt="Logo de we escape"></div>
                    <div class="FooterPartiesGlobal">
                        <div class="MiseEnPageFooter">
                            <div>
                                <div>Découvrez we-escape et ses escapes games en plein air !
                                    Plongez dans différentes aventures au coeurs d’enquêtes et d’énigmes en foret ou même en ville.
                                </div>
                                <div>En équipe, vous devrez trouver les indices pour résoudre les mystères que vous rencontrerz sur
                                    votre
                                    parcors
                                    afin de vous echapper !</div>
                            </div>
                            <h3>Nos réseaux</h3>
                            <div class="ReseauImg">
                                <div><a href="https://www.facebook.com/weescapegmbh"><img src="../img/facebook.svg" alt="icon de facebook"></a></div>
                                <div><a href="https://www.instagram.com/we_escape_abenteuer/"><img src="../img/instagram.svg" alt="icon de instagram"></a></div>
                                <div><a href="https://www.youtube.com/@We-Escape"><img src="../img/youtube.svg" alt="icon de youtube"></a></div>
                            </div>
                        </div>
                        <div class="MiseEnPageFooter">
                            <h3 class="NoMargin">Contact</h3>
                            <div class="ContactGroup">
                                <div class="Contactimg"><img src="../img/telephone.svg" alt="Icon de téléphone"></div>
                                <div><a href="tel:+33766899666">07668 99666</a></div>
                            </div>
                            <div class="ContactGroup">
                                <div class="ContactMail">
                                    <div class="Contactimg"><img src="../img/mail.svg" alt="Icon de mail"></div>
                                    <div><a href="mailto:booking@we-escape.de">booking@we-escape.de</a></div>
                                </div>
                                <div class="ContactMail">
                                    <div><a href="mailto:noah.goguet@uha.fr">noah.goguet@uha.fr</a></div>
                                    <div><a href="mailto:alexandre.spitzer@uha.fr">alexandre.spitzer@uha.fr</a></div>
                                    <div><a href="mailto:maxence.sanchez-varas-leclercq@uha.fr">maxence.sanchez-varas-leclercq@uha.fr</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="MiseEnPageFooter">
                            <h3 class="NoMargin">Information</h3>
                            <div class="Information InformationAdmin">
                            <div><a href="index.php?page=PageAjoutJeu">Ajouter un escape game</a></div>
                                <div><a href="index.php?page=checkusers">Les utilisateurs</a></div>
                                <div><a href="index.php">Accueil</a></div>
                                <div><a href="index.php?page=propos">A propos</a></div>
                                <div><a href="index.php?page=jeuxAll">Nos jeux</a></div>
                                <div><a href="index.php?page=carte">Nous trouver</a></div>
                                <div><a href="index.php?page=Contacts">Contacts</a></div>
                                <div><a href="index.php?page=reglement">Réservation</a></div>
                                <div><a href="index.php?page=shop">Boutique souvenir</a></div>
                                <div><a href="index.php?page=informationmyuser">Mon profil</a></div>
                                <div><a href="index.php?page=quitter">Se déconnecter</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="Realisation">Codé par Noah, Maxence et Alexandre | Hébergé par Infomaniak</div>
                </div>
                <div class="RoueFooter" style="--X:-40%; --Y:-40%;"><img src="../img/roue_footer.svg" alt="Une roue"></div>
            </div>';

} else {

    $footer = '<div class="MiseEnPageRoue">
                <div class="MisePage">
                    <div class="Logo"><img src="../img/Logo.svg" alt="Logo de we escape"></div>
                    <div class="FooterPartiesGlobal">
                        <div class="MiseEnPageFooter">
                            <div>
                                <div>Découvrez we-escape et ses escapes games en plein air !
                                    Plongez dans différentes aventures au coeurs d’enquêtes et d’énigmes en foret ou même en ville.
                                </div>
                                <div>En équipe, vous devrez trouver les indices pour résoudre les mystères que vous rencontrerz sur
                                    votre
                                    parcors
                                    afin de vous echapper !</div>
                            </div>
                            <h3>Nos réseaux</h3>
                            <div class="ReseauImg">
                                <div><a href="https://www.facebook.com/weescapegmbh"><img src="../img/facebook.svg" alt="icon de facebook"></a></div>
                                <div><a href="https://www.instagram.com/we_escape_abenteuer/"><img src="../img/instagram.svg" alt="icon de instagram"></a></div>
                                <div><a href="https://www.youtube.com/@We-Escape"><img src="../img/youtube.svg" alt="icon de youtube"></a></div>
                            </div>
                        </div>
                        <div class="MiseEnPageFooter">
                            <h3 class="NoMargin">Contact</h3>
                            <div class="ContactGroup">
                                <div class="Contactimg"><img src="../img/telephone.svg" alt="Icon de téléphone"></div>
                                <div><a href="tel:+33766899666">07668 99666</a></div>
                            </div>
                            <div class="ContactGroup">
                                <div class="ContactMail">
                                    <div class="Contactimg"><img src="../img/mail.svg" alt="Icon de mail"></div>
                                    <div><a href="mailto:booking@we-escape.de">booking@we-escape.de</a></div>
                                </div>
                                <div class="ContactMail">
                                    <div><a href="mailto:noah.goguet@uha.fr">noah.goguet@uha.fr</a></div>
                                    <div><a href="mailto:alexandre.spitzer@uha.fr">alexandre.spitzer@uha.fr</a></div>
                                    <div><a href="mailto:maxence.sanchez-varas-leclercq@uha.fr">maxence.sanchez-varas-leclercq@uha.fr</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="MiseEnPageFooter">
                            <h3 class="NoMargin">Information</h3>
                            <div class="Information InformationAdmin">
                                <div><a href="index.php">Accueil</a></div>
                                <div><a href="index.php?page=propos">A propos</a></div>
                                <div><a href="index.php?page=jeuxAll">Nos jeux</a></div>
                                <div><a href="index.php?page=carte">Nous trouver</a></div>
                                <div><a href="index.php?page=Contacts">Contacts</a></div>
                                <div><a href="index.php?page=reglement">Réservation</a></div>
                                <div><a href="index.php?page=shop">Boutique souvenir</a></div>
                                <div><a href="index.php?page=informationmyuser">Mon profil</a></div>
                                <div><a href="index.php?page=quitter">Se déconnecter</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="Realisation">Codé par Noah, Maxence et Alexandre | Hébergé par Infomaniak</div>
                </div>
                <div class="RoueFooter" style="--X:-40%; --Y:-40%;"><img src="../img/roue_footer.svg" alt="Une roue"></div>
            </div>';
}

echo $footer;

?>