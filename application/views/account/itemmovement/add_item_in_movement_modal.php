<div class="modal fade" id="add_item_in_movement_modal" tabindex="-1" role="dialog" aria-labelledby="addLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Item Movement Items</strong></h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="page-title">
             <div class="title_left">
               <div class="col-md-5 col-sm-5 col-xs-12 form-group top-10">
                 <select type="text" class="form-control" id="items_record_per_page">
                     <option value="5">5</option>
                     <option value="10">10</option>
                     <option value="20" selected>20</option>
                     <option value="50">50</option>
                     <option value="100">100</option>
                     <option value="200">200</option>
                     <option value="500">500</option>
                     <option value="1000">1000</option>
                 </select>
               </div>
             </div>

             <div class="title_right">
               <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                 <div class="input-group">
                   <form id="items_search_form">
                     <div class="input-group">
                       <input type="text" class="form-control" id="items_search" placeholder="Search">
                       <span class="input-group-btn">
                         <button class="btn btn-default" type="submit">Go!</button>
                       </span>
                     </div>
                   </form>
                 </div>
               </div>
             </div>
            </div>
        </div>
        <hr>
        <div class="alert alert-danger hidden" id="error_message">
        
        </div>
        <div class="row" id="item_movements_item_list">
            <?php $this->load->view('common/loading'); ?>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" id="close_modal" data-dismiss="modal">Close</button>
      </div>
      </form>

    </div>
  </div>
</div>