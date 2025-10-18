!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Médilink - Simplifiez vos rendez-vous médicaux</title>

  <!-- Libs -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet"/>

  <style>
    /* ===== Base ===== */
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color:#f8f9fa; }
    .navbar { background-color:#005BAC; }
    .navbar a { color:#fff !important; font-weight:500; }
    .navbar-brand { font-family:'Pacifico', cursive; font-size:2rem; color:#fff !important; margin-right:30px; }

    /* ✅ Correction du menu déroulant Bootstrap */
    .dropdown-menu {
      background-color: #fff; 
      border: none;
      border-radius: 8px;
    }
    .dropdown-menu .dropdown-item {
      color: #005BAC !important;
      font-weight: 500;
      padding: 10px 15px;
      transition: background-color 0.3s;
    }
    .dropdown-menu .dropdown-item:hover {
      background-color: #003f7f;
    }

    .hero { background-color:#1063a8ff; padding:140px 0; }
    .hero h1 { font-size:2.8rem; font-weight:bold; color:#ffffffff; }
    .hero p { font-size:1.2rem; color:#ffebebff; }
    .search-box { background:#fff; border-radius:12px; padding:20px; margin-top:30px; box-shadow:0 4px 10px rgba(0,0,0,.1); }
    .hero img { max-width:100%; border-radius:15px; box-shadow:0 6px 15px rgba(0,0,0,.1); }

    .stats { background-color:#002D62; padding:30px 0; color:#fff; }
    .stats h2 { font-size:2rem; font-weight:bold; color:#fff; }

    .services { background-color:#f1f7fc; padding:60px 0; }
    .service-box { background:#fff; padding:25px; border-radius:12px; box-shadow:0 3px 8px rgba(0,0,0,.1); transition:all .3s ease-in-out; cursor:pointer; }
    .service-box:hover { transform:translateY(-8px); }

    .specialites { padding:60px 0; }
    .specialite-card { border:1px solid #e1e1e1ff; border-radius:12px; padding:20px; text-align:center; transition:all .3s ease; background:#fff; }
    .specialite-card:hover { background:#005BAC; color:#fff; transform:translateY(-5px); }

    .testimonials { padding:60px 0; background-color:#074285ff; }
    .testimonial-card { background:#fff; padding:25px; border-radius:12px; box-shadow:0 3px 8px rgba(255,255,255,.1); text-align:center; height:100%; }
    .testimonial-card img { border-radius:50%; margin-bottom:15px; }

    .cta { 
      background:linear-gradient(rgba(255,255,255,.85), rgba(255,255,255,.85)), 
                 url('https://source.unsplash.com/1600x500/?hospital,doctor') no-repeat center/cover;
      color:#000; text-align:center; padding:80px 150px;
    }
    .cta h2 { font-size:2.5rem; font-weight:bold; }
    .cta a { margin-top:20px; border-radius:50px; padding:12px 30px; font-size:1.2rem; }

    /* ===== Bloc "Pourquoi choisir Médilink ?" — style Doctolib ===== */
    .why-like-doctolib { background:#fff; padding:72px 0; }
    .why-like-doctolib .why-title { font-weight:800; font-size:2rem; color:#0b1f3b; margin-bottom:8px; }
    .why-like-doctolib .why-subtitle { font-size:1rem; color:#6c7a89; margin-bottom:18px; }

    .why-like-doctolib .why-list { list-style:none; padding:0; margin:0 0 16px 0; }
    .why-like-doctolib .why-list li {
      position:relative; padding-left:28px; margin:10px 0; font-size:1.05rem; color:#273140;
    }
    .why-like-doctolib .why-list li::before {
      content:"➜"; position:absolute; left:0; top:0; line-height:1.1; font-weight:800; color:#FDB813;
    }

    .why-like-doctolib .cta-btn { border-radius:999px; padding:12px 22px; font-weight:600; background-color:#005BAC; border:none; }

    .why-like-doctolib .blob-wrap { position:relative; max-width:520px; margin:0 auto; }
    .why-like-doctolib .blob-shape {
      width:100%; height:auto; object-fit:cover;
      border-radius:42% 58% 55% 45% / 50% 45% 55% 50%;
      box-shadow:0 12px 28px rgba(0,0,0,.12);
      position:relative; z-index:2;
    }
    .why-like-doctolib .blob-wrap::before,
    .why-like-doctolib .blob-wrap::after {
      content:""; position:absolute; z-index:1; border-radius:50%; opacity:.12;
    }
    .why-like-doctolib .blob-wrap::before { width:180px; height:180px; background:#005BAC; left:-24px; top:-28px; }
    .why-like-doctolib .blob-wrap::after  { width:140px; height:140px; background:#0aa0ff; right:-20px; bottom:-20px; }

    @media (max-width: 991.98px) {
      .why-like-doctolib .why-title, .why-like-doctolib .why-subtitle { text-align:center; }
      .why-like-doctolib .cta-btn { display:block; margin:14px auto 0; }
    }
  </style>
</head>


<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">Médilink</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Accueil</a></li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Parcourir</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('medecins.index') }}">Médecins</a></li>
            <li><a class="dropdown-item" href="{{ route('specialites.index') }}">Spécialités</a></li>
            <li><a class="dropdown-item" href="{{ route('centres-sante.index') }}">Centres de santé</a></li>
          </ul>
        </li>

        <li class="nav-item"><a class="nav-link" href="#">Aide</a></li>
        <li class="nav-item"><a class="nav-link" href="#">Inscrire un cabinet</a></li>
      </ul>

      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Se connecter</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Patient</a></li>
            <li><a class="dropdown-item" href="#">Médecin</a></li>
            <li><a class="dropdown-item" href="#">Infirmier</a></li>
            <li><a class="dropdown-item" href="#">Administrateur</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">S'inscrire</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('register.patient') }}">Patient</a></li>
            <li><a class="dropdown-item" href="#">Médecin</a></li>
            <li><a class="dropdown-item" href="#">Infirmier</a></li>
            <li><a class="dropdown-item" href="#">Administrateur</a></li>
          </ul>
        </li>

        <li class="nav-item"><a class="nav-link" href="#">À propos</a></li>
      </ul>
    </div>
  </div>
</nav>


  <!-- Hero -->
  <section class="hero mt-3" style="background:url('images/illustration_santé.png') no-repeat center/cover; position:relative; min-height:500px;">
    <div class="overlay" style="position:absolute; inset:0; background:rgba(16,99,168,.7);"></div>
    <div class="container position-relative" style="z-index:2;">
      <div class="row align-items-center">
        <div class="col-md-6 text-white" data-aos="fade-right">
          <h1>Facilitez vos rendez-vous médicaux</h1>
          <p>Réservez vos rendez-vous, accédez à vos dossiers et gagnez du temps avec Médilink.</p>
          <div class="search-box">
            <div class="row g-2">
              <div class="col-md-3"><input type="text" class="form-control" placeholder="Nom, spécialité, établissement"/></div>
              <div class="col-md-2"><input type="text" class="form-control" placeholder="Pays, ville, quartier"/></div>
              <div class="col-md-2"><input type="text" class="form-control" placeholder="Assurance"/></div>
              <div class="col-md-2"><input type="text" class="form-control" placeholder="N°Assurance"/></div>
              <div class="col-md-3"><button class="btn w-100 text-white" style="background-color:#005BAC;">🔍 Rechercher</button></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ======= Pourquoi choisir Médilink ? (style Doctolib, fond blanc) ======= -->
  <section class="why-like-doctolib">
    <div class="container">
      <div class="row align-items-center g-4">
        <!-- Image à gauche -->
        <div class="col-md-5" data-aos="fade-right">
          <div class="blob-wrap">
            <img src="{{('images/medilink_why.png')}}" alt="Pourquoi choisir Médilink" class="img-fluid blob-shape"/>
          </div>
        </div>

        <!-- Texte à droite -->
        <div class="col-md-7" data-aos="fade-left">
          <h2 class="why-title">Pourquoi choisir Médilink&nbsp;?</h2>
          <div class="why-subtitle">Découvrez Médilink et simplifiez votre parcours de soins au quotidien</div>

          <ul class="why-list">
            <li>Dispensez/recevez les meilleurs soins grâce à une organisation claire des rendez-vous</li>
            <li>Gagnez du temps avec des rappels et un suivi automatisé des soins</li>
            <li>Augmentez l’efficacité de votre activité avec des outils simples et sécurisés</li>
            <li>Vos données sont protégées selon des standards de confidentialité médicale</li>
          </ul>

          <a href="#" class="btn btn-primary cta-btn">Je m’inscris maintenant</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Statistiques -->
  <section class="stats">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-3 text-start"><h2>Médilink en chiffres</h2></div>
        <div class="col-md-3 text-center"><h2>200+</h2><p>Médecins inscrits</p></div>
        <div class="col-md-3 text-center"><h2>5,000+</h2><p>Patients actifs</p></div>
        <div class="col-md-3 text-center"><h2>12,000+</h2><p>Rendez-vous planifiés</p></div>
      </div>
    </div>
  </section>

  <!-- Votre compagnon de santé -->
  <section class="py-5" style="background:#fff;">
    <div class="container text-center">
      <h2 class="fw-bold mb-5" style="color:#003366;">Votre compagnon de santé au quotidien</h2>
      <div class="row g-4">
        <div class="col-md-4" data-aos="fade-up">
          <img src="https://img.icons8.com/color/96/000000/calendar--v1.png" alt="Simplicité" width="80"/>
          <h5 class="fw-bold mt-3">Accédez aux soins plus facilement</h5>
          <p class="text-muted">Réservez des consultations vidéo ou en présentiel, et recevez des rappels pour ne jamais les manquer.</p>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
          <img src="https://img.icons8.com/color/96/000000/chat--v1.png" alt="Soins personnalisés" width="80"/>
          <h5 class="fw-bold mt-3">Bénéficiez de soins personnalisés</h5>
          <p class="text-muted">Échangez avec vos soignants par message, obtenez des conseils préventifs et recevez des soins adaptés quand vous en avez besoin.</p>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
          <img src="https://img.icons8.com/color/96/000000/heart-with-pulse--v1.png" alt="Santé" width="80"/>
          <h5 class="fw-bold mt-3">Gérez votre santé</h5>
          <p class="text-muted">Rassemblez facilement toutes vos informations médicales et celles de vos proches pour un suivi optimal.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Services -->
  <section class="services">
    <div class="container">
      <h2 class="text-center">Nos services principaux</h2>
      <div class="row g-4 mt-4">
        <div class="col-md-4"><div class="service-box text-center"><h5>🗂 Dossier médical partagé</h5><p>Accédez et partagez vos dossiers médicaux en toute sécurité.</p></div></div>
        <div class="col-md-4"><div class="service-box text-center"><h5>💳 Facturation simplifiée</h5><p>Gérez vos factures médicales en ligne en toute simplicité.</p></div></div>
        <div class="col-md-4"><div class="service-box text-center"><h5>🏥 Gestion des assurances</h5><p>Vérifiez et utilisez vos assurances directement via la plateforme.</p></div></div>
        <div class="col-md-6"><div class="service-box text-center"><h5>📅 Rendez-vous rapides</h5><p>Réservez en quelques clics vos rendez-vous avec des spécialistes.</p></div></div>
        <div class="col-md-6"><div class="service-box text-center"><h5>💬 Communication médecin-patient</h5><p>Échangez directement avec vos soignants pour un meilleur suivi.</p></div></div>
      </div>
    </div>
  </section>

  <!-- Votre santé, vos données -->
  <section class="py-5" style="background-color:#f1f7fc;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-5 text-center" data-aos="fade-right">
          <img src="{{('images/Soins_personnalisés.png')}}" alt="Soins_personnalisés" class="img-fluid rounded shadow"/>
        </div>
        <div class="col-md-6" data-aos="fade-left">
          <h2 class="fw-bold" style="color:#002D62;">Votre santé. Vos données.</h2>
          <p class="text-muted">La confidentialité de vos informations personnelles est une priorité absolue pour Médilink et guide notre action au quotidien.</p>
          <a href="#" class="btn btn-primary px-5 py-2 mt-3" style="border-radius:15px;">Découvrir nos engagements</a>
        </div>
      </div>
    </div>
  </section>

<!-- Spécialités -->
<section class="specialites py-5" style="background-color:#f9fbff;">
  <div class="container">
    <h2 class="text-center mb-5 fw-bold" style="color:#003366;">🌿Quelques Spécialités médicales disponible </h2>
    <div class="row g-4">
      
      <div class="col-md-3 col-sm-6" data-aos="zoom-in">
        <div class="specialite-card text-center p-4 shadow-sm">
          <img src="images/cardio.png" alt="Cardiologie" width="70" height="70" class="mb-3">
          <h6 class="fw-bold text-dark">Cardiologie</h6>
          <p class="text-muted small">Soins du cœur et du système circulatoire.</p>
        </div>
      </div>

      <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="100">
        <div class="specialite-card text-center p-4 shadow-sm">
          <img src="images/dermato.png" alt="Dermatologie" width="70" height="70" class="mb-3">
          <h6 class="fw-bold text-dark">Dermatologie</h6>
          <p class="text-muted small">Soins de la peau, des cheveux et des ongles.</p>
        </div>
      </div>

      <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="200">
        <div class="specialite-card text-center p-4 shadow-sm">
          <img src="images/pediatrie.png" alt="Pédiatrie" width="70" height="70" class="mb-3">
          <h6 class="fw-bold text-dark">Pédiatrie</h6>
          <p class="text-muted small">Suivi et soins des enfants et nourrissons.</p>
        </div>
      </div>

      <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="300">
        <div class="specialite-card text-center p-4 shadow-sm">
          <img src="images/gyneco.png" alt="Gynécologie" width="70" height="70" class="mb-3">
          <h6 class="fw-bold text-dark">Gynécologie</h6>
          <p class="text-muted small">Santé et bien-être des femmes.</p>
        </div>
      </div>

      <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="400">
        <div class="specialite-card text-center p-4 shadow-sm">
          <img src="images/neuro.png" alt="Neurologie" width="70" height="70" class="mb-3">
          <h6 class="fw-bold text-dark">Neurologie</h6>
          <p class="text-muted small">Soins du cerveau et du système nerveux.</p>
        </div>
      </div>

      <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="500">
        <div class="specialite-card text-center p-4 shadow-sm">
          <img src="images/dentaire.png" alt="Dentisterie" width="70" height="70" class="mb-3">
          <h6 class="fw-bold text-dark">Dentisterie</h6>
          <p class="text-muted small">Soins et hygiène bucco-dentaire.</p>
        </div>
      </div>

      <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="600">
        <div class="specialite-card text-center p-4 shadow-sm">
          <img src="images/ophta.png" alt="Ophtalmologie" width="70" height="70" class="mb-3">
          <h6 class="fw-bold text-dark">Ophtalmologie</h6>
          <p class="text-muted small">Santé des yeux et correction visuelle.</p>
        </div>
      </div>

      <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="700">
        <div class="specialite-card text-center p-4 shadow-sm">
          <img src="images/pneumo.png" alt="Pneumologie" width="70" height="70" class="mb-3">
          <h6 class="fw-bold text-dark">Pneumologie</h6>
          <p class="text-muted small">Soins des poumons et du système respiratoire.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<style>
  .specialite-card {
    background: white;
    border-radius: 15px;
    transition: all 0.4s ease;
    border: 1px solid #e1e1e1;
  }
  .specialite-card:hover {
    background-color: #005BAC;
    color: white !important;
    transform: translateY(-8px);
    box-shadow: 0px 6px 20px rgba(0, 91, 172, 0.3);
  }
  .specialite-card:hover p {
    color: #e8e8e8 !important;
  }
  .specialite-card img {
    filter: drop-shadow(0px 3px 6px rgba(0,0,0,0.1));
}
</style>


  <!-- Témoignages -->
  <section class="testimonials">
    <div class="container">
      <h2 class="text-center fw-bold mb-5" style="color:#fff;">Avis des utilisateurs</h2>
      <div class="row g-4">
        <div class="col-md-4" data-aos="zoom-in">
          <div class="testimonial-card">
            <img src="https://randomuser.me/api/portraits/women/45.jpg" width="80" height="80" alt="">
            <p>"Grâce à Médilink, j’ai réservé un rendez-vous en quelques minutes."</p>
            <h6>Afi K.</h6><p>Patient</p>
            <div style="color:#FFD700;">⭐⭐⭐⭐⭐</div>
          </div>
        </div>
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
          <div class="testimonial-card">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" width="80" height="80" alt="">
            <p>"Médilink me permet d’organiser mes rendez-vous efficacement."</p>
            <h6>Dr. Komlan A.</h6><p>Médecin</p>
            <div style="color:#FFD700;">⭐⭐⭐⭐</div>
          </div>
        </div>
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
          <div class="testimonial-card">
            <img src="https://randomuser.me/api/portraits/women/68.jpg" width="80" height="80" alt="">
            <p>"Je peux suivre les dossiers médicaux de mes enfants facilement."</p>
            <h6>Akouvi D.</h6><p>Parent</p>
            <div style="color:#FFD700;">⭐⭐⭐⭐⭐</div>
          </div>
        </div>
        <div class="col-md-6" data-aos="zoom-in" data-aos-delay="600">
          <div class="testimonial-card">
            <img src="https://randomuser.me/api/portraits/men/44.jpg" width="80" height="80" alt="">
            <p>"Avec Médilink, je gère plus facilement mes patients et mes dossiers médicaux."</p>
            <h6>Yao M.</h6><p>Infirmier</p>
            <div style="color:#FFD700;">⭐⭐⭐</div>
          </div>
        </div>
        <div class="col-md-6" data-aos="zoom-in" data-aos-delay="800">
          <div class="testimonial-card">
            <img src="https://randomuser.me/api/portraits/women/29.jpg" width="80" height="80" alt="">
            <p>"Notre centre de santé gagne du temps et améliore la prise en charge grâce à Médilink."</p>
            <h6>Komi A.</h6><p>Administratrice</p>
            <div style="color:#FFD700;">⭐⭐⭐⭐⭐</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="cta">
    <div class="container">
      <h2>Prenez rendez-vous dès aujourd’hui en ligne</h2>
      <p class="lead">Un accès simple et rapide aux meilleurs spécialistes près de chez vous.</p>
      <a href="#" class="btn btn-light btn-lg">Commencer maintenant</a>
    </div>
  </section>

  <!-- Centre de santé -->
  <section class="services" style="background-color:#002D62; color:#fff;">
    <div class="container text-center">
      <h2 class="mb-4">Vous êtes un centre de santé ?</h2>
      <p class="mb-4">Rejoignez Médilink et simplifiez la gestion de vos patients et rendez-vous.</p>
      <a href="#" class="btn btn-light btn-lg" style="border-radius:50px;">Inscrire mon centre</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="text-center py-3 bg-light">
    <p class="mb-0 text-muted">© 2025 Médilink - Tous droits réservés.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script> AOS.init({ duration:1000, once:true }); </script>
</body>
</html>
