<?php 
$edit_data		=	$this->db->get_where('news' , array('id' => $param2) )->result_array();
foreach ( $edit_data as $row):
//$read = $row['isRead'];
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_newsletter');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open('admin/manager_news/do_update/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                   <div class="form-group">
						<label class="col-sm-3 control-label"><?php echo get_phrase('newsletter');?></label>
						<div class="col-sm-5">
							<select name="nslt_id" class="form-control" style="width:100%;" disabled>
								<?php 
								$newsletters = $this->db->get_where('newsletter' , array('isSent' => 0) )->result_array();
								foreach($newsletters as $row1):
								?>
									<option value="" <?php if($row['nslt_id']==$row1['id'])echo 'selected="selected"';?>><?php echo $row1['title'];?></option>
								<?php
								endforeach;
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('title');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="title" value="<?php echo $row['title'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('news_url');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="url" value="<?php echo $row['url'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>
            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_news');?></button>
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


