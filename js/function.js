function allCheckbox() 
{
	var f = document.getElementById('all');
	f.onchange = function(e)
	{
		var el = e ? e.target : e.srcElement;
		var qwe = el.form.getElementsByClassName('qwe');
		for (var i =0; i<qwe.length; i++) 
		{
			if (el.checked) 
			{
				qwe[i].checked = true;
			} else 
			{
				qwe[i].checked = false;
			}
		}
	}
}
function sorter()
{
	$(document).ready(function(){
		$.fn.dataTableExt.oSort['math-path-asc']  = function(a,b) {
			var ruDatea=$.trim(a).split('.');
			var ruDateb=$.trim(b).split('.');

				if (ruDatea[1]*1<ruDateb[1]*1) return 1;
                if (ruDatea[1]*1>ruDateb[1]*1) return -1;
                if (ruDatea[1]*1 == ruDateb[1]*1)
				{
					if (ruDatea[0]*1<ruDateb[0]*1) return 1;
                    if (ruDatea[0]*1>ruDateb[0]*1) return -1;
				}
				else return 0;
		};

		$.fn.dataTableExt.oSort['math-path-desc'] = function(a,b) {
			var ruDatea=$.trim(a).split('.');
         	var ruDateb=$.trim(b).split('.');

				if (ruDatea[1]*1<ruDateb[1]*1) return -1;
                if (ruDatea[1]*1>ruDateb[1]*1) return 1;
                if (ruDatea[1]*1 == ruDateb[1]*1)
				{
					if (ruDatea[0]*1<ruDateb[0]*1) return -1;
                    if (ruDatea[0]*1>ruDateb[0]*1) return 1;
				}
				else return 0;
		};

		$('#table_id').DataTable({
		"aoColumnDefs":[
		{"aTargets":[0],'bSortable':false},
		{"aTargets":[8],"bSortable":false},
		{"sType": 'math-path', "aTargets": [1]}
		],
		searching: false,
		language: {
				"search": "Поиск:",
				"lengthMenu": "_MENU_ записей",
				"info": "_TOTAL_ записей",
				"infoEmpty": "Записи 0 записей",
				"infoFiltered": "(отфильтровано из _MAX_ записей)",
				"zeroRecords": "Записи отсутствуют",
				"emptyTable": "В таблице отсутствуют данные",
				"paginate": 
				{"first":"Первая",
				"previous":"Предыдущая",
				"next": "Следующая",
				"last": "Последняя"
				}
			}
		});
	});
}
function dateInput(){
	var d = document,
	 output = d.querySelector('output'),
	 type = {
	    week: 'week',
	    month: 'month',
	    year: 'year',
	 };
	 select.addEventListener('change', function() {
	  output.innerHTML = type.hasOwnProperty(this.value) ? '<input type="' + this.value + '" name="'+this.value+'" > ' : '';
	}, false);
}
