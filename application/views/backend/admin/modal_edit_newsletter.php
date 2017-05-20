<?php 
$edit_data		=	$this->db->get_where('newsletter' , array('id' => $param2) )->result_array();
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
				
                <?php echo form_open('admin/manager_newsletter/do_update/'.$row['id'] , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                    <div class="form-group">
						<label class="col-sm-3 control-label"><?php echo get_phrase('year');?></label>
						<div class="col-sm-5">
							<select name="year" class="form-control">
								<?php for($i=2020;$i>=2015;$i--):?>
									<option value="<?php echo $i;?>"
										<?php if($row['year']==$i)echo 'selected="selected"';?>>
											<?php echo $i;?>
									</option>
								<?php endfor;?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label"><?php echo get_phrase('month');?></label>
						<div class="col-sm-5">
							<select name="month" class="form-control">
								<?php 
								for($i=1;$i<=12;$i++):
									if($i==1)$m='January';
									else if($i==2)$m='February';
									else if($i==3)$m='March';
									else if($i==4)$m='April';
									else if($i==5)$m='May';
									else if($i==6)$m='June';
									else if($i==7)$m='July';
									else if($i==8)$m='August';
									else if($i==9)$m='September';
									else if($i==10)$m='October';
									else if($i==11)$m='November';
									else if($i==12)$m='December';
								?>
									<option value="<?php echo $i;?>"
										<?php if($row['month']==$i)echo 'selected="selected"';?>>
											<?php echo $m;?>
									</option>
								<?php 
								endfor;
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
                        <label class="col-sm-3 control-label"><?php echo get_phrase('sender_name');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="sender_name" value="<?php echo $row['sender_name'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('sender_email');?></label>
                        <div class="col-sm-5">
                            <input type="email" class="form-control" name="sender_email" value="<?php echo $row['sender_email'];?>" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                        </div>
                    </div>
            		<div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('edit_newsletter');?></button>
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


