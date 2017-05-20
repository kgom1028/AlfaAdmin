<div class="row">
	<div class="col-md-12">

    	<!------CONTROL TABS END-------->
         <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo get_phrase('country_list');?>
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
                    		<th><div><?php echo get_phrase('Code');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php
							foreach($users as $row):
						?>
                        <tr>
                            <td><?php echo $row['id'];?></td>
							<td><?php echo $row['token'];?></td>
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
