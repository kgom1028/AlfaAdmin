<div class="row">
	<div class="col-md-12">

    	<!------CONTROL TABS END-------->
         <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo get_phrase('mangage_transfer_rate');?>
                </a>
            </li>
        </ul>
		<div class="tab-content">
            <!----TABLE LISTING STARTS---->
            <div class="tab-pane box active" id="list">

                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                            <th><div><?php echo get_phrase('id');?></div></th>
                    		<th><div><?php echo get_phrase('from_country_name');?></div></th>
                            <th><div><?php echo get_phrase('to_country_name');?></div></th>
                            <th><div><?php echo get_phrase('rate');?></div></th>
                            <th><div><?php echo get_phrase('contact_1');?></div></th>
                            <th><div><?php echo get_phrase('contact_2');?></div></th>
                            <th><div><?php echo get_phrase('contact_3');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php
							foreach($tranfer_rates as $row):
						?>
                        <tr>
                            <td><?php echo $row['id'];?></td>
							<td><?php echo $row['from_country_name'];?></td>
                            <td><?php echo $row['to_country_name'];?></td>
                            <td><?php echo $row['rate'];?></td>      
                            <td><?php echo $row['contact_1'];?></td>      
                            <td><?php echo $row['contact_2'];?></td>      
                            <td><?php echo $row['contact_3'];?></td>      
		      				<td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-default pull-right" role="menu">

                                    <!-- EDITING LINK -->
                                    <li>
                                        <a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_transfer_rate/<?php echo $row['id'];?>');">
                                            <i class="entypo-pencil"></i>
                                                <?php echo get_phrase('edit');?>
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
		</div>
	</div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		var datatable = $("#table_export").dataTable();

		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});

</script>
