<?php
  // Stocker le nom de la page dans une variable :
  $page = 'menu';

  // Inclure la partie d'entête
  include('inclus/entete.php');

  // Intégrer la base de données pour le menu
  $connexion = mysqli_connect("localhost", "root", "");
  // Utiliser UTF-8 
  mysqli_query($connexion, "SET NAMES 'UTF8'");
  // Sélectionner la BD "leila"
  mysqli_select_db($connexion, "leila-i18n");
  
  // Chercher l'information du menu (avec les noms des catégories)
  
  $requeteMenu = "SELECT 
                      p.nom AS nomPlat, 
                      description, 
                      portion, 
                      prix, 
                      c.nom AS nomSection 
                    FROM plat AS p 
                      JOIN plat_detail AS pld ONpld.id_plat = p.id
                      JOIN categorie AS c ON p.id_categorie = c.id
                      JOIN categorie_detail AS cd ON cd.id_categorie = c.id.code_langue = ''
                    WHERE pld.code_langue = '$langueActive'
                      AND pld.code_langue = '$langueActive'
                    ORDER BY c.id ASC,prix ASC";
  $resultatMenu = mysqli_query($connexion, $requeteMenu);
  
  // Réorganiser le jeu d'enregistrements obtenu pour produire un tableau associatif
  // PHP contenant les plats groupés par section
  $tabPlatsParSection = [];
  while($ligne = mysqli_fetch_assoc($resultatMenu))
  {
    $nomSection = $ligne["nomSection"];
    $tabPlatsParSection[$nomSection][] = $ligne;
  }
?>
      <div class="titre-page">
        <h1><?= $me_titre; ?></h1>
      </div>
      <nav class="nav-principale">
        <a href="menu.php" class="actif" title="<?= $co_navMenusTitle; ?>">
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="130px" height="130px" viewBox="0 0 130 130" enable-background="new 0 0 130 130" xml:space="preserve"><g><path class="icone" fill="#bbb" d="M65,1C29.7,1,1,29.7,1,65s28.7,64,64,64c35.3,0,64-28.7,64-64S100.3,1,65,1z M65,126C31.4,126,4,98.6,4,65 C4,31.4,31.4,4,65,4c33.6,0,61,27.4,61,61C126,98.6,98.6,126,65,126z M33.1,99.1h63v-68h-63V99.1z M36.1,34.1h57v62h-57V34.1z  M66.1,57.1h-18c-0.8,0-1.5,0.7-1.5,1.5s0.7,1.5,1.5,1.5h18c0.8,0,1.5-0.7,1.5-1.5S67,57.1,66.1,57.1z M66.1,81.1h-18 c-0.8,0-1.5,0.7-1.5,1.5s0.7,1.5,1.5,1.5h18c0.8,0,1.5-0.7,1.5-1.5S67,81.1,66.1,81.1z M66.1,69.1h-18c-0.8,0-1.5,0.7-1.5,1.5 s0.7,1.5,1.5,1.5h18c0.8,0,1.5-0.7,1.5-1.5S67,69.1,66.1,69.1z M66.1,45.1h-18c-0.8,0-1.5,0.7-1.5,1.5s0.7,1.5,1.5,1.5h18 c0.8,0,1.5-0.7,1.5-1.5S67,45.1,66.1,45.1z M81.1,57.1h-5c-0.8,0-1.5,0.7-1.5,1.5s0.7,1.5,1.5,1.5h5c0.8,0,1.5-0.7,1.5-1.5 S82,57.1,81.1,57.1z M81.1,81.1h-5c-0.8,0-1.5,0.7-1.5,1.5s0.7,1.5,1.5,1.5h5c0.8,0,1.5-0.7,1.5-1.5S82,81.1,81.1,81.1z M81.1,45.1 h-5c-0.8,0-1.5,0.7-1.5,1.5s0.7,1.5,1.5,1.5h5c0.8,0,1.5-0.7,1.5-1.5S82,45.1,81.1,45.1z M81.1,69.1h-5c-0.8,0-1.5,0.7-1.5,1.5 s0.7,1.5,1.5,1.5h5c0.8,0,1.5-0.7,1.5-1.5S82,69.1,81.1,69.1z"/></g></svg>
        </a>
        <a href="vins.php" title="<?= $co_navVinsTitle; ?>">
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" width="128px" height="128px" viewBox="0 0 128 128" enable-background="new 0 0 128 128" xml:space="preserve"><defs></defs><g><defs><rect id="SVGID_1_" width="128" height="128"/></defs><clipPath id="SVGID_2_"><use xlink:href="#SVGID_1_" overflow="visible"/></clipPath><path clip-path="url(#SVGID_2_)" fill="#bbb" d="M64,3c33.636,0,61,27.364,61,61c0,33.635-27.364,61-61,61 C30.364,125,3,97.635,3,64C3,30.364,30.364,3,64,3 M64,0C28.654,0,0,28.654,0,64c0,35.346,28.654,64,64,64 c35.346,0,64-28.654,64-64C128,28.654,99.346,0,64,0"/><path class="coupe" clip-path="url(#SVGID_2_)" fill="none" stroke="#bbb" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10" d="  M83.817,32.017H44.182c-1.717,3.554-2.689,12.733-2.689,16.583c0,12.425,10.081,22.505,22.507,22.505S86.507,61.026,86.507,48.6  C86.507,44.75,85.535,35.571,83.817,32.017z"/><line clip-path="url(#SVGID_2_)" fill="none" stroke="#bbb" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10" x1="64" y1="71.104" x2="64" y2="95.388"/><line clip-path="url(#SVGID_2_)" fill="none" stroke="#bbb" stroke-width="3" stroke-linecap="round" stroke-miterlimit="10" x1="53.932" y1="95.983" x2="74.068" y2="95.983"/></g></svg>
        </a>
        <a href="javascript: void(0);" title="<?= $co_navReservationTitle; ?>">
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="130px" height="130px" viewBox="0 0 130 130" enable-background="new 0 0 130 130" xml:space="preserve"><path fill="#bbb" d="M65,0.7c-35.3,0-64,28.7-64,64c0,35.3,28.7,64,64,64s64-28.7,64-64C129,29.4,100.3,0.7,65,0.7z M65,125.7 c-33.6,0-61-27.4-61-61c0-33.6,27.4-61,61-61s61,27.4,61,61C126,98.4,98.6,125.7,65,125.7z M65,29.1c-19.7,0-35.6,15.9-35.6,35.6 c0,19.7,15.9,35.6,35.6,35.6s35.6-15.9,35.6-35.6C100.6,45.1,84.7,29.1,65,29.1z M65,97.2c-17.9,0-32.5-14.6-32.5-32.5 S47.1,32.2,65,32.2s32.5,14.6,32.5,32.5S82.9,97.2,65,97.2z M78.3,44.3c-0.7-0.5-1.7-0.3-2.1,0.5L64.6,62.7l-11.2-9.4 c-0.7-0.6-1.6-0.5-2.2,0.2c-0.6,0.7-0.5,1.6,0.2,2.2l13.9,11.7l13.4-20.8C79.2,45.8,79,44.8,78.3,44.3z"/></svg>
        </a>
      </nav>
    </header>
    <div class="contenu-principal">
      <div class="citation">
        <img src="images/menu-citation.jpg" alt="">
        <blockquote>
          Le plus grand outrage que l'on puisse faire à un gourmand, c'est de l'interrompre dans l'exercice de ses mâchoires.
          <cite>- Alexandre Balthazar Grimod de la Reynière</cite>
        </blockquote>
      </div>
      <div class="carte">
      
          <!-- Parcourir les sections -->
          <?php foreach($tabPlatsParSection AS $nomSection => $platsSection) : ?>
          <section>
            <h2><?= $nomSection; ?></h2>
            <ul>

                <!-- Parcourir les plats dans cette section -->
                <?php foreach($platsSection AS $plat) : ?>

                <li>

                  <span><?= $plat["nomPlat"]; ?>
                    <!-- Uniquement si la description du plat n'est pas vide : -->
                    <?php if($plat["description"] != ""): ?>
                      <br><i><?= $plat["description"]; ?></i>
                    <?php endif; ?>
                  </span>

                  <span class="prix">
                    <!-- Uniquement si la portion est > 1 : -->
                    <?php if($plat["portion"] > 1): ?>
                      <i class="article-menu-portion">(pour <?= $plat["portion"]; ?> personnes)</i>
                    <?php endif; ?>
                    <?= $plat["prix"]; ?>
                  </span>

                </li>


                <!-- Fin des plats de cette section -->
                <?php endforeach; ?>
            </ul>
          </section>

          <!-- Fin des sections -->
          <?php endforeach; ?>
      </div>
    </div>
<!-- Inclure le pied de page du site -->
<?php  
  include('inclus/pied2page.php');
?>