<?php
// Aquí puedes incluir tu archivo de configuración de la base de datos si lo tienes
// require_once 'config.php';

// Realiza cualquier procesamiento necesario para obtener el nuevo contenido
$contenido = "
<div class='container-fluid px-0 mb-5'>
  <div id='header-carousel' class='carousel slide' data-bs-ride='carousel'>
    <div class='carousel-inner'>
      <div class='carousel-item active'>
        <img class='w-100' src='img/metro.jpg' alt='Image'>
        <div class='carousel-caption'>
          <div class='container'>
            <div class='row justify-content-center'>
              <div class='col-lg-15 text-start'>
                <h3 class='display-1 text-white mb-5 animated slideInRight'>Metro de Valencia</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class='carousel-item'>
        <img class='w-100' src='img/metro2.jpg' alt='Image'>
        <div class='carousel-caption'>
          <div class='container'>
            <div class='row justify-content-center'>
              <div class='col-lg-15 text-start'>
                <h3 class='display-1 text-white mb-5 animated slideInRight'>Metro de Valencia</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <button class='carousel-control-prev' type='button' data-bs-target='#header-carousel' data-bs-slide='prev'>
      <span class='carousel-control-prev-icon' aria-hidden='true'></span>
      <span class='visually-hidden'>Atras</span>
    </button>
    <button class='carousel-control-next' type='button' data-bs-target='#header-carousel' data-bs-slide='next'>
      <span class='carousel-control-next-icon' aria-hidden='true'></span>
      <span class='visually-hidden'>Siguiente</span>
    </button>
  </div>
</div>
<!-- Carousel End -->


<!-- About Start -->
<div class='container-xxl py-5'>
  <div class='container'>
    <div class='row g-2'>
      <div class='col-lg-6'>
        <div class='row gx-3 h-100'>
          <div class='col-6 align-self-start wow fadeInUp' data-wow-delay='0.1s'>
            <img class='img-fluid' src='img/img3.jpg'>
          </div>
          <div class='col-6 align-self-end wow fadeInDown' data-wow-delay='0.1s'>
            <img class='img-fluid' src='img/img5.jpg'>
          </div>
        </div>
      </div>
      <div class='col-lg-6 wow fadeIn' data-wow-delay='0.5s'>
        <h1 class='display-5 mb-4'>Familia Metro Valencia</h1>
        <p class='mb-4'>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et
          eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet
        </p>
        <div class='d-flex align-items-center mb-4'>
          <div class='flex-shrink-0 bg-primary p-4'>
            <h1 class='display-2 text-white'>17</h1>
            <h5 class='text-white'>Años</h5>
            <h5 class='text-white'>de experiencia</h5>
          </div>
          <div class='ms-4'>
            <p><i class='fa fa-check text-primary me-2'></i>Power & Energy</p>
            <p><i class='fa fa-check text-primary me-2'></i>Civil Engineering</p>
            <p><i class='fa fa-check text-primary me-2'></i>Chemical Engineering</p>
            <p><i class='fa fa-check text-primary me-2'></i>Mechanical Engineering</p>
            <p class='mb-0'><i class='fa fa-check text-primary me-2'></i>Oil & Gas Engineering</p>
          </div>
        </div>            
      </div>
    </div>
  </div>
</div>
<!-- About End -->

<!-- Features Start -->
<div class='container-xxl py-5'>
  <div class='container'>
    <div class='row g-5 align-items-center'>
      <div class='col-lg-6 wow fadeInUp' data-wow-delay='0.1s'>
        <div class='position-relative me-lg-4'>
          <img class='img-fluid w-150' src='img/img2.jpg' alt=''>
        </div>
      </div>
      <div class='col-lg-6 wow fadeInUp' data-wow-delay='0.5s'>
        <h1 class='display-5 mb-4'>Comprometidos con la ciudad!</h1>
        <p class='mb-4'>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et
          eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet
        </p>
        <div class='row gy-4'>
          <div class='col-12'>
            <div class='d-flex'>
              <div class='flex-shrink-0 btn-lg-square rounded-circle bg-primary'>
                <i class='fa fa-check text-white'></i>
              </div>
              <div class='ms-4'>
                <h4>Experienced Workers</h4>
                <span>Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna
                  dolore erat amet</span>
              </div>
            </div>
          </div>
          <div class='col-12'>
            <div class='d-flex'>
              <div class='flex-shrink-0 btn-lg-square rounded-circle bg-primary'>
                <i class='fa fa-check text-white'></i>
              </div>
              <div class='ms-4'>
                <h4>Reliable Industrial Services</h4>
                <span>Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna
                  dolore erat amet</span>
              </div>
            </div>
          </div>
          <div class='col-12'>
            <div class='d-flex'>
              <div class='flex-shrink-0 btn-lg-square rounded-circle bg-primary'>
                <i class='fa fa-check text-white'></i>
              </div>
              <div class='ms-4'>
                <h4>24/7 Customer Support</h4>
                <span>Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna
                  dolore erat amet</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Features End -->


<!-- Video Modal Start -->
<div class='modal modal-video fade' id='videoModal' tabindex='-1' aria-labelledby='exampleModalLabel'
  aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content rounded-0'>
      <div class='modal-header'>
        <h3 class='modal-title' id='exampleModalLabel'>Youtube Video</h3>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
        <!-- 16:9 aspect ratio -->
        <div class='ratio ratio-16x9'>
          <iframe class='embed-responsive-item' src='' id='video' allowfullscreen allowscriptaccess='always'
            allow='autoplay'></iframe>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Video Modal End -->


<!-- Service Start -->
<div class='container-xxl py-5'>
  <div class='container'>
    <div class='text-center mx-auto pb-4 wow fadeInUp' data-wow-delay='0.1s' style='max-width: 600px;'>
      <h1 class='display-5 mb-4'>Sobre Nosotros</h1>
    </div>
    <div class='row gy-5 gx-4'>
      <div class='col-md-6 col-lg-6 wow fadeInUp' data-wow-delay='0.1s'>
        <div class='service-item'>
          <img class='img-fluid' src='img/service-1.jpg' alt=''>
          <div class='service-img'>
            <img class='img-fluid' src='img/service-1.jpg' alt=''>
          </div>
          <div class='service-detail'>
            <div class='service-title'>
              <hr class='w-25'>
              <h3 class='mb-0'>Misión</h3>
              <hr class='w-25'>
            </div>
            <div class='service-text'>
              <p class='text-white mb-0'>Somos una empresa pública que presta el servicio
                de transporte masivo de pasajeros, de forma segura, rápida, confortable y
                confiable, mediante la administración, explotación, construcción e instalación
                de obras y equipos, tanto de infraestructura como de superestructura y sistemas
                de transportes complementarios o auxiliares para contribuir a la calidad de vida
                de la comunidad de la región.</p>
            </div>
          </div>
        </div>
      </div>
      <div class='col-md-6 col-lg-6 wow fadeInUp' data-wow-delay='0.3s'>
        <div class='service-item'>
          <img class='img-fluid' src='img/service-2.jpg' alt=''>
          <div class='service-img'>
            <img class='img-fluid' src='img/service-2.jpg' alt=''>
          </div>
          <div class='service-detail'>
            <div class='service-title'>
              <hr class='w-25'>
              <h3 class='mb-0'>Visión</h3>
              <hr class='w-25'>
            </div>
            <div class='service-text'>
              <p class='text-white mb-0'>Consolidarnos como el servicio de transporte estratégico líder
                en el traslado rápido, seguro y eficiente de los usuarios, fundamentado en nuestros
                valores de servicio, bienestar y desarrollo de la comunidad, apoyados en tecnologías
                que garanticen un servicio confiable, respaldado por un recurso humano altamente calificado
                y comprometido con el rol protagónico otorgado por la sociedad, orientados en políticas
                sociales para el beneficio de los ciudadanos y ciudadanas.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>";

// Devuelve el nuevo contenido como respuesta
echo $contenido;
?>
