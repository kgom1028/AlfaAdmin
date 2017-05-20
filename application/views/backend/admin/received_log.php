<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered">
	<thead>
		<tr>
			<th><?php echo get_phrase('received_date');?></th>
			<th><?php echo get_phrase('sender');?></th>
			<th><?php echo get_phrase('received_chanel');?></th>
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
				<input type="text" class="form-control" id="fromphone" name="fromphone" value="" placeholder="recipient"/>
			</td>
			<td>
				<select id="tophone" name="tophone" class="form-control">
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
				<select id="type" name="type" class="form-control">
				    <option value="all">All</option>
					<option value="text">Text</option>
					<option value="image">Image</option>
					<option value="video">Video</option>
					<option value="audio">Audio</option>
					<option value="location">Location</option>
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
            <th><div><?php echo get_phrase('received_time');?></div></th>
            <th><div><?php echo get_phrase('sender');?></div></th>
            <th><div><?php echo get_phrase('received_chanel');?></div></th>
            <th><div><?php echo get_phrase('type');?></div></th>
            <th style="width: 40%"><div><?php echo get_phrase('content');?></div></th>
            <th><div><?php echo get_phrase('message_id');?></div></th>
            <!--<th><div><?php echo get_phrase('action');?></div></th>-->
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
			'url': base_url + 'index.php?admin/ajax_received_log_filter/'+date + "/" +from+'/'+to+'/'+type + "/" + content,
			'type': 'POST'
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
			{ "data": "received_time" },
			{ "data": "fromphone" },
			{ "data": "tophone" },
			{ "data": "type" },
			{ "data": "", 
			    "render": function (data, type, row, meta) {
			    	var data = "";
				    if(row.type == "text"){
				    	data += emojione.unicodeToImage(row.content);
				    }
				    else if(row.type == "image"){
						data += "<a href='"+row.content+"' target='blank'><img src='"+row.content+"' class='img-thumbnail' width='50' title='"+ row.caption +"'/></a>";
				    }
				    else if(row.type == "audio"){
				    	data += "<a href='"+row.content+"' target='blank'><img src='"+base_url+"assets/images/audio.gif' title='audio link' width='50'></a>";
				    }
				    else if(row.type == "video"){
				    	data += "<a href='"+row.content+"' target='blank'><img src='"+base_url+"assets/images/video.png' title='video link' width='50'></a>";
				    }
				    else if(row.type == "location"){
				    	data += "<a href='https://www.google.com/maps/preview/@"+row.content+",20z' target='blank'><img src='"+base_url+"assets/images/map.jpg' title='audio link' width='50'></a>";
				    }
				    else {
					    data += row.content;
				    }
					return data;
				}
			},
			{ "data": "message_id" },
		]
	});

	$('#log_table').on( 'draw.dt', function (e, settings) {
	    setValues(settings._iDisplayStart, settings._iDisplayLength);
	} );

	$("#search").click(function(){
		date = $("#sent_time").val();
		if(date == "") date = "all";
		
		to = $("#tophone").val();
		
		from = $("#fromphone").val().replace(/ /g, '');
		if(from == "") from = "all";
		
		type = $("#type").val();

		content = $.trim($("#content").val());
		if(content == "") content = "all";

		$('#log_table').dataTable().api().ajax.url(base_url + "index.php?admin/ajax_received_log_filter/"+date + "/" +from+'/'+to+'/'+type + "/" + content).load();
	});
});

var timer;

function onFirstPage(){
	timer = setTimeout(function(){ $('#log_table').dataTable().api().ajax.url(base_url + "index.php?admin/ajax_received_log_filter/"+date + "/" + from+'/'+to+'/'+type + "/" + content).load();}, 3000);//set 3s
}

function onNoneFirstPage(){
	timer = setTimeout(function(){ $('#log_table').dataTable().api().ajax.url(base_url + "index.php?admin/ajax_received_log_filter/"+date + "/" + from+'/'+to+'/'+type + "/" + content).load(); }, 180000);//set 3min 3* 60 * 1000
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