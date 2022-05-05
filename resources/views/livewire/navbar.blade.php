<div>
<div class="iq-sidebar  sidebar-default ">
          <div class="iq-sidebar-logo d-flex  align-items-center justify-content-between">
              <a href="{{route('welcome')}}" class="brand-logo">
                <img class="logo-abbr" src="../images/prisma.png" alt="">
            </a>
              <div class="iq-menu-bt-sidebar ml-0">
                  <i class="las la-bars wrapper-menu"></i>
              </div>
          </div>
          <div class="data-scrollbar" data-scroll="1">
              <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                      <li class=" ">
                          <a href="#product" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-wrench-adjustable-circle" viewBox="0 0 16 16">
                                <path d="M12.496 8a4.491 4.491 0 0 1-1.703 3.526L9.497 8.5l2.959-1.11c.027.2.04.403.04.61Z"/>
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0Zm-1 0a7 7 0 1 0-13.202 3.249l1.988-1.657a4.5 4.5 0 0 1 7.537-4.623L7.497 6.5l1 2.5 1.333 3.11c-.56.251-1.18.39-1.833.39a4.49 4.49 0 0 1-1.592-.29L4.747 14.2A7 7 0 0 0 15 8Zm-8.295.139a.25.25 0 0 0-.288-.376l-1.5.5.159.474.808-.27-.595.894a.25.25 0 0 0 .287.376l.808-.27-.595.894a.25.25 0 0 0 .287.376l1.5-.5-.159-.474-.808.27.596-.894a.25.25 0 0 0-.288-.376l-.808.27.596-.894Z"/>
                              </svg>
                              <span class="ml-4">Transformación</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="product" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                              <li class="">
                                  <a href="{{route('proveedores')}}">
                                      <i class="las la-minus"></i><span>Proveedores</span>
                                  </a>
                              </li>
                              <li class="">
                                <a href="{{route('productos')}}">
                                    <i class="las la-minus"></i><span>Portafolio</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{route('ordenServicio')}}">
                                    <i class="las la-minus"></i><span>Órdenes de Servicio</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#">
                                    <i class="las la-minus"></i><span>Consultar</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#">
                                    <i class="las la-minus"></i><span>Informes</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#">
                                    <i class="las la-minus"></i><span>Indicadores</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#">
                                    <i class="las la-minus"></i><span>Nuevas Órdenes</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#">
                                    <i class="las la-minus"></i><span>Despachadas</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="#">
                                    <i class="las la-minus"></i><span>En proceso</span>
                                </a>
                            </li>
                          </ul>
                      </li>
                      <li class=" ">
                          <a href="#category" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-headset" viewBox="0 0 16 16">
                                <path d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5z"/>
                              </svg>
                              <span class="ml-4">Servicio al cliente</span>
                              <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="10 15 15 20 20 15"></polyline><path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                              </svg>
                          </a>
                          <ul id="category" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                                  <li class="">
                                          <a href="{{route('clientes')}}">
                                              <i class="las la-minus"></i><span>Clientes</span>
                                          </a>
                                  </li>
                                  <li class="">
                                    <a href="#">
                                        <i class="las la-minus"></i><span>Técnicos</span>
                                    </a>
                                  </li>
                                  <li class="">
                                    <a href="#">
                                        <i class="las la-minus"></i><span>Zonas</span>
                                    </a>
                                  </li>
                                  <li class="">
                                    <a href="#">
                                        <i class="las la-minus"></i><span>Consultar</span>
                                    </a>
                                  </li>
                                  <li class="">
                                    <a href="#">
                                        <i class="las la-minus"></i><span>Pagos</span>
                                    </a>
                                  </li>
                                  <li class="">
                                    <a href="#">
                                        <i class="las la-minus"></i><span>Informes</span>
                                    </a>
                                  </li>
                                  <li class="">
                                    <a href="#">
                                        <i class="las la-minus"></i><span>Indicadores </span>
                                    </a>
                                  </li>
                          </ul>
                      </li>
                      <li class=" ">
                        <a href="#category" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
                                <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                                <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117zM11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5zM4 1.934V15h6V1.077l-6 .857z"/>
                              </svg>
                            <span class="ml-4">Cerrar Sesión</span>
                        </a>
                    </li>       
                  </ul>
              </nav>
              <div id="sidebar-bottom" class="position-relative sidebar-bottom">
                  <div class="card border-none">
                      <div class="card-body p-0">
                          <div class="sidebarbottom-content">
                              <div class="image"><img src="../images/layouts/side-bkg.png" class="img-fluid" alt="side-bkg"></div>
                              <h6 class="mt-4 px-4 body-title">Sistema de inventario<br> Prisma</h6>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="p-3"></div>
          </div>
          </div>      <div class="iq-top-navbar">
          <div class="iq-navbar-custom">
              <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                      <i class="ri-menu-line wrapper-menu"></i>
                      <a href="index.html" class="header-logo">
                          <img src="../images/logo.png" class="img-fluid rounded-normal" alt="logo">
                          <h5 class="logo-title ml-3">POSDash</h5>
      
                      </a>
                  </div>
                  <div class="iq-search-bar device-search">
                      <form action="#" class="searchbox">
                          <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                          <input type="text" class="text search-input" placeholder="Buscar...">
                      </form>
                  </div>
                  <div class="d-flex align-items-center">
                      <!--<div class="change-mode">
                          <div class="custom-control custom-switch custom-switch-icon custom-control-inline">
                              <div class="custom-switch-inner">
                                  <p class="mb-0"> </p>
                                  <input type="checkbox" class="custom-control-input" id="dark-mode" data-active="true">
                                  <label class="custom-control-label" for="dark-mode" data-mode="toggle">
                                      <span class="switch-icon-left"><i class="a-left ri-moon-clear-line"></i></span>
                                      <span class="switch-icon-right"><i class="a-right ri-sun-line"></i></span>
                                  </label>
                              </div>
                          </div>
                      </div>-->
                      <button class="navbar-toggler" type="button" data-toggle="collapse"
                          data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                          aria-label="Toggle navigation">
                          <i class="ri-menu-3-line"></i>
                      </button>
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <ul class="navbar-nav ml-auto navbar-list align-items-center">
                              <li class="nav-item nav-icon dropdown">
                                  <a href="#" class="search-toggle dropdown-toggle btn border add-btn"
                                      id="dropdownMenuButton02" data-toggle="dropdown" aria-haspopup="true"
                                      aria-expanded="false">
                                      <img src="../images/small/flag-03.png" alt="img-flag"
                                          class="img-fluid image-flag mr-2">Es
                                  </a>
                              </li>
                              <li>
                                  <a href="#" class="btn border add-btn shadow-none mx-2 d-none d-md-block">
                                      <i class="las la-plus mr-2"></i>Nueva Orden
                                  </a>
                              </li>
                              <li class="nav-item nav-icon search-content">
                                <a href="#" class="search-toggle rounded" id="dropdownSearch" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ri-search-line"></i>
                                </a>
                                  <div class="iq-search-bar iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownSearch">
                                      <form action="#" class="searchbox p-2">
                                          <div class="form-group mb-0 position-relative">
                                              <input type="text" class="text search-input font-size-12"
                                                  placeholder="type here to search...">
                                              <a href="#" class="search-link"><i class="las la-search"></i></a>
                                          </div>
                                      </form>
                                  </div>
                              </li>
                              <li class="nav-item nav-icon dropdown">
                                  <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                          fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                          stroke-linejoin="round" class="feather feather-bell">
                                          <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                          <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                      </svg>
                                      <span class="bg-primary "></span>
                                  </a>
                                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <div class="card shadow-none m-0">
                                          <div class="card-body p-0 ">
                                              <div class="cust-title p-3">
                                                  <div class="d-flex align-items-center justify-content-between">
                                                      <h5 class="mb-0">Notificaciones</h5>
                                                      <a class="badge badge-primary badge-card" href="#">3</a>
                                                  </div>
                                              </div>
                                              <div class="px-3 pt-0 pb-0 sub-card">
                                                 
                                                  <a href="#" class="iq-sub-card">
                                                      <div class="media align-items-center cust-card py-3">
                                                          <div class="">
                                                              <img class="avatar-50 rounded-small"
                                                                  src="../images/user/03.jpg" alt="03">
                                                          </div>
                                                          <div class="media-body ml-3">
                                                              <div class="d-flex align-items-center justify-content-between">
                                                                  <h6 class="mb-0">Titulo</h6>
                                                                  <small class="text-dark"><b>Fecha y hora</b></small>
                                                              </div>
                                                              <small class="mb-0">Ver toda la noticación</small>
                                                          </div>
                                                      </div>
                                                  </a>
                                              </div>
                                              <a class="right-ic btn btn-primary btn-block position-relative p-2" href="#"
                                                  role="button">
                                                  Ver Todo
                                              </a>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                              <li class="nav-item nav-icon dropdown caption-content">
                                  <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton4"
                                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <img src="../images/user/1.png" class="img-fluid rounded" alt="user">
                                  </a>
                                  <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <div class="card shadow-none m-0">
                                          <div class="card-body p-0 text-center">
                                              <div class="media-body profile-detail text-center">
                                                  <img src="../images/page-img/profile-bg.jpg" alt="profile-bg"
                                                      class="rounded-top img-fluid mb-4">
                                                  <img src="../images/user/1.png" alt="profile-img"
                                                      class="rounded profile-img img-fluid avatar-70">
                                              </div>
                                              <div class="p-3">
                                                  <h5 class="mb-1">Stiven@teclab.com.co</h5>
                                                  <p class="mb-0">Abril 2022</p>
                                                  <div class="d-flex align-items-center justify-content-center mt-3">
                                                      <a href="../app/user-profile.html" class="btn border mr-2">Perfil</a>
                                                      <a href="auth-sign-in.html" class="btn border">Cerrar Sesión</a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                          </ul>
                      </div>
                  </div>
              </nav>
          </div>
      </div>
</div>
