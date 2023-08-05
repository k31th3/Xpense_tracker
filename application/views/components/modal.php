
<!-- Modal -->
<div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <?=heading(null, 1, "class='modal-title fs-5'")?>
        <span type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
      </div>
      <div class="modal-body">
        
      </div>
    </div>
  </div>
</div>

<script>
    $('div[id="modal"]').bind('hidden.bs.modal', event => 
    {
        modal = $('div[id="modal"]');
        modal.find('.modal-body').html(null);
        modal.find('.modal-dialog').attr("class", "modal-dialog modal-dialog-scrollable");
    });

    bs_modal = function(data)
    {
        modal = $('div[id="modal"]');
        modal.find('.modal-dialog').addClass(data["class"]);
        modal.find('.modal-title').html(data["title"]);
        modal.find('.modal-body').html(data["body"]);
    }
</script>