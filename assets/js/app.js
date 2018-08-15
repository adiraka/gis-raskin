$(function(){

	$('#data-rw').DataTable({
		"pagingType": "full_numbers",
		"lengthMenu": [
		[10, 25, 50, -1],
		[10, 25, 50, "All"]
		],
		responsive: true,
		language: {
			search: "_INPUT_",
			searchPlaceholder: "Search records",
		}
	});

	$('#data-rt').DataTable({
		"pagingType": "full_numbers",
		"lengthMenu": [
		[10, 25, 50, -1],
		[10, 25, 50, "All"]
		],
		responsive: true,
		language: {
			search: "_INPUT_",
			searchPlaceholder: "Search records",
		}
	});

	$('#rw_id').on('changed.bs.select', function(){
		var rwID = this.value;
		$.ajax({
			url: 'cores/dashboard/rw/response-list-rt.php',
			type: 'post',
			dataType: 'json',
			data: {
				rw_id: rwID
			},
			success: function(data) {
				$('#rt_id').children('option:not(:first)').remove();
				var option = '<option disabled> Pilih RT</option>';
				$.each(data, function(i, item){
					option += '<option value="'+item.id+'"> RT '+item.nama_rt+' : '+item.ketua_rt+'</option>';
					$('#rt_id').append(option);
				});
				$('#rt_id').selectpicker('refresh');
			}
		});
	});

	$('.datepicker').datetimepicker({
		format: 'YYYY-MM-DD',
		icons: {
			time: "fa fa-clock-o",
			date: "fa fa-calendar",
			up: "fa fa-chevron-up",
			down: "fa fa-chevron-down",
			previous: 'fa fa-chevron-left',
			next: 'fa fa-chevron-right',
			today: 'fa fa-screenshot',
			clear: 'fa fa-trash',
			close: 'fa fa-remove'
		}
	});

});
