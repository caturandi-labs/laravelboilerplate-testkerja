<div class="modal fade" tabindex="-1" role="dialog" id="formModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form method="post" action="javascript:void(0)">
          @method('POST')
          {{ csrf_field() }}
          <input type="hidden" id="id">
          <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" autofocus name="name" class="form-control" placeholder="Category Name">
              <div></div>
          </div>
        
      </div>
      <div class="modal-footer bg-whitesmoke br">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

