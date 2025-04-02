<div class="tab-content text-muted">
    <div class="tab-pane active" id="productnav-all" role="tabpanel">
        @include('admin.products.product_table', ['products' => $all])
    </div>

    <div class="tab-pane" id="productnav-published" role="tabpanel">
        @include('admin.products.product_table', ['products' => $active])
    </div>

    <div class="tab-pane" id="productnav-draft" role="tabpanel">
        @include('admin.products.product_table', ['products' => $nonActive])
    </div>
</div>