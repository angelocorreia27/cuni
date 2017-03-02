<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    @if(Auth::user()->avatar)
                        <img  src="/uploads/{{Auth::user()->avatar}}" class="img-circle" alt="Cinque Terre" >
                    @else
                        <img  src="/img/user2-160x160.jpg" class="img-circle" alt="Cinque Terre" >
                    @endif
                </div>

                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-home'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            
             <li><a href="#"><i class='fa fa-gears'></i> <span>Listas actividades diária</span></a>

                <ul class="treeview-menu">
                    <li><a href="{{ url('cobricoes') }}">Mapa de Cobrição</a></li>
                    <li><a href="{{ url('lista_cobricao') }}">Lista para cobrição</a></li>
                    <li><a href="{{ url('lista_palpacao') }}">Lista para palpação</a></li>
                    <li><a href="{{ url('lista_ninho') }}">Lista para colocação de ninho</a></li>
                    <li><a href="{{ url('lista_vpartos') }}">Lista para verificação de partos</a></li>
                    <li><a href="{{ url('lista_desmame') }}">Lista para desmame</a></li>
                </ul>
             </li>  

            <li class="treeview">
                <a href="#"><i class='fa fa-list'></i> <span>Gestão Cunícula</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('animais') }}">Lista de Animais</a></li>
                    <li><a href="{{ url('reposicoes') }}">Lista de Reposição</a></li>                    
                    <li><a href="{{ url('reproducao') }}">Lista de Cobricão</a></li>
                    <li><a href="{{ url('gestantes') }}">Lista de Gestantes</a></li>                 
                    <li><a href="{{ url('maternidades') }}">Lista de Partos</a></li>
                    <li><a href="{{ url('engordas') }}">Lista de Engorda</a></li>
                    <li><a href="{{ url('obitos') }}">Lista de Obito</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Saída de Animais</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('abates') }}">Lista de Abates</a></li>
                    <li><a href="#">Lista de Venda</a></li>
                </ul>
            </li>

            <!-- <li><a href="#"><i class='fa fa-shopping-cart'></i> <span>Venda</span></a></li>
            <li><a href="#"><i class='fa fa-barcode'></i> <span>Compra</span></a></li>
            <li><a href="{{ url('animais') }}"><i class='fa fa-database'></i> <span>Estoque</span></a></li>
            <li><a href="{{ url('providers') }}"><i class='fa fa-truck'></i> <span>Fornecedor</span></a></li> -->

            <li class="treeview">
                <a href="#"><i class='fa fa-cogs'></i> <span>Configurações</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('racas') }}">Raça</a></li>
                    <li><a href="{{ url('gaiolas') }}">Gaiola</a></li>
                    <li><a href="{{ url('dominios') }}">Dominios</a></li>
                </ul>
            </li>


        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>