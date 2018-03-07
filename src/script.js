/*commentaire*/

$(document).ready(function () {
	$("button.fav_modal_trigger").click(function (e) {
			var id = $(this).parents(".fav_card").attr("data-id");
			var thispostmodalcount = $("#modal_container #modal-post-" + id).length;
			if (thispostmodalcount <= 0) {
				$.post(
					ajaxurl,
					{
						'action': 'modal_post',
						'param': id
					},
					function (response) {


						$("#modal_container").append(response);


					}
				);

			}
		}
	);
	$(".menu_category_close, .menu_category_toggle ").click(function (event) {
		$(".menu_category_container").toggle();
	});

	$(document).keydown(function (e) {
		var code = e.keyCode || e.which;
		if (code == 27) { // escape key maps to keycode `27`
			$(".modal_background").hide();
		}
	});

	if (Cookies.get("nightmode") == "true") {
		$("body").addClass("nightmode");
		$("input.nightmode").prop("checked", true);
	}

	$("input.nightmode").change(
		function () {
			if (this.checked) {
				$("body").addClass("nightmode");
				Cookies.set("nightmode", "true");
			} else {
				$("body").removeClass("nightmode");
				Cookies.set("nightmode", "false");
			}
		});

	$(".fav_dummy").width($(".fav_card:first").width());
	$(".form input, .form textarea, .form select").on("change paste keyup", function () {
		var inputval = $(this).val();
		var inputid = $(this).attr('id');
		console.log(inputid);
		switch (inputid) {
			case "post_private":
				text_is_private = "";
				if ($(this).is(":checked") == true) {
					text_is_private = "🔒";
				}
			case "post_title":
				if (inputval.length == 0) {
					inputval = "titre";
				}
				$(".fav_dummy ." + inputid).text(text_is_private + inputval + text_is_private);
				break;
			case "post_category":
				var inputval = $(this).children("option:selected").text();
				if (inputval.length == 0) {
					inputval = "catégorie";
				}
				$(".fav_dummy .fav_tag").text(inputval);
				break;
			case "post_thumbnail":
				if (inputval.length == 0) {
					inputval = "http://fav.manusset.com/wp-content/themes/favoooris/assets/img/imgnotfound.svg";
				}
				$(".fav_dummy .fav_image img").attr("src", inputval);
				break;
		}
	});


	$(".search_form_toggle").click(function () {
		console.log("zergthg");
		$(this).toggleClass("actif");
	})
});
$(document).resize(function () {
	$(".fav_dummy").width($(".fav_card:first").width());
});
$(document).ajaxStop(function () {
	$("body").addClass("loading");
});


$(document).ajaxStop(function () {
	$("body").removeClass("loading");
	$('.modal_button_close, .modal_background').click(function () {
		$(this).parent().parent().parent().parent().hide()
	});
	$(".fav_card button").click(function (event) {
		var id = $(this).parents(".fav_card").attr("data-id");
		$("#modal-post-" + id).show();
	});

	$(".modal_background").click(function () {
		$(".modal_background").hide();
	});
});
