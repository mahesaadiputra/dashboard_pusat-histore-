<div class="col-md-4">
    @card
        @slot('title')
        Keranjang
        @endslot

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(row, index) in shoppingCart">
                        <td>@{{ row.name }} (@{{ row.code }})</td>
                        @role('admin')
                        <td>@{{ row.price | currency }}</td>
                        @endrole
                        @role('level1')
                        <td>@{{ row.price_level1 | currency }}</td>
                        @endrole
                        @role('level2')
                        <td>@{{ row.price_level2 | currency }}</td>
                        @endrole
                        @role('level3')
                        <td>@{{ row.price_level3 | currency }}</td>
                        @endrole
                        <td>@{{ row.qty }}</td>
                        <td>
                            <button 
                                @click.prevent="removeCart(index)"    
                                class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        @slot('footer')
        <div class="card-footer text-muted">
            @if (url()->current() == route('order.transaksi'))
            <a href="{{ route('order.checkout') }}" 
                class="btn btn-info btn-sm float-right">
                Checkout
            </a>
            @else
            <a href="{{ route('order.transaksi') }}"
                class="btn btn-secondary btn-sm float-right"
                >
                Kembali
            </a>
            @endif
        </div>
        @endslot
    @endcard
</div>