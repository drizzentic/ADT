<style>
table.dataTable {
	zoom: 0.8;
}
table.dataTable td {
	max-width: 5px; 
	word-wrap:break-word;
}
</style>

<?php echo $followup_patients; ?>


<script type="text/javascript">
	
	// defaulter_table
	$(function(){

		$('.defaulter_table').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers",
					"sDom": '<"H"Tfr>t<"F"ip>',
					"oTableTools": {
						"sSwfPath": base_url+"assets/scripts/datatable/copy_csv_xls_pdf.swf",
						"aButtons": [ "copy", "print","xls","pdf" ]
					},
					"bProcessing": false,
					"bServerSide": false,
				});
	});
</script>