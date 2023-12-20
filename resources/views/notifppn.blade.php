<!-- <h6 class="dropdown-item-text">
    Notifications
</h6> -->
@forelse ($invppn as $n => $notif)
<hr style="margin:0">
<div class="slimscroll notification-item-list">
    <!-- item-->
    <a href="{{route('readppn', $notif->id)}}" class="dropdown-item notify-item active">
        <object><a href="#" data-id="{{$notif->id}}" type="button" class="badge badge-danger"
                style="float: right;color:white;" id="close-notifppn">&times;</a></object>
        <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
        <p class="notify-details"><b>{{ $notif->customer->name }}</b><span class="text-muted">Tgl Transaksi :
                {{ Carbon\Carbon::parse($notif->tanggal)->isoFormat('D MMMM Y')}}</span></p>
    </a>
</div>
<hr style="margin:0">
@empty
<h6 class="dropdown-item-text">
    No Data
</h6>
@endforelse


<script>
$('#close-notifppn').click(function(e) {
    e.preventDefault()
    e.stopPropagation()
    let id = $('#close-notifppn').attr('data-id')
    let route = "{{route('close.notifppn', ':id')}}"
    route = route.replace(':id', id);
    $.ajax({
        // url: "close/" + id,
        url: route,
        method: 'get',
    }).done(function(data) {
        console.log(data)
        $('.list-invoicesppn').trigger('click')
        $("#invoicesppn-alert").text($("#invoicesppn-alert").text().replace($('#invoicesppn-alert')
            .text(),
            data));
        $("#total-alert").text($("#total-alert").text().replace(Number($('#total-alert').text()),
            Number($('#product-alert').text()) +
            Number($(
                '#invoices-alert').text()) + Number($('#invoicesppn-alert').text())));
    })
})
</script>
