<header class="page-head">
    <div class="rd-navbar-wrap">
      <nav class="rd-navbar rd-navbar-default" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="53px" data-xl-stick-up-offset="53px" data-xxl-stick-up-offset="53px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
        <div class="rd-navbar-inner">
          <div class="rd-navbar-aside-wrap">
            <div class="rd-navbar-aside">
              <div class="rd-navbar-aside-toggle" data-rd-navbar-toggle=".rd-navbar-aside"><span></span></div>
              <div class="rd-navbar-aside-content">
                <ul class="rd-navbar-aside-group list-units">
                  <li>
                    <div class="unit unit-horizontal unit-spacing-xs align-items-center">
                      <div class="unit-left"><span class="novi-icon icon icon-xxs icon-primary material-icons-phone"></span></div>
                      <div class="unit-body"><a class="link-dusty-gray" href="tel:#">+55 (69) 3349–8447</a></div>
                    </div>
                  </li>
                  <li>
                    <div class="unit unit-horizontal unit-spacing-xs align-items-center">
                      <div class="unit-left"><span class="novi-icon icon icon-xxs icon-primary fa-envelope-o"></span></div>
                      <div class="unit-body"><a class="link-dusty-gray" href="mailto:#">contato@plataformaPL.com.br</a></div>
                    </div>
                  </li>
                </ul>
                <div class="rd-navbar-aside-group">
                  <ul class="list-inline list-inline-reset">
                    <li><a class="novi-icon icon icon-circle icon-nobel-filled icon-xxs-smaller fa fa-facebook" href="#"></a></li>
                    <li><a class="novi-icon icon icon-circle icon-nobel-filled icon-xxs-smaller fa fa-twitter" href="#"></a></li>
                    <li><a class="novi-icon icon icon-circle icon-nobel-filled icon-xxs-smaller fa fa-google-plus" href="#"></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="rd-navbar-group">
            <div class="rd-navbar-panel">
              <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button><a class="rd-navbar-brand brand" href=" {{ route('site.pagina.inicio') }} "><img src=" {{ asset('site/assets/images/logo-default-143x27.png') }}"  alt="" width="143" height="27"/></a>
            </div>
            <div class="rd-navbar-nav-wrap">
              <div class="rd-navbar-nav-inner">
                <div class="rd-navbar-btn-wrap"><a class="button button-smaller button-primary-outline" href="{{ route('admin.login') }}">Area do Aluno</a></div>
                <ul class="rd-navbar-nav">
                  <li class="active"><a href=" {{ route('site.pagina.inicio') }} ">Inicio</a>
                  </li>
                  <li><a href="#">Sobre nós</a>
                  </li>
                  <li><a href="#">Capacitação</a>
                  </li>
                  <li><a href="#">Mentoria</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </header>