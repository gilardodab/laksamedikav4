<form action="{{ route('invoicecustomer.uploadPaymentProof', ['id' => $invoicecustomers->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="payment_proof">Bukti Pembayaran</label>
        <input type="file" name="payment_proof" id="payment_proof" accept="image/*">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Unggah Bukti Pembayaran</button>
    </div>
</form>
