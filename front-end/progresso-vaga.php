<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> SunSage TechPower </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/progresso.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">SunSage</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a id="logo" href="index.html" class="logo me-auto"><img id="logo" src="assets/img/sunlogo.png" alt="logo" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="index.html">Home</a></li>
          <li><a class="nav-link scrollto" href="index.html">Sustentabilidade</a></li>
          <li><a class="nav-link scrollto" href="index.html">Sobre nós</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contato</a></li>
          <li><a class="getstarted scrollto" href="vagas.html">Vagas</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->


  <section id="hero" class="d-flex align-items-center">
    <div class="center-container">
      <div class="container">
        <h2>GERENTE DE PROJETOS SUSTENTÁVEIS</h2>
      </div>
    </div>
  </section>
  <!-- End hERO -->

  <form enctype="multipart/form-data" id="form-candidato" method="POST" action="../conexão/add_candidato.php">
    <div class="container-prog">
      <img src="assets/img/progressinho.png">
      <article>
        <h3>Currículo</h3>
        <p>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."
          "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."
          "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."
        <div class="anexar"> <input type="file" id="curriculo" name="curriculo" multiple></div>

        <label for="vaga">Vaga:</label>
        <select class="vaga" id="vaga" name="vaga" required>
          <option value="">Selecione a vaga</option>

          <?php

          // conexão com o banco de dados
          $conexao = new mysqli('localhost', 'root', '', 'sunsage_db');
          if ($conexao->connect_error) {
            die("Erro de conexão: " . $conexao->connect_error);
          }

          // atribui a uma variável uma query com todas as vagas
          $query = "SELECT id, nome, vagas_livres FROM vaga";
          $result = $conexao->query($query);

          // enquanto houver vagas disponíveis, imprime o nome da vaga e quantas vagas estão abertas
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              if ($row["vagas_livres"] > 0)
                echo "<option value='" . $row['id'] . "'>" . $row['nome'] . " - Vagas abertas: " . $row['vagas_livres'] . "</option>";
              continue;
            }
          } else {
            echo "<option disabled>Nenhuma vaga disponível</option>";
          }

          // fecha a conexão
          $conexao->close();
          ?>

        </select>

      </article>
    </div>


    <div class="container-progg">
      <article class="forms-vaga">
        <h3>Dados Pessoais</h3>
        <div class="input-group">
          <label for="nome">Nome Completo:</label>
          <input type="text" id="nome" name="nome" placeholder="Digite seu Nome">
        </div>
        <div class="input-group">
          <label for="cpf">CPF:</label>
          <input type="text" id="cpf" name="cpf" placeholder="Digite seu CPF">
        </div>
        <div class="input-group">
          <label for="email">E-Mail:</label>
          <input type="text" id="email" name="email" placeholder="Digite seu E-Mail">
        </div>
        <div class="input-group">
          <label for="telefone">Telefone:</label>
          <input type="text" id="telefone" name="telefone" placeholder="Digite seu Telefone">
        </div>
      </article>

    </div>
    <label class="politica-site">
    <input class="check-check" type="checkbox" name="aceitar" required>
    Ao clicar aqui você concorda com nossa <a href="política.html">Política e Privacidade</a>
    </label>
    <button type="submit" name="submit">Salvar e Continuar</button>

  </form>
  <!-- ======= Footer ======= -->
  <footer id="footer">

  

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Sunsage</h3>
            <p>
              Rua Itaquera <br>
              Vila Barão, 18550-320 <br>
              Brasil <br><br>
              <strong>Phone:</strong> +55 15 998765439<br>
              <strong>Email:</strong> sunsage.contato@gmail.com<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Links Úteis</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Sobre nós</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Portifólio</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Contato</a></li>
            </ul>
          </div>

       

          <div class="col-lg-3 col-md-6 footer-links">
            <h4> Nossas Redes Sociais</h4>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>Arsha</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer>
  <script src="assets/js/main.js"></script>
  </body>
  </html>