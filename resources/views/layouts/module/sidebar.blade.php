<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->


    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a class="d-block">{{ Auth::user()->name }}</a>
                <a href="{{route('editadmin',Auth::user()->id)}}">edit profile</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview menu-open">
                    <a href="{{route('home')}}" class="nav-link active">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @role('admin' )
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-server"></i>
                        <p>
                            Manajemen Produk
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                         <li class="nav-item">
                            <a href="{{ route('induk') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>induk Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kategori.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sub.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Sub Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('produk.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Produk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Pelanggan</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="{{ route('penampungan') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>penampungan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('berita.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>berita</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('konten.mag') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Magazine</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('banner.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Banner</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('konten.edu') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Edu konten</p>
                            </a>
                        </li>

                         <li class="nav-item">
                            <a href="{{ route('voucher.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>voucher</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('jurnal') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Jurnal</p>
                            </a>
                        </li>



                        <li class="nav-item">
                            <a href="{{ route('atur_hargajual.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>atur harga jual</p>
                            </a>
                        </li>






                    </ul>
                </li>
                @endrole




                @role('cs' )
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-server"></i>
                        <p>
                            Manajemen Produk
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                         <li class="nav-item">
                            <a href="{{ route('induk') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>induk Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kategori.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sub.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Sub Kategori</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('produk.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Produk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Pelanggan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('berita.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Feed</p>
                            </a>
                        </li>

                         <li class="nav-item">
                            <a href="{{ route('voucher.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>voucher</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('jurnal') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Jurnal</p>
                            </a>
                        </li>



                        <li class="nav-item">
                            <a href="{{ route('atur_hargajual.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>atur harga jual</p>
                            </a>
                        </li>






                    </ul>
                </li>
                @endrole










                @role('admin')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-shopping-bag"></i>
                        <p>
                            Manajemen Order
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('order.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Order</p>
                            </a>
                        </li>
                    </ul>
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('vendor.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>vendor</p>
                            </a>
                        </li>
                    </ul>
                     <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('pre_order.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>pre order vendor</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('retur.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Retur Barang</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('bank.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Bank</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('bukti.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Top up</p>
                            </a>
                        </li>
                    </ul>



                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('proses.status.admin') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>produk cabang </p>
                            </a>
                        </li>



                          <li class="nav-item">
                            <a href="{{ route('subsidi.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>atur Subsidi</p>
                            </a>
                        </li>







                        <li class="nav-item">
                            <a href="{{ route('atur_profit.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>atur profit</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('cair_komisi.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>profit</p>
                            </a>
                        </li>

                              <!-- <li class="nav-item">
                            <a href="{{ route('komisi') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>kirim profit</p>
                            </a>
                        </li> -->

                        </li>

                              <li class="nav-item">
                            <a href="{{ route('batas_pembelian.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>atur nilai tukar poin</p>
                            </a>
                        </li>

                    </ul>

                </li>
                @endrole


 @role('cs')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-shopping-bag"></i>
                        <p>
                            Manajemen Order
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('order.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Order</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('bank.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Bank</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('bukti.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Top up</p>
                            </a>
                        </li>
                    </ul>



                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('proses.status.admin') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Proses Status</p>
                            </a>
                        </li>



                          <li class="nav-item">
                            <a href="{{ route('subsidi.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>atur Subsidi</p>
                            </a>
                        </li>







                        <li class="nav-item">
                            <a href="{{ route('atur_profit.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>atur profit</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('cair_komisi.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>profit</p>
                            </a>
                        </li>

                              <li class="nav-item">
                            <a href="{{ route('komisi') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>kirim profit</p>
                            </a>
                        </li>

                        </li>

                              <li class="nav-item">
                            <a href="{{ route('batas_pembelian.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>atur nilai tukar poin</p>
                            </a>
                        </li>

                    </ul>

                </li>
                @endrole








                @role('admin')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Manajemen Users
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('role.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Role</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.roles_permission') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Role Permission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                         <li class="nav-item">
                            <a href="{{ route('users.cabang') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>users cabang</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole



                 @role('admin')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                       <i class="fas fa-restroom"></i>
                        <p>
                            Manajemen anggota
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('anggota') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>anggota</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole

                   @role('cs')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Manajemen Users
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('role.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Role</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.roles_permission') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Role Permission</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole
                  @role('cs')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                       <i class="fas fa-restroom"></i>
                        <p>
                            Manajemen anggota
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('anggota') }}" class="nav-link">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>anggota</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endrole

                <li class="nav-item has-treeview">
                    <a class="nav-link" id="logoutData" href="{{ route('logout') }}"
                    {{-- <a class="nav-link" id="logoutData" href="{{ url('/out') }}" --}}
                        {{-- onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" --}}
                        >
                        <i class="nav-icon fa fa-sign-out"></i>
                        <p>
                            {{ __('Logout') }}
                        </p>
                    </a>

                    {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form> --}}
                </li>
            </ul>
        </nav>
    </div>
</aside>