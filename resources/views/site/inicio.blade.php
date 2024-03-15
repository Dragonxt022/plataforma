@extends('site.templete')  
@section('content')

@section('title', 'Inicio - Grupo Incap')

<div class="page">

    {{-- BANNER PRINCIPAL --}}
    <section>
      <div class="swiper-container swiper-slider swiper-variant-1 bg-black" data-loop="false" data-autoplay="4000" data-simulate-touch="true">

        {{-- Banners da pagina de inicio --}}
        <div class="swiper-wrapper text-center">
            @foreach($banners as $banner)
            <div class="swiper-slide" data-slide-bg="{{ asset('upload/admin_banner/' . $banner->img_banner) }}">
                {{-- <div class="swiper-slide-caption text-center">
                    <div class="container">
                        <div class="row justify-content-md-center">
                            <div class="col-md-11 col-lg-10 col-xl-9">
                                <div class="header-decorated" data-caption-animate="fadeInUp" data-caption-delay="0s">
                                    <h3 class="medium text-primary">{{ $banner->titulo }}</h3>
                                </div>
                                <h2 class="slider-header" data-caption-animate="fadeInUp" data-caption-delay="150">{{ $banner->subtitulo }}</h2>
                                <p class="text-bigger slider-text" data-caption-animate="fadeInUp" data-caption-delay="250">{{ $banner->paragrafo }}</p>
                                <div class="button-block" data-caption-animate="fadeInUp" data-caption-delay="400"><a class="button button-lg button-primary-outline-v2" href="{{ $banner->link_botao }}">Request a Free Consultation</a></div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            @endforeach
        </div>
      
        <div class="swiper-scrollbar d-lg-none"></div>
        <div class="swiper-nav-wrap">
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>
      </div>
    </section>

    {{-- 3 BLOCOS DE INTRODUÇÃO --}}
    <section class="section-50 section-md-75 section-lg-100">
      <div class="container">
          <div class="row row-40">
              <div class="col-md-6 col-lg-4 height-fill">
                  <article class="icon-box">
                      <div class="box-top">
                          <div class="box-icon"><span class="novi-icon icon icon-primary icon-lg mercury-icon-briefcase"></span></div>
                          <div class="box-header">
                              <h5><a href="#">Automação de Vendas de Eventos</a></h5>
                          </div>
                      </div>
                      <div class="divider bg-accent"></div>
                      <div class="box-body">
                          <p>Oferecemos soluções de automação para a venda de eventos presenciais. Nosso sistema permite gerenciar inscrições, criar listas de chamada, imprimir relatórios e gerar certificados para todos os participantes dos cursos cadastrados.</p>
                      </div>
                  </article>
              </div>
              <div class="col-md-6 col-lg-4 height-fill">
                  <article class="icon-box">
                      <div class="box-top">
                          <div class="box-icon"><span class="novi-icon icon icon-primary icon-lg mercury-icon-users"></span></div>
                          <div class="box-header">
                              <h5><a href="#">Gerenciamento de Inscrições</a></h5>
                          </div>
                      </div>
                      <div class="divider bg-accent"></div>
                      <div class="box-body">
                          <p>Nosso sistema permite gerenciar todas as inscrições dos participantes, facilitando o controle e organização dos eventos.</p>
                      </div>
                  </article>
              </div>
              <div class="col-md-6 col-lg-4 height-fill">
                  <article class="icon-box">
                      <div class="box-top">
                          <div class="box-icon"><span class="novi-icon icon icon-primary icon-lg mercury-icon-lib"></span></div>
                          <div class="box-header">
                              <h5><a href="#">Emissão de Certificados</a></h5>
                          </div>
                      </div>
                      <div class="divider bg-accent"></div>
                      <div class="box-body">
                          <p>Com nosso sistema, é possível gerar certificados para todos os participantes dos cursos cadastrados, além de validar e emitir uma segunda via na página de validação de certificados.</p>
                      </div>
                  </article>
              </div>
          </div>
      </div>
    </section>
  

    <section class="bg-displaced-wrap">
      <div class="bg-displaced-body">
        <div class="container">
          <div class="inset-xl-left-70 inset-xl-right-70">
            <article class="box-cart bg-ebony-clay">
              <div class="box-cart-image"><img src=" {{ asset('site/assets/images/home-2-342x338.jpg')}}" alt="" width="342" height="338"/>
              </div>
              <div class="box-cart-body">
                <blockquote class="blockquote-complex blockquote-complex-inverse">
                  <h3>About Us</h3>
                  <p>
                    <q>When you place your case in the hands of our lawyers and paralegals, you are placing your case in the hands of professionals who are committed to achieving the best possible outcome.</q>
                  </p>
                  <div class="quote-footer">
                    <cite>Ryan Emberson</cite><small>CEO at LawExpert</small>
                  </div>
                </blockquote>
                <div class="button-wrap inset-md-left-70"><a class="button button-responsive button-medium button-primary-outline-v2" href="#">Request a Free Consultation</a></div>
              </div>
            </article>
          </div>
        </div>
      </div>
      <div class="bg-displaced bg-image" style="background-image: url({{ asset('site/assets/images/home-1.jpg);')}}"></div>
    </section>

    <section class="section-60 section-lg-100">
      <div class="container">
        <div class="row row-40 align-items-sm-end">
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="thumbnail-variant-2-wrap">
              <div class="thumbnail thumbnail-variant-2">
                <figure class="thumbnail-image"><img src="{{ asset('site/assets/images/team-9-246x300.jpg')}}" alt="" width="246" height="300"/>
                </figure>
                <div class="thumbnail-inner">
                  <div class="link-group"><span class="novi-icon icon icon-xxs icon-primary material-icons-local_phone"></span><a class="link-white" href="tel:#">+1 (409) 987–5874</a></div>
                  <div class="link-group"><span class="novi-icon icon icon-xxs icon-primary fa-envelope-o"></span><a class="link-white" href="mailto:#">info@demolink.org</a></div>
                </div>
                <div class="thumbnail-caption">
                  <p class="text-header"><a href="#">Amanda Smith</a></p>
                  <div class="divider divider-md bg-teak"></div>
                  <p class="text-caption">Paralegal</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="thumbnail-variant-2-wrap">
              <div class="thumbnail thumbnail-variant-2">
                <figure class="thumbnail-image"><img src="{{ asset('site/assets/images/team-10-246x300.jpg')}}" alt="" width="246" height="300"/>
                </figure>
                <div class="thumbnail-inner">
                  <div class="link-group"><span class="novi-icon icon icon-xxs icon-primary material-icons-local_phone"></span><a class="link-white" href="tel:#">+1 (409) 987–5874</a></div>
                  <div class="link-group"><span class="novi-icon icon icon-xxs icon-primary fa-envelope-o"></span><a class="link-white" href="mailto:#">info@demolink.org</a></div>
                </div>
                <div class="thumbnail-caption">
                  <p class="text-header"><a href="#">John Doe</a></p>
                  <div class="divider divider-md bg-teak"></div>
                  <p class="text-caption">Attorney</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="thumbnail-variant-2-wrap">
              <div class="thumbnail thumbnail-variant-2">
                <figure class="thumbnail-image"><img src="{{ asset('site/assets/images/team-11-246x300.jpg')}}" alt="" width="246" height="300"/>
                </figure>
                <div class="thumbnail-inner">
                  <div class="link-group"><span class="novi-icon icon icon-xxs icon-primary material-icons-local_phone"></span><a class="link-white" href="tel:#">+1 (409) 987–5874</a></div>
                  <div class="link-group"><span class="novi-icon icon icon-xxs icon-primary fa-envelope-o"></span><a class="link-white" href="mailto:#">info@demolink.org</a></div>
                </div>
                <div class="thumbnail-caption">
                  <p class="text-header"><a href="#">Vanessa Ives</a></p>
                  <div class="divider divider-md bg-teak"></div>
                  <p class="text-caption">Legal Assistant</p>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-12 col-lg-3 text-center">
            <div class="block-wrap-1">
              <div class="block-number">06</div>
              <h3 class="text-normal">Experts</h3>
              <p class="h5 h5-smaller text-style-4">in Their Fields</p>
              <p>If you or your business is facing a legal challenge, contact us today to arrange a free initial consultation with an attorney.</p><a class="link link-group link-group-animated link-bold link-secondary" href="#"><span>Read more</span><span class="novi-icon icon icon-xxs icon-primary fa fa-angle-right"></span></a>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- QUEIPE DA EMPRESA OU CLIENTES --}}
    <section class="section parallax-container bg-black" data-parallax-img="{{ asset('site/assets/images/progress-bars-parallax-2.jpg')}}">
      <div class="parallax-content">
        <div class="section-50 section-md-90">
          <div class="container">
            <div class="row row-40">
              <div class="col-sm-6 col-md-3">
                <div class="box-counter box-counter-inverse"><span class="novi-icon icon icon-lg icon-primary mercury-icon-group"></span>
                  <div class="text-large counter">1450</div>
                  <p class="box-header">Happy Clients</p>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="box-counter box-counter-inverse"><span class="novi-icon icon icon-lg-smaller icon-primary mercury-icon-scales"></span>
                  <div class="text-large counter">23</div>
                  <p class="box-header">Years of Experience</p>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="box-counter box-counter-inverse"><span class="novi-icon icon icon-lg-smaller icon-primary mercury-icon-partners"></span>
                  <div class="text-large counter counter-percent">98</div>
                  <p class="box-header">Successful Cases</p>
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="box-counter box-counter-inverse"><span class="novi-icon icon icon-lg icon-primary mercury-icon-case"></span>
                  <div class="text-large counter">7500</div>
                  <p class="box-header">Personal Injury Cases</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- RELATÓRIO DE USUABILIDADE DO SISTEMA --}}
    <section class="section-66 section-md-90 section-xl-bottom-100">
      <div class="container">
        <h3 class="text-center">Depoimentos</h3>
        <div class="owl-carousel owl-spacing-1 owl-nav-classic owl-style-minimal" data-autoplay="true" data-items="1" data-md-items="2" data-stage-padding="0" data-loop="true" data-margin="30" data-mouse-drag="true" data-nav="true" data-dots="true" data-dots-each="1">
          <div class="item">
            <blockquote class="quote-bordered">
              <div class="quote-body">
                <div class="quote-open">
                  <svg version="1.1" baseprofile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="37px" height="27px" viewbox="0 0 21 15" preserveAspectRatio="none">
                    <path d="M9.597,10.412c0,1.306-0.473,2.399-1.418,3.277c-0.944,0.876-2.06,1.316-3.349,1.316                    c-1.287,0-2.414-0.44-3.382-1.316C0.482,12.811,0,11.758,0,10.535c0-1.226,0.58-2.716,1.739-4.473L5.603,0H9.34L6.956,6.37                    C8.716,7.145,9.597,8.493,9.597,10.412z M20.987,10.412c0,1.306-0.473,2.399-1.418,3.277c-0.944,0.876-2.06,1.316-3.35,1.316                    c-1.288,0-2.415-0.44-3.381-1.316c-0.966-0.879-1.45-1.931-1.45-3.154c0-1.226,0.582-2.716,1.74-4.473L16.994,0h3.734l-2.382,6.37                    C20.106,7.145,20.987,8.493,20.987,10.412z"></path>
                  </svg>
                </div>
                <div class="quote-body-inner">
                  <h6>Maior eficiência nas inscrições dos nossos eventos!</h6>
                  <p>
                    <q>A plataforma de automação de vendas da Pissinet transformou a maneira como gerenciamos nossos eventos. Agora, podemos gerenciar as inscrições de forma mais eficiente e rápida, economizando tempo e recursos.</q>
                  </p>
                </div>
              </div>
              <div class="quote-footer">
                <div class="unit unit-horizontal unit-spacing-sm align-items-center">
                  <div class="unit-left"><img class="img-circle" src="{{ asset('site/assets/images/clients-testimonials-1-68x68.jpg')}}" alt="" width="68" height="68"/>
                  </div>
                  <div class="unit-body">
                    <cite>Ana Silva</cite>
                    <p class="text-primary">Diretora de Eventos, Eventos Inc.</p>
                  </div>
                </div>
              </div>
            </blockquote>
          </div>
          <div class="item">
            <blockquote class="quote-bordered">
              <div class="quote-body">
                <div class="quote-open">
                  <svg version="1.1" baseprofile="tiny" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="37px" height="27px" viewbox="0 0 21 15" preserveAspectRatio="none">
                    <path d="M9.597,10.412c0,1.306-0.473,2.399-1.418,3.277c-0.944,0.876-2.06,1.316-3.349,1.316                    c-1.287,0-2.414-0.44-3.382-1.316C0.482,12.811,0,11.758,0,10.535c0-1.226,0.58-2.716,1.739-4.473L5.603,0H9.34L6.956,6.37                    C8.716,7.145,9.597,8.493,9.597,10.412z M20.987,10.412c0,1.306-0.473,2.399-1.418,3.277c-0.944,0.876-2.06,1.316-3.35,1.316                    c-1.288,0-2.415-0.44-3.381-1.316c-0.966-0.879-1.45-1.931-1.45-3.154c0-1.226,0.582-2.716,1.74-4.473L16.994,0h3.734l-2.382,6.37                    C20.106,7.145,20.987,8.493,20.987,10.412z"></path>
                  </svg>
                </div>
                <div class="quote-body-inner">
                  <h6>Relatórios detalhados e certificados personalizados!</h6>
                  <p>
                    <q>A Pissinet nos ajudou a obter relatórios detalhados sobre nossos participantes e a gerar certificados personalizados de forma fácil e rápida. Agora, podemos fornecer aos nossos clientes uma experiência ainda melhor em nossos eventos.</q>
                  </p>
                </div>
              </div>
              <div class="quote-footer">
                <div class="unit unit-horizontal unit-spacing-sm align-items-center">
                  <div class="unit-left"><img class="img-circle" src="{{ asset('site/assets/images/clients-testimonials-2-68x68.jpg')}}" alt="" width="68" height="68"/>
                  </div>
                  <div class="unit-body">
                    <cite>Carlos Oliveira</cite>
                    <p class="text-primary">Gerente de Marketing, Eventos Master</p>
                  </div>
                </div>
              </div>
            </blockquote>
          </div>
        </div>
      </div>
    </section>

    {{-- Formulario de contato --}}
    <section class="bg-whisper">
      <div class="container">
          <div class="row">
              <div class="col-md-10 col-lg-9 col-xl-7">
                <div class="section-50 section-md-75 section-xl-100">
                  <h3>Consulta Gratuita</h3>
                  <form data-form-output="form-output-global" method="post" action="{{ route('site.enviar.email') }}">
                    @csrf
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <div class="row row-30">
                        <div class="col-md-6">
                            <div class="form-wrap">
                                <input class="form-input @error('name') is-invalid @enderror" id="request-form-name" type="text" name="name" value="{{ old('name') }}" required>
                                <label class="form-label" for="request-form-name">Nome</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-wrap">
                                <input class="form-input" id="request-form-phone" type="text" name="phone" value="{{ old('phone') }}" pattern="[0-9]+" required>
                                <label class="form-label" for="request-form-phone">Telefone</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-wrap">
                                <input class="form-input" id="request-form-email" type="email" name="email" value="{{ old('email') }}" required>
                                <label class="form-label" for="request-form-email">E-mail</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-wrap form-wrap-outside">
                                <!--Select 2-->
                                <select class="form-input select-filter" id="request-form-select" data-minimum-results-for-search="Infinity" name="law_type" required>
                                    <option value="Direito de Família" @if(old('law_type') == 'Direito de Família') selected @endif>Direito de Família</option>
                                    <option value="Direito Empresarial" @if(old('law_type') == 'Direito Empresarial') selected @endif>Direito Empresarial</option>
                                    <option value="Litígio Civil" @if(old('law_type') == 'Litígio Civil') selected @endif>Litígio Civil</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-wrap">
                                <textarea class="form-input" id="feedback-2-message" name="message" required>{{ old('message') }}</textarea>
                                <label class="form-label" for="feedback-2-message">Mensagem</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="button button-block button-primary" type="submit">Solicitar Consulta Gratuita</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
              </div>
              
              </div>
              <div class="col-xl-5 d-none d-xl-block">
                  <div style="margin-top: -40px;">
                      <img src="{{ asset('site/assets/images/imagem-contato-4-472x753.webp')}}" alt="" width="472" height="753"/>
                  </div>
              </div>
          </div>
      </div>
    </section>
  

    {{-- SESSÃO DE ÚTIMAS NOTICIAS NOTICIAS --}}
    <section class="section-50 section-md-75 section-xl-100">
      <div class="container">
        <h3 class="text-center">Vantagens de Automatizar a Venda de Eventos Presenciais</h3>
        <div class="row row-40 row-offset-1 justify-content-sm-center justify-content-md-start">
          <div class="col-sm-9 col-md-6 col-lg-4 col-xl-3">
            <article class="post-boxed">
              <div class="post-boxed-image"><img src="{{ asset('site/assets/images/home-5-268x182.jpg')}}" alt="" width="268" height="182"/>
              </div>
              <div class="post-boxed-body">
                <div class="post-boxed-title"><a href="#">Gerencie Inscrições de Forma Eficiente</a></div>
                <div class="post-boxed-footer">
                  <ul class="post-boxed-meta">
                    <li>
                      <time datetime="2019-06-14">14 de Junho de 2019</time>
                    </li>
                    <li><span>por</span><a href="#">Admin</a></li>
                  </ul>
                </div>
              </div>
            </article>
          </div>
          <div class="col-sm-9 col-md-6 col-lg-4 col-xl-3">
            <article class="post-boxed">
              <div class="post-boxed-image"><img src="{{ asset('site/assets/images/home-6-268x182.jpg')}}" alt="" width="268" height="182"/>
              </div>
              <div class="post-boxed-body">
                <div class="post-boxed-title"><a href="#">Crie Listas de Chamada de Forma Automática</a></div>
                <div class="post-boxed-footer">
                  <ul class="post-boxed-meta">
                    <li>
                      <time datetime="2019-06-20">20 de Junho de 2019</time>
                    </li>
                    <li><span>por</span><a href="#">Admin</a></li>
                  </ul>
                </div>
              </div>
            </article>
          </div>
          <div class="col-sm-9 col-md-6 col-lg-4 col-xl-3">
            <article class="post-boxed">
              <div class="post-boxed-image"><img src="{{ asset('site/assets/images/home-7-268x182.jpg')}}" alt="" width="268" height="182"/>
              </div>
              <div class="post-boxed-body">
                <div class="post-boxed-title"><a href="#">Gere Relatórios Detalhados com Poucos Cliques</a></div>
                <div class="post-boxed-footer">
                  <ul class="post-boxed-meta">
                    <li>
                      <time datetime="2019-06-23">23 de Junho de 2019</time>
                    </li>
                    <li><span>por</span><a href="#">Admin</a></li>
                  </ul>
                </div>
              </div>
            </article>
          </div>
          <div class="col-sm-9 col-md-6 col-lg-4 col-xl-3">
            <article class="post-boxed">
              <div class="post-boxed-image"><img src="{{ asset('site/assets/images/home-8-268x182.jpg')}}" alt="" width="268" height="182"/>
              </div>
              <div class="post-boxed-body">
                <div class="post-boxed-title"><a href="#">Emita Certificados de Participação Instantaneamente</a></div>
                <div class="post-boxed-footer">
                  <ul class="post-boxed-meta">
                    <li>
                      <time datetime="2019-06-12">12 de Junho de 2019</time>
                    </li>
                    <li><span>por</span><a href="#">Admin</a></li>
                  </ul>
                </div>
              </div>
            </article>
          </div>
        </div>
      </div>
    </section>


@endsection