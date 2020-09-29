        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="user-profile">
                            <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                                <img src="{{ asset('images/avatar.png') }}" alt="user" /><span class="hide-menu">{{ auth()->user()->name }} </span>
                            </a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('admin.usuarios.show', auth()->user())}}">Mi Perfil </a></li>
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-sm">
                                            <i class="fa fa-power-off"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-devider"></li>
                        @role('Admin')
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account"></i><span class="hide-menu">Usuarios </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li>
                                    <a href="{{ route('admin.usuarios.index')}}">Listado Usuarios </a>
                                </li>
                                <li><a href="{{ route('admin.usuarios.create')}}">Crear Usuario</a></li>
                                <li>
                                        <a href="{{ route('admin.roles.index')}}">Listado Roles </a>
                                    </li>
                                    <li><a href="{{ route('admin.roles.create')}}">Crear Rol</a></li>
                            </ul>
                        </li>
                        
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Clientes</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('admin.clientes.index')}}">Listado clientes</a></li>
                                <li><a href="{{ route('admin.clientes.create')}}">Crear clientes</a></li>
                            </ul>
                        </li>
                        @endrole

                        @hasanyrole('Admin|Supervisor')
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-engine"></i><span class="hide-menu">Equipos</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('admin.equipos.index')}}">Listado equipos</a></li>
                                <li><a href="{{ route('admin.marcas.index')}}">Marcas Equipos</a></li>
                            </ul>
                        </li>
                        @endhasanyrole
                        @hasanyrole('Admin|Supervisor|Tecnico')
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Mantenimientos</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('admin.mantenimientos.index')}}">Listado Mantenimientos</a></li>
                                <li><a href="{{ route('admin.mantenimientos.create')}}">Crear mantenimientos</a></li>
                            </ul>
                        </li>
                        @endhasanyrole
                        
                    </ul>
                </nav>
            </div>
        </aside>
