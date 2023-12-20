<!-- <h6 class="dropdown-item-text">
    Notifications
</h6> -->
@forelse ($product as $n => $notif)
<hr style="margin:0">
<div class="slimscroll notification-item-list">
    <!-- item-->
    <a href="{{route('product.edit', $notif->id)}}" class="dropdown-item notify-item active">
        <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
        <p class="notify-details"><b>{{ $notif->title }}</b><span class="text-muted">Stock :
                {{ $notif->stock}}</span></p>
    </a>
</div>
<hr style="margin:0">
@empty
<h6 class="dropdown-item-text">
    No Data
</h6>
@endforelse