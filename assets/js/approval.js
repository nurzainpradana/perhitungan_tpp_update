var getUrl = window.location;
var baseUrl =
	getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split("/")[1];
var save_method;
var table;

$(document).ready(function () {
	$(".loading").hide();

	loadPegawaiOptionList();

	table = $("#tableApproval").DataTable({
		processing: true, //Feature control the processing indicator.
		serverSide: true, //Feature control DataTables' server-side processing mode.
		searching: true,
		paging: true,
		lengthChange: true,
		pageLength: 10,

		// Load data for the table's content from an Ajax source
		ajax: {
			url: baseUrl + "/Approval/loadApprovalListDatatables",
			type: "POST",
			data: function (data) {
				data.periode = $("#inputPeriode").val();
			},
		},

		//Set column definition initialisation properties.
		columnDefs: [
			{
				targets: [0],
				orderable: false, // set not orderable
			},
		],
	});

	$("#btnSave").click(function (e) {
		if (
			checkEmptyInputWithMessageArray(["#inputlevelApproval", "#inputPegawai"])
		) {
			$(".loading").show();
			$.ajax({
				url: baseUrl + "/Approval/Add",
				type: "POST",
				data: {
					id_pegawai: $("#inputPegawai").val(),
					level_approval: $("#inputlevelApproval").val(),
				},
				dataType: "JSON",
				success: function (response) {
					$(".loading").hide();
					$("#jabatanForm")[0].reset();
					if (response.status == "success") {
						Swal.fire({
							icon: "success",
							title: "Berhasil!",
							text: response.message,
						});
					} else {
						Swal.fire({
							icon: "error",
							title: "Gagal!",
							text: response.message,
						});
					}
					reload_table();
				},
				error: function (response) {
					$(".loading").hide();
					Swal.fire({
						icon: "error",
						title: "Gagal!",
						text: "Gagal melakukan proses simpan Approval",
					});
				},
			});
		}
	});
});

function loadPegawaiOptionList() {
	$.ajax({
		url: baseUrl + "/Pegawai/loadPegawaiListOption",
		type: "POST",
		success: function (response) {
			$("#inputPegawai").empty();

			$("#inputPegawai").append(response);
		},
	});
}

function reload_table() {
	table.ajax.reload(null, false); //reload datatable ajax
}
