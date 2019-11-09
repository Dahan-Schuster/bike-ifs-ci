<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#Introdução">Introdução</a></li>
    <li class="breadcrumb-item"><a href="#Informações">Informações Úteis</a></li>
  </ol>
</nav>
<div class="jumbotron jumbotron-fluid jumbotron-main">
  <div class="container">
    <div id="Introdução">
      <div style="text-align: center;">
        <div class="heading-home">
          <h1><span class="mu-0">
              <img class="icon-home" src="<?= base_url() ?>public/img/icon.svg" alt="icone bike ifs"> Bike IFS
            </span></h1>
        </div>
        <p class="lead text-light" style="font-size: 2rem;">
          Sistema de controle e gerenciamento de entrada e saída do bicicletário do
          Instituto Federal de Educação, Ciência e Tecnologia de Sergipe
        </p>
      </div>
      <hr class="my-4 bg-light">
      <img src="<?= base_url() ?>public/img/img-logo.png" class="img-fluid figure-img img-home float-left" alt="Logo Bike-IFS">
      <br>
      <p class="p-home">
        O Bike-IFS é um sistema feito como projeto de Trabalho de Conclusão de Curso (TCC) da disciplina de Informática do aluno
        Dahan Poiel Lima Schuster, em conjunto coms os esforços da orientadora Leila Buarque Couto de Matos, do cooorientador
        Fábio de Melo - ambos professores do IFS - e de outras pessoas que se dispuseram a ajudar o trabalho.
      </p>
      <img src="<?= base_url() ?>public/img/ifs-logo.png" class="img-fluid figure-img img-thumbnail img-home float-right" alt="Logo IFS">
      <br>
      <p class="p-home">
        O objetivo do sistema é garantir uma boa experiência aos usuários do bicicletário do Instituto, utilizando a Informática e a Eletrônica
        como meios para este fim.
        De uma forma geral, o Bike-IFS serve ao funcionário que registra as entradas e saídas, possibilitando o
        cadastro, a edição e a exclusão de usuários, bicicletas e outras entidades de forma rápida e segura; ao administrador que visualiza e
        gerencia os relatórios de uso do sistema e aos usuários que frequentam o bicicletário e desejam verificar seus dados, suas
        bicicletas cadastradas e seus históricos de registros.
      </p>
      <br>
      <hr class="my-4 bg-light">
    </div>
    <div id="Informações">
      <h1 class="text-light">Modelos de bicicletas</h1>
      <p class="p-home">Confira aqui exemplos dos modelos de bicicletas listados na tela de cadastro.</p>
      <div class="bd-example">
        <div id="carouselBikes" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselBikes" data-slide-to="0" class="active"></li>
            <li data-target="#carouselBikes" data-slide-to="1"></li>
            <li data-target="#carouselBikes" data-slide-to="2"></li>
            <li data-target="#carouselBikes" data-slide-to="3"></li>
            <li data-target="#carouselBikes" data-slide-to="4"></li>
            <li data-target="#carouselBikes" data-slide-to="5"></li>
            <li data-target="#carouselBikes" data-slide-to="6"></li>
            <li data-target="#carouselBikes" data-slide-to="7"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="<?= base_url() ?>public/img/urban-bike.jpg" class="d-block w-100" alt="Bicicleta Urbana">
              <div class="carousel-caption d-none d-md-block">
                <h3>Bicicleta Urbana</h3>
                <p>Modelo mais comum nas cidades. Pode apresentar variações como cestinha, guidão estendido etc.</p>
                <caption>Foto: <i>David Niddrie</i>
                  <caption>
              </div>
            </div>
            <div class="carousel-item">
              <img src="<?= base_url() ?>public/img/folding-bike.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h3>Bicicleta dobrável</h3>
                <p>Tipo de bicicleta que pode ser dobrada e guardada em locais pequenos. Geralmente são pequenas em altura.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="<?= base_url() ?>public/img/fixie-bike.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h3>Bicicleta fixa</h3>
                <p>Modelo de bicicleta sem freios. A tração e a frenagem são realizados ao pedalar para frente ou para trás.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="<?= base_url() ?>public/img/mountain-bike.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h3><i>Mountain Bike</i></h3>
                <p>Bicicleta de montanha, ótima para qualquer terreno. Possui guidão reto e visual semelhante às bicicletas <i>speed</i></p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="<?= base_url() ?>public/img/speed-bike.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h3>Bicicleta <i>Speed</i></h3>
                <p>Bicicleta de corrida com visual leve e pneus finos.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="<?= base_url() ?>public/img/bmx-bike.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h3>BMX</h3>
                <p>Bicicletas pequenas indicadas para a prática do <i>bicicross</i>, mas também utilizadas como meio de transporte.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="<?= base_url() ?>public/img/downhill-bike.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h3>Bicicleta de <i>Downhill</i></h3>
                <p>Bicicletas utilizadas em descidas de colinas, ou <i>downhill</i>. São pesadas, cheias de suspensão e possuem design diferenciado.</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="<?= base_url() ?>public/img/e-bike.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h3>Bicicleta elétrica (<i>E-Bike</i>)</h3>
                <p>Bicicletas com baterias elétricas recarregáveis. Podem ser conduzidas sem necessidade de pedalar. Existem diversos
                  modelos, desde bicicletas urbanas a dobráveis, porém o fato de haver uma bateria elétrica as classifica como <i>E-Bikes</i>
                </p>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselBikes" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselBikes" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>