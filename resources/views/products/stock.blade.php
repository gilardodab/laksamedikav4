 <!-- Modal -->
  <div class="modal fade" id="modalStock{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Stock</h5>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route ('tambah.stock', $data->id) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT" class="form-control">
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Stock</label>
                    <input type="number" name="stock" class="form-control" min="1">
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Tambah Stock</button>
            </div>
        </form>
      </div>
    </div>
  </div>