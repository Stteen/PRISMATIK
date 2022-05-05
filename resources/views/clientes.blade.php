<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
     <!-- Favicon -->
     <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" />
      <!-- Hoja de estilos -->
      <link rel="stylesheet" href="{{ asset('css/backend-plugin.min.css') }}" />
      <link rel="stylesheet" href="{{ asset('css/backend-v=1.0.0.css') }}" />
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('/@fortawesome/fontawesome-free/css/all.min.css') }}" />
      <link rel="stylesheet" href="{{ asset('line-awesome/dist/line-awesome/css/line-awesome.min.css') }}" />
      <link rel="stylesheet" href="{{ asset('remixicon/fonts/remixicon.css') }}" />


    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>PRISMA - Clientes</title>
      
     
    
    </head>

     <!-- loader Start -->
     <!-- <div id="loading">
          <div id="loading-center">
          </div>
    </div> -->
    <!-- loader END -->

    <body>
        
        @livewire('navbar')
        
        @livewire('clientes')
    </div>
    </div>

    </div>
      </div>
    </div>
    <!-- Wrapper End-->
    <footer class="iq-footer">
            <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                                <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 text-right">
                            <span class="mr-1"><script>document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">POS Dash</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </body>
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('js/backend-bundle.min.js') }}"></script>
    
    <!-- Table Treeview JavaScript -->
    <script src="{{ asset('js/table-treeview.js') }}"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('js/customizer.js') }}"></script>
    
    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('js/chart-custom.js') }}"></script>
    
    <!-- app JavaScript -->
    <script src="{{ asset('/js/app.js') }}"></script>
  
</html>
