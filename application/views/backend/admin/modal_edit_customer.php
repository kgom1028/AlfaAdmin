<?php 
$edit_data		=	$this->db->get_where('customer' , array('id' => $param2) )->result_array();
foreach ( $edit_data as $row):
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_customer');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open('admin/manager_customer/do_update/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('phone_number');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('comment');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="comment" value="<?php echo $row['comment'];?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('active');?></label>
                        <div class="col-sm-5">
                            <select name="active" class="form-control">
								<option value="1" <?php if($row['isActive'] == 1)echo 'selected';?>>
									<?php echo get_phrase('enable');?>
								</option>
								<option value="0" <?php if($row['isActive'] == 0)echo 'selected';?>>
									<?php echo get_phrase('disable');?>
								</option>
                            </select>
                        </div>
                    </div>
            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_contact');?></button>
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


