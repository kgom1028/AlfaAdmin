<?php
$edit_data = $this->db->get_where('tbl_location' , array('id' => $param2) )->result_array();
$edit_relation = $this->db->get_where('tbl_location_category', array('location_id' => $param2))->result_array();
$edit_category = $this->db->get('tbl_category')->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
      	<div class="panel-heading">
          	<div class="panel-title" >
          		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_location');?>
          	</div>
        </div>
		<div class="panel-body">
        <?php echo form_open('admin/manage_location/do_update/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('country');?></label>
                    <div class="col-sm-5">
                        <select class="crs-country" data-region-id="two" name="country" data-default-value="<?php echo $row['country'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"></select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('region');?></label>
                    <div class="col-sm-5">
                        <select  class="form-control" id="two"  name="region" data-default-value="<?php echo $row['region'];?>"></select>
                    </div>
                </div>

								<div class="from_group">
									<label class="col-sm-3 control-label"><?php echo get_phrase('categories');?></label>
										<div class="col-sm-5">
											<select id="category_multiple2" name="categories[]" class="form-control" multiple="multiple" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
												<?php foreach ($edit_category as $category):
														$isSelected = false;
														foreach ($edit_relation as $selectedCategory) {
															if($selectedCategory['category_id'] == $category['id'])
															{
																	$isSelected =true;
															}
														}
														if($isSelected)
														{
															 echo "<option value=".$category['id']." selected>".$category['category_name']."</option>";
														}else {
															 echo "<option value=".$category['id'].">".$category['category_name']."</option>";
														}
													?>


												<?php endforeach;?>
											</select>
										</div>
								</div>
            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_location');?></button>
						</div>
					</div>
        		</form>
            </div>
        </div>
    </div>
</div>

<?php
endforeach;
?>
<script type="text/javascript" src="assets/js/dist/crs.min.js"></script>
<link rel="stylesheet" href="assets/css/dist.css">
<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		$('#category_multiple2').multiselect({
				includeSelectAllOption: true,
				enableFiltering: true
		});
	});
</script>
