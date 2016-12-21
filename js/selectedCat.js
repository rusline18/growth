$(document).ready(function()
{
	$("#idCateg").change(function()
	{
		var categval = parseInt($("#idCateg").val());
		selectSubcat(categval);
	});
});

function selectSubcat(categval) {
	var subcategory = $("#idSubCat");
	var subCatContainer = $('#divSubcat');

	subCatContainer.hide();
	clear(subcategory);	

	if (categval>0) 
	{
		$("#divSubcat").fadeIn("fast");
		subcategory.load(
			"transactions.php",
			{categval: categval},
			function() 
			{
				subcategory.prop("disabled", false);
			});
	}
}

function clear(val)
{
	val.empty();
	val.prop("disabled", true);
	val.html("<option>Загрузка...</option>");
}