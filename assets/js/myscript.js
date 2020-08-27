function loadPost() {
	$.ajax({
		url: BASE_URL + "server/post_con/recent",
		type: "GET",
		dataType: "json",
		success: function (data) {
			if (data.status == false) {
				$("#recent-post").html(
					`<div class="text-center">${data.message}</div>`
				);
			} else {
				data.data.forEach((post) => {
					$("#recent-post").append(`
                        <a style="font-size:small" href="${BASE_URL}/post/detail/${post.slug}" class="list-group-item list-group-item-action">${post.title}</a>
                    `);
				});
			}
		},
	});
}

function loadDataTable() {
	$("#publication-table").DataTable();
	$("#course-table").DataTable();
	$("#category-table").DataTable();
}

function readURL(input, field) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$(field).attr("src", e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
}
