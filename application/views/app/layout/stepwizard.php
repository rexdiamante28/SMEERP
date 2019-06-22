<div class="content-inner" id="pageActive" data-namecollapse="" data-labelname="">
	<!-- Page Header-->
	<?= $breadcrumb; ?>
	<div class="row m-b-sm">
		<div class="col-lg-12">
			<div class="row justify-content-center">

				<div class="col-10 mt-5 mb-5">
                    <form action="">
                        <div id="stepwizard">
                            <ul>
                                <li>
                                    <a href="#step1">
                                        Step 1
                                        <br>
                                        <small>Stock Movement Details</small>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step2">
                                        Step 2
                                        <br>
                                        <small>Stock Movement Items</small>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step3">
                                        Step 3
                                        <br>
                                        <small>Stock Movement Personnel</small>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step4">
                                        Step 4
                                        <br>
                                        <small>Stock Movement Vehicles</small>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step5">
                                        Step 5
                                        <br>
                                        <small>Stock Movement Images</small>
                                    </a>
                                </li>
                            </ul>
                            <div>
                                <div id="step1" class="p-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <h2 class="mb-3">Stock Movement Details</h2>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <label for="">Reference Code</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label>Destination</label>
                                                <select class="form-control">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <label for="">Date</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control datepicker" value="<?=date('m/d/y')?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label>Destination Type</label>
                                                <select class="form-control">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label>Source</label>
                                                <select class="form-control">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label>Source Type</label>
                                                <select class="form-control">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select class="form-control">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="step2">
                                    <div class="modal fade add-item" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Item</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-12">
                                                            <div class="form-group">
                                                                <label>Item</label>
                                                                <select class="form-control">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                    <option>5</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <label for="">Batch Number</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <label for="">Capital</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <label for="">Expiration Date</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control datepicker" value="<?=date('m/d/y')?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <label for="">Selling Price</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">PHP</span>
                                                                </div>
                                                                <input type="number" class="form-control rounded-0">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">.00</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <label for="">Amount ID (optional)</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <label for="">Quantity</label>
                                                            <div class="form-group">
                                                                <input type="number" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Add</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <h2 class="mb-3">Stock Movement Items</h2>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="border-top-gray">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <form id="company_search_form">
                                                                        <div class="input-group">
                                                                            <input type="text" name="searchtext" class="form-control form-control-sm capitalize" placeholder="Search" id="company_searchtext">
                                                                            <button class="input-group-btn btn-sm btn btn-primary btn-auto no-margin" type="submit" id="search_trigger_btn">
                                                                                <i class="fa fa-search no-margin"></i>
                                                                            </button>
                                                                            <?php
                                                                            if($this->loginstate->get_access()['overall_access']==1)
                                                                            {
                                                                                ?>
                                                                                <button type="button" class="input-group-btn btn-sm btn btn-primary btn-auto no-margin" id="company_create_btn" data-toggle="modal" data-target=".add-item">
                                                                                    <i class="fa fa-plus"></i>
                                                                                    Add New
                                                                                </button>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped table-hover table-bordered table-grid" id="company-table-grid">
                                                    <thead>
                                                        <tr>
                                                            <th>Item</th>
                                                            <th>Batch Number</th>
                                                            <th>Capital</th>
                                                            <th>Exp. Date</th>
                                                            <th>Selling Price</th>
                                                            <th>Amount ID</th>
                                                            <th>Qty</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="step3">
                                    <div class="modal fade modal-personnel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Personnel</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-12">
                                                            <div class="form-group">
                                                                <label>Person</label>
                                                                <select class="form-control">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                    <option>5</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <div class="form-group">
                                                                <label>Role</label>
                                                                <select class="form-control">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                    <option>5</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Add</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <h2 class="mb-3">Personnel</h2>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="border-top-gray">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <form id="company_search_form">
                                                                        <div class="input-group">
                                                                            <input type="text" name="searchtext" class="form-control form-control-sm capitalize" placeholder="Search" id="company_searchtext">
                                                                            <button class="input-group-btn btn-sm btn btn-primary btn-auto no-margin" type="submit" id="search_trigger_btn">
                                                                                <i class="fa fa-search no-margin"></i>
                                                                            </button>
                                                                            <?php
                                                                            if($this->loginstate->get_access()['overall_access']==1)
                                                                            {
                                                                                ?>
                                                                                <button type="button" class="input-group-btn btn-sm btn btn-primary btn-auto no-margin" id="company_create_btn" data-toggle="modal" data-target=".modal-personnel">
                                                                                    <i class="fa fa-plus"></i>
                                                                                    Add New
                                                                                </button>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped table-hover table-bordered table-grid" id="company-table-grid">
                                                    <thead>
                                                        <tr>
                                                            <th>Person</th>
                                                            <th>Role</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="step4">
                                <div class="modal fade modal-vehicles" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Vehicle</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-12">
                                                            <label for="">Plate #</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <label for="">Model</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-12">
                                                            <label for="">Type</label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Add</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <h2 class="mb-3">Stock Movement Vehicles</h2>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="border-top-gray">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <form id="company_search_form">
                                                                        <div class="input-group">
                                                                            <input type="text" name="searchtext" class="form-control form-control-sm capitalize" placeholder="Search" id="company_searchtext">
                                                                            <button class="input-group-btn btn-sm btn btn-primary btn-auto no-margin" type="submit" id="search_trigger_btn">
                                                                                <i class="fa fa-search no-margin"></i>
                                                                            </button>
                                                                            <?php
                                                                            if($this->loginstate->get_access()['overall_access']==1)
                                                                            {
                                                                                ?>
                                                                                <button type="button" class="input-group-btn btn-sm btn btn-primary btn-auto no-margin" id="company_create_btn" data-toggle="modal" data-target=".modal-vehicles">
                                                                                    <i class="fa fa-plus"></i>
                                                                                    Add New
                                                                                </button>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-striped table-hover table-bordered table-grid" id="company-table-grid">
                                                    <thead>
                                                        <tr>
                                                            <th>Plate #</th>
                                                            <th>Model</th>
                                                            <th>Type</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="step5">
                                    <div class="row justify-content-center p-4">
                                        <div class="col-7">
                                        <form action="/upload-target" class="dropzone"></form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
				</div>

			</div>
		</div>
	</div>
</div>