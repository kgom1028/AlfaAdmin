<div class="row">
	<div class="col-md-12">

    	<!------CONTROL TABS END-------->
         <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo get_phrase('location_list');?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
                    <?php echo get_phrase('add_location');?>
                </a>
            </li>
        </ul>
		<div class="tab-content">
            <!----TABLE LISTING STARTS---->
            <div class="tab-pane box active" id="list">

                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div><?php echo get_phrase('country');?></div></th>
							<th><div><?php echo get_phrase('region');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php
							foreach($locations as $row):
						?>
                        <tr>
							<td><?php echo $row['country'];?></td>
							<td><?php echo $row['region'];?></td>
							<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_location/<?php echo $row['id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
                                            </a>
                                    </li>
                                    <li class="divider"></li>

                                    <!-- DELETION LINK -->
                                    <li>
                                        <a href="#" onclick="confirm_modal('<?php echo base_url();?>index.php?admin/manage_location/do_delete/<?php echo $row['id'];?>');">
                                            <i class="entypo-trash"></i>
                                                <?php echo get_phrase('delete');?>
										</a>
									</li>
                                </ul>
                            </div>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>

            <!----TABLE LISTING ENDS--->
                <!----CREATION FORM STARTS---->
           <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/manage_location/do_create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="padded">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('country');?></label>
                                <div class="col-sm-5">
																	<!--
                                    <input type="text" class="form-control" name="country" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
																	-->
        														<select class="crs-country" data-region-id="one" name="country" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"></select>
																</div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo get_phrase('region');?></label>
                                <div class="col-sm-5">
																	<!--
																	<input type="text" class="form-control" name="region" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
																-->
																<select  class="form-control" id="one"  name="region"></select>
                      				</div>
                            </div>

														<div class="from_group">
															<label class="col-sm-3 control-label"><?php echo get_phrase('Categories');?></label>
															  <div class="col-sm-5">
																	<select id="category_multiple" name="categories[]" class="form-control" multiple="multiple" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
																		<?php foreach ($categories as $row):?>
																				<option value="<?=$row['id']?>"><?=$row['category_name']?></option>
																		<?php endforeach;?>
																	</select>
																</div>
														</div>
                        </div>
                        <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-5">
                                  <button type="submit" class="btn btn-info"><?php echo get_phrase('create');?></button>
                              </div>
                        </div>
                    </form>
                </div>
            </div>
            <!----CREATION FORM ENDS--->


		</div>
	</div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		$('#category_multiple').multiselect({
				includeSelectAllOption: true,
				enableFiltering: true
		});
		var datatable = $("#table_export").dataTable();

		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});



</script>
