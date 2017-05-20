<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
	<thead>
		<tr>
			<th><?php echo get_phrase('sent_date');?></th>
			<th><?php echo get_phrase('chanel');?></th>
			<th><?php echo get_phrase('recipient');?></th>
			<th><?php echo get_phrase('type');?></th>
			<th><?php echo get_phrase('content');?></th>
			<th></th>
	   </tr>
   </thead>
	<tbody>
		<tr class="gradeA">
		    <td>
				<input type="text" id="sent_time" class="form-control datepicker" name="sent_time" value="" data-start-view="2"  data-format="yyyy-mm-dd">
			</td>
			<td>
				<select id="fromphone" name="fromphone" class="form-control">
					<option value="all">All</option>
				<?php 
				$chanels = $this->db->get('chanel')->result_array();
				foreach($chanels as $row): ?>
					<option value="<?php echo $row['phone']; ?>">
						<?php echo $row['phone'];?>
					</option>
				<?php endforeach;?>
				</select>
			</td>
			<td>
				<input type="text" class="form-control" id="tophone" name="tophone" value="" placeholder="recipient"/>
			</td>
			<td>
				<select id="type" name="type" class="form-control">
				    <option value="all">All</option>
					<option value="text">Text</option>
					<option value="image">Image</option>
					<option value="video">Video</option>
					<option value="audio">Audio</option>
					<option value="location">Location</option>
					<option value="error">Error</option>
				</select>
			</td>
			<td>
				<input type="text" class="form-control" id="content" name="content" value="" placeholder="content"/>
			</td>
			<td align="center"><input type="button" id="search" value="<?php echo get_phrase('search');?>" class="btn btn-red"/></td>
		</tr>
	</tbody>
</table>

<table class="table table-bordered datatable" id="log_table">
    <thead>
        <tr>
            <th><div><?php echo get_phrase('sent_time');?></div></th>
            <th><div><?php echo get_phrase('chanel');?></div></th>
            <th><div><?php echo get_phrase('recipient');?></div></th>
            <th><div><?php echo get_phrase('type');?></div></th>
            <th style="width: 40%"><div><?php echo get_phrase('content');?></div></th>
            <th><div><?php echo get_phrase('state');?></div></th>
            <!--<th><div><?php echo get_phrase('action');?></div></th>--->
        </tr>
    </thead>
</table>

<!-----  DATA TABLE EXPORT CONFIGURATIONS ----->                      
<script type="text/javascript">

var date = "all";
var from = "all";
var to = "all";
var type = "all";
var content = "all";
//init datatable
jQuery(document).ready(function () {
	$("#log_table").dataTable({
	  // All the properties you want...then in the end
		"processing": true,
		"serverSide": true,
		"responsive": true,
		'ajax': {
			'url': base_url + 'index.php?admin/ajax_sent_log_filter/'+date + "/" + from+'/'+to+'/'+type + "/" + content,
			'type': 'POST',
			'data' : ''
		},
		"order": [],
		"columnDefs": [
			{
				"targets": "_all",
				"orderable": false
			},
			{
				"targets": "_all",
				"searchable": false
			}
		],
		"aLengthMenu": [
			[5, 10, 15, 20, 50],
			[5, 10, 15, 20, 50] // change per page values here
		],
		// set the initial value
		"iDisplayLength": 10,
		bAutoWidth: true,
		bFilter: false,

		"columns": [
			{ "data": "sent_time" },
			{ "data": "fromphone" },
			{ "data": "tophone" },
			{ "data": "type" },
			{ "data": "", 
			    "render": function (data, type, row, meta) {
					if(row.type != "image")
						return row.content;
					var data = "<img src='"+row.content+"' class='img-thumbnail' width='50' />";
					return data;
				}
			},
			{ "data": "",
				"render": function (data, type, row, meta) {
					var data = "";
					if(row.state != "0"){
						data += "<div class='status_circle' title='Success' style='background-color:#00FF00; width: 20px; height: 20px; border-radius: 10px;'></div>";
					}
					else{
						data += "<div class='status_circle' title='Fail' style='background-color:#FF0000; width: 20px;height: 20px; border-radius: 10px;'></div>";
					}
					//var start = meta.settings._iDisplayStart;
					//if(start==0)
					//	onFirstPage();
					return data;
				}
			}
		]
	});

	$('#log_table').on( 'draw.dt', function (e, settings) {
	    setValues(settings._iDisplayStart, settings._iDisplayLength);
	} );

	$("#search").click(function(){
		date = $("#sent_time").val();
		if(date == "") date = "all";
		
		from = $("#fromphone").val();
		
		to = $("#tophone").val().replace(/ /g, '');
		if(to == "") to = "all";
		
		type = $("#type").val();

		content = $.trim($("#content").val());
		if(content == "") content = "all";

		$('#log_table').dataTable().api().ajax.url(base_url + "index.php?admin/ajax_sent_log_filter/"+date + "/" + from+'/'+to+'/'+type + "/" + content).load();
	});
});

/*
setInterval(
	function(){
		$('#log_table').dataTable().api().ajax.url(base_url + "index.php?admin/ajax_sent_log_filter/"+date + "/" + from+'/'+to+'/'+type + "/" + content).load();
	},
	5000);
//clearInterval();
*/
var timer;

function onFirstPage(){
	timer = setTimeout(function(){ $('#log_table').dataTable().api().ajax.url(base_url + "index.php?admin/ajax_sent_log_filter/"+date + "/" + from+'/'+to+'/'+type + "/" + content).load();}, 3000);//set 3s
}

function onNoneFirstPage(){
	timer = setTimeout(function(){ $('#log_table').dataTable().api().ajax.url(base_url + "index.php?admin/ajax_sent_log_filter/"+date + "/" + from+'/'+to+'/'+type + "/" + content).load(); }, 180000);//set 3min 3* 60 * 1000
}

function setValues(st, len){
	clearTimeout(timer);
	
	if(st=='0'){
		onFirstPage();
	}
	else{
		onNoneFirstPage();
	}
}
	
</script>

