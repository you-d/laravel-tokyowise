$(window).load(function() {
	/* HOME */
	if ($("#main-body").length > 0) {
		/* Home - Headline Header Image */
		setOverlayCmsPanel("#main-body #headline-header-image",
					   	   "#main-body #home-cms-headline-header-img-overlay",
					   	   0,0,0,0);
		/* Home - Gadgets Module */
		setOverlayCmsPanel("#main #gadget-list",
					   	   "#home-cms-gadgets-module-overlay",
					   	   0,0,0,10);
	}
	if ($("#home-contents").length > 0) {
		/* Home - Headline Entry Top Large (headline-0) */
		setOverlayCmsPanel("#home-contents #headlines-section #headline-0",
						   "#home-contents #home-cms-headline-0-overlay",
						   0,0,0,0);
		/* Home - Headline Entry Small Top Left (headline-1) */
		setOverlayCmsPanel("#home-contents #headlines-section #headline-1",
						   "#home-contents #home-cms-headline-1-overlay",
						   0,0,0,0);
		/* Home - Headline Entry Small Top Right (headline-2) */
		setOverlayCmsPanel("#home-contents #headlines-section #headline-2",
						   "#home-contents #home-cms-headline-2-overlay",
						   0,0,0,0);
		/* Home - Headline Entry Small Bottom Left (headline-3) */
		setOverlayCmsPanel("#home-contents #headlines-section #headline-3",
						   "#home-contents #home-cms-headline-3-overlay",
						   0,0,0,0);
		/* Home - Headline Entry Small Bottom Right (headline-4) */
		setOverlayCmsPanel("#home-contents #headlines-section #headline-4",
						   "#home-contents #home-cms-headline-4-overlay",
						   0,0,0,0);
		/* Home - Features Highlight Section */
		setOverlayCmsPanel("#home-contents #features-section",
					   	   "#home-contents #home-cms-features-highlight-overlay",
					   	   0,0,0,0);
	}
	if ($("#home-side-contents").length > 0) {
		/* Home - News Module */
		setOverlayCmsPanel("#home-side-contents #news-list",
					   	   "#home-cms-news-module-overlay",
					       0,0,0,0);
		/* Home - Rensai Module */
		setOverlayCmsPanel("#home-side-contents #rensai-list-hybrid",
					   	   "#home-cms-rensai-module-overlay",
					       0,0,0,0);
	}
	/* FEATURES */
	if ($("#features-first-col").length > 0) {
		/* Features - First Col */
		setOverlayCmsPanel("#features-first-col",
						   "#features-cms-first-col-overlay",
						   0,0,0,0);
	}
	if ($("#features-side-contents").length > 0) {
		/* Features - Rensai Module */
		setOverlayCmsPanel("#features-side-contents #rensai-list-hybrid",
						   "#features-cms-rensai-module-overlay",
						   0,0,0,0);
		/* Features - News Module */
		setOverlayCmsPanel("#features-side-contents #news-list",
						   "#features-cms-news-module-overlay",
						   0,0,0,0);
		/* Features - Gadgets Module */
		setOverlayCmsPanel("#features-side-contents #gadget-list",
						   "#features-cms-gadgets-module-overlay",
						   0,0,0,10);
	}
	/* RENSAI */
	if ($("#rensai-first-col").length > 0) {
		/* Rensai - New Articles Section */
		setOverlayCmsPanel("#rensai-first-col #rensai-new-articles-list",
						   "#rensai-cms-new-article-section-overlay",
						   0,0,0,0);
		/* Rensai - Article Categories Section */
		setOverlayCmsPanel("#rensai-first-col #rensai-article-cat-list",
						   "#rensai-cms-article-cat-list-overlay",
						   0,0,-4,-3);
	}
	if ($("#rensai-category-first-col").length > 0) {
		/* Rensai - Category Post List Section */
		setOverlayCmsPanel("#rensai-category-first-col div.cms_panel_fixer",
						   "#rensai-category-cms-post-list-overlay",
						   0,0,0,0);
	}
	if ($("#rensai-side-contents").length > 0) {
		/* Rensai - Features Module */
		setOverlayCmsPanel("#rensai-side-contents #features-list-hybrid",
						   "#rensai-cms-features-module-overlay",
						   0,0,0,0);
		/* Rensai - News Module */
		setOverlayCmsPanel("#rensai-side-contents #news-list",
						   "#rensai-cms-news-module-overlay",
						   0,0,0,0);
		/* Rensai - Gadgets Module */
		setOverlayCmsPanel("#rensai-side-contents #gadget-list",
						   "#rensai-cms-gadgets-module-overlay",
						   0,0,0,10);
	}
	if ($("#rensai-post-first-col").length > 0) {
		/* Rensai - Post Content */
		setOverlayCmsPanel("#rensai-post-first-col .post-content",
						   "#rensai-cms-rensai-post-overlay",
						   0,0,0,8);
	}
	/* GADGETS */
	if ($("#gadgets-first-col").length > 0) {
		/* Gadgets - First Col */
		setOverlayCmsPanel("#gadgets-first-col",
						   "#gadgets-cms-first-col-overlay",
						   0,0,0,0);
	}
	if ($("#gadgets-second-col").length > 0) {
		/* Gadgets - Features Module */
		setOverlayCmsPanel("#gadgets-side-contents #features-list-hybrid",
						   "#gadgets-cms-features-module-overlay",
						   0,0,0,0);
		/* Gadgets - Rensai Module */
		setOverlayCmsPanel("#gadgets-side-contents #rensai-list-hybrid",
						   "#gadgets-cms-rensai-module-overlay",
						   0,0,0,0);
		/* Gadgets - News Module */
		setOverlayCmsPanel("#gadgets-side-contents #news-list",
						   "#gadgets-cms-news-module-overlay",
						   0,0,0,0);
	}
	/* NEWS */
	if ($("#news-first-col").length > 0) {
		/* News - First Col */
		setOverlayCmsPanel("#news-first-col",
						   "#news-cms-first-col-overlay",
						   0,0,0,0);
	}
	if ($("#news-second-col").length > 0) {
		/* News - Features Module */
		setOverlayCmsPanel("#news-side-contents #features-list-hybrid",
						   "#news-cms-features-module-overlay",
						   0,0,0,0);
		/* News - Rensai Module */
		setOverlayCmsPanel("#news-side-contents #rensai-list-hybrid",
						   "#news-cms-rensai-module-overlay",
						   0,0,0,0);
		/* News - Gadgets Module */
		setOverlayCmsPanel("#news-side-contents #gadget-list",
						   "#news-cms-gadgets-module-overlay",
						   0,0,0,10);
	}
	/* EDITORS */
	if ($("#editors-first-col").length > 0) {
		/* Editors - First Col */
		setOverlayCmsPanel("#editors-first-col",
						   "#editors-cms-first-col-overlay",
						   0,0,0,0);
	}
	if ($("#editors-side-contents").length > 0) {
		/* Editors - Features Module */
		setOverlayCmsPanel("#editors-side-contents #features-list-hybrid",
						   "#editors-cms-features-module-overlay",
						   0,0,0,0);
		/* Editors - Rensai Module */
		setOverlayCmsPanel("#editors-side-contents #rensai-list-hybrid",
						   "#editors-cms-rensai-module-overlay",
						   0,0,0,0);
		/* Editors - News Module */
		setOverlayCmsPanel("#editors-side-contents #news-list",
						   "#editors-cms-news-module-overlay",
						   0,0,0,0);
		/* Editors - Gadgets Module */
		setOverlayCmsPanel("#editors-side-contents #gadget-list",
						   "#editors-cms-gadgets-module-overlay",
						   0,0,0,10);
	}
});

$(document).ready(function() {
	// Tell JQuery to pass along the "X-CSRF-Token" header on every AJAX Request
	$.ajaxSetup({
		headers:{'X-CSRF-Token':$('meta[name=_token]').attr('content')}
	});
	/* Demo Mode Dialog */
	$("#demo-mode-dialog #cancel-btn").click(function() {
		$("#demo-mode-dialog").dialog("close");
	});
	/* HOME */
	/* Home - Headline Header Img */
	HandleBasicDialogFunctionality("#edit-home-headline-header-img", "#home-headline-header-img-dialog", 700, 280);
	$("#home-headline-header-img-dialog #submit-btn").click(function() {
		$(this).attr("disabled", "disabled");
		var form = $("#home-headline-header-img-dialog #cms-form");
		var formAction = form.attr('url');
		var formData = new FormData();
		formData.append("wide-img-input", $("#home-headline-header-img-dialog #wide-img-input")[0].files[0]);
		formData.append("narrow-img-input", $("#home-headline-header-img-dialog #narrow-img-input")[0].files[0]);
		formData.append("category", "home-header-img");
		var request = $.ajax({type: "POST",
							  url: formAction,
							  data: formData,
							  contentType: false, // force jQuery not to add a Content-Type header
							  cache: false,
							  processData: false, // prevent jQuery from converting the FormData to string
							  success: function() {}
							});
		request.always(function(outputMsg) {
			if (outputMsg == 'ok') {
					$("#home-headline-header-img-dialog").dialog("close");
					window.location.reload();
			} else if (outputMsg == 'demo') {
					$("#demo-mode-dialog").dialog({
						modal:true, resizable:false, draggable:false, width:600, height:200,
					});
			} else {
					// get the height of the table inside the dialog
					var prevheight = $("#home-headline-header-img-dialog .cms-content-frame").height();
					// inject the error list
					$("#home-headline-header-img-dialog #error-list").html(outputMsg);
					// get the updated height of the table inside the dialog
					var newheight = $("#home-headline-header-img-dialog .cms-content-frame").height();
					// change the height of the dialog
					var currdialogheight = $("#home-headline-header-img-dialog").height();
					$("#home-headline-header-img-dialog").height(currdialogheight + newheight - prevheight);
			}
			$("#home-headline-header-img-dialog #submit-btn").attr("disabled", false);
		});
	});
	/* Home - Headlines Section */
	/* Home - Headline #0 */
	HandleBasicDialogFunctionality("#edit-home-headline-0", "#home-headline-0-dialog", 700, 230);
	HandleHomeHeadlineDropdownMechanism("#home-headline-0-dialog");
	HandleHomeHeadlineSubmitAction("#home-headline-0-dialog", "0");
	/* Home - Headline #1 */
	HandleBasicDialogFunctionality("#edit-home-headline-1", "#home-headline-1-dialog", 700, 230);
	HandleHomeHeadlineDropdownMechanism("#home-headline-1-dialog");
	HandleHomeHeadlineSubmitAction("#home-headline-1-dialog", "1");
	/* Home - Headline #2 */
	HandleBasicDialogFunctionality("#edit-home-headline-2", "#home-headline-2-dialog", 700, 230);
	HandleHomeHeadlineDropdownMechanism("#home-headline-2-dialog");
	HandleHomeHeadlineSubmitAction("#home-headline-2-dialog", "2");
	/* Home - Headline #3 */
	HandleBasicDialogFunctionality("#edit-home-headline-3", "#home-headline-3-dialog", 700, 230);
	HandleHomeHeadlineDropdownMechanism("#home-headline-3-dialog");
	HandleHomeHeadlineSubmitAction("#home-headline-3-dialog", "3");
	/* Home - Headline #4 */
	HandleBasicDialogFunctionality("#edit-home-headline-4", "#home-headline-4-dialog", 700, 230);
	HandleHomeHeadlineDropdownMechanism("#home-headline-4-dialog");
	HandleHomeHeadlineSubmitAction("#home-headline-4-dialog", "4");
	/* Home - News Module */
	HandleBasicDialogFunctionality("#edit-home-news-module", "#home-news-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#home-news-module-dialog", "home-news-module");
	/* Home - Gadgets Module */
	HandleBasicDialogFunctionality("#edit-home-gadgets-module", "#home-gadgets-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#home-gadgets-module-dialog", "home-gadgets-module");
	/* Home - Rensai Module */
	HandleBasicDialogFunctionality("#edit-home-rensai-module", "#home-rensai-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#home-rensai-module-dialog", "home-rensai-module");
	/* Home - Features Highlight Section */
	HandleBasicDialogFunctionality("#edit-home-features-highlight", "#home-features-highlight-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#home-features-module-dialog", "home-features-module");
	/* FEATURES */
	/* Features - Rensai Module */
	HandleBasicDialogFunctionality("#edit-features-rensai-module", "#features-rensai-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#features-rensai-module-dialog", "features-rensai-module");
	/* Features - News Module */
	HandleBasicDialogFunctionality("#edit-features-news-module", "#features-news-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#features-news-module-dialog", "features-news-module");
	/* Features - Gadgets Module */
	HandleBasicDialogFunctionality("#edit-features-gadgets-module", "#features-gadgets-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#features-gadgets-module-dialog", "features-gadgets-module");
	/* RENSAI */
	/* Rensai - New Articles List Section */
	HandleBasicDialogFunctionality("#edit-rensai-new-article-section", "#rensai-new-article-section-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#rensai-new-article-section-dialog", "rensai-new-articles-list");
	/* Rensai - Category List Section */
	HandleBasicDialogFunctionality("#add-rensai-article-cat", "#rensai-create-article-category-dialog", 700, 570);
	HandleBasicDialogFunctionality("#remove-rensai-article-cat", "#rensai-remove-article-category-dialog", 700, 230);
	$("#rensai-create-article-category-dialog #submit-btn").click(function() {
		$(this).attr("disabled", "disabled");
		var form = $("#rensai-create-article-category-dialog #cms-form");
		var formAction = form.attr('url');
		var formData = new FormData();
		formData.append("category-title", $("#rensai-create-article-category-dialog #category-title").val());
		formData.append("category-description", $("#rensai-create-article-category-dialog #category-description").val());
		formData.append("post-title", $("#rensai-create-article-category-dialog #post-title").val());
		formData.append("category-header-img", $("#rensai-create-article-category-dialog #category-header-img")[0].files[0]);
		formData.append("article-header-img", $("#rensai-create-article-category-dialog #article-header-img")[0].files[0]);
		formData.append("side-icon-img", $("#rensai-create-article-category-dialog #side-icon-img")[0].files[0]);
		formData.append("article-body", $("#rensai-create-article-category-dialog #article-body")[0].files[0]);
		formData.append("main-article-img", $("#rensai-create-article-category-dialog #main-article-img")[0].files[0]);
		formData.append("category", "rensai-create-article-category");
		var request = $.ajax({type: "POST",
							  url: formAction,
							  data: formData,
							  contentType: false, // force jQuery not to add a Content-Type header
							  cache: false,
							  processData: false, // prevent jQuery from converting the FormData to string
							  success: function() {}
							});
		request.always(function(outputMsg) {
			if (outputMsg == 'ok') {
				$("#rensai-create-article-category-dialog").dialog("close");
				window.location.reload();
			} else if (outputMsg == 'demo') {
				$("#demo-mode-dialog").dialog({
					modal:true, resizable:false, draggable:false, width:600, height:200,
				});
			} else {
				// get the height of the table inside the dialog
				var prevheight = $("#rensai-create-article-category-dialog #table2").height();
				// inject the error list
				$("#rensai-create-article-category-dialog #table2 #error-list").html(outputMsg);
				// get the updated height of the table inside the dialog
				var newheight = $("#rensai-create-article-category-dialog #table2").height();
				// change the height of the dialog
				var currdialogheight = $("#rensai-create-article-category-dialog").height();
				$("#rensai-create-article-category-dialog").height(currdialogheight + newheight - prevheight);
			}
			$("#rensai-create-article-category-dialog #submit-btn").attr("disabled", false);
		});
	});
	$("#rensai-remove-article-category-dialog #submit-btn").click(function() {
		//$(this).attr("disabled", "disabled");
		var form = $("#rensai-remove-article-category-dialog #cms-form");
		var formAction = form.attr('url');
		var category = "rensai-delete-article-category";
		var arg1 = $("#rensai-remove-article-category-dialog #selected-category").val();
		var dataString = "arg1=" + arg1 + "&category=" + category;
		var request = $.ajax({type: "POST",
							  url: formAction,
							  data: dataString,
							  success: function() {
							  		//$(this).removeAttr("disabled");
										request.done(function() {
												//window.location.reload();
												$("#demo-mode-dialog").dialog({
													modal:true, resizable:false, draggable:false, width:600, height:200,
												});
										});
										//$("#rensai-remove-article-category-dialog").dialog("close");
							  }
							});
	});
	/* Rensai (Category Page) - Category Post List */
	HandleBasicDialogFunctionality("#rensai-category-cms-edit-category", "#rensai-category-edit-category-dialog", 750, 500);
	HandleBasicDialogFunctionality("#rensai-category-cms-create-post", "#rensai-category-create-post-dialog", 700, 320);
	HandleBasicDialogFunctionality("#rensai-category-cms-delete-post", "#rensai-category-delete-post-dialog", 700, 200);
	$("#rensai-category-edit-category-dialog #submit-btn").click(function() {
		$(this).attr("disabled", "disabled");
		var form = $("#rensai-category-create-post-dialog #cms-form");
		var formAction = form.attr('url');
		var formData = new FormData();
		formData.append("category-title", $("#rensai-category-edit-category-dialog #category-title").val());
		formData.append("category-description", $("#rensai-category-edit-category-dialog #category-description").val());
		formData.append("category-header-img", $("#rensai-category-edit-category-dialog #category-header-img")[0].files[0]);
		formData.append("article-header-img", $("#rensai-category-edit-category-dialog #article-header-img")[0].files[0]);
		formData.append("side-icon-img", $("#rensai-category-edit-category-dialog #side-icon-img")[0].files[0]);
		formData.append("category", "rensai-edit-category");
		var request = $.ajax({type: "POST",
							  url: formAction,
							  data: formData,
							  contentType: false, // force jQuery not to add a Content-Type header
							  cache: false,
							  processData: false // prevent jQuery from converting the FormData to string
							});
		request.always(function(outputMsg) {
			if (outputMsg == 'ok') {
				$("#rensai-category-edit-category-dialog").dialog("close");
				window.location.reload();
			} else if (outputMsg == 'demo') {
				$("#demo-mode-dialog").dialog({
					modal:true, resizable:false, draggable:false, width:600, height:200,
				});
			} else {
				// get the height of the table inside the dialog
				var prevheight = $("#rensai-category-edit-category-dialog .cms-content-frame").height();
				// inject the error list
				$("#rensai-category-edit-category-dialog .cms-content-frame #error-list").html(outputMsg);
				// get the updated height of the table inside the dialog
				var newheight = $("#rensai-category-edit-category-dialog .cms-content-frame").height();
				// change the height of the dialog
				var currdialogheight = $("#rensai-category-edit-category-dialog").height();
				$("#rensai-category-edit-category-dialog").height(currdialogheight + newheight - prevheight);
			}
			$("#rensai-category-edit-category-dialog #submit-btn").attr("disabled", false);
		});
	});
	$("#rensai-category-create-post-dialog #submit-btn").click(function() {
		$(this).attr("disabled", "disabled");
		var form = $("#rensai-category-create-post-dialog #cms-form");
		var formAction = form.attr('url');
		var formData = new FormData();
		formData.append("category-id", $("#rensai-category-create-post-dialog #category-id").val());
		formData.append("post-title", $("#rensai-category-create-post-dialog #post-title").val());
		formData.append("article-body", $("#rensai-category-create-post-dialog #article-body")[0].files[0]);
		formData.append("main-article-img", $("#rensai-category-create-post-dialog #main-article-img")[0].files[0]);
		formData.append("category", "rensai-create-new-post");
		var request = $.ajax({type: "POST",
							  url: formAction,
							  data: formData,
							  contentType: false, // force jQuery not to add a Content-Type header
							  cache: false,
							  processData: false // prevent jQuery from converting the FormData to string
							});
		request.always(function(outputMsg) {
			if (outputMsg == 'ok') {
				$("#rensai-category-create-post-dialog").dialog("close");
				window.location.reload();
			} else if (outputMsg == 'demo') {
				$("#demo-mode-dialog").dialog({
					modal:true, resizable:false, draggable:false, width:600, height:200,
				});
			} else {
				// get the height of the table inside the dialog
				var prevheight = $("#rensai-category-create-post-dialog .cms-content-frame").height();
				// inject the error list
				$("#rensai-category-create-post-dialog .cms-content-frame #error-list").html(outputMsg);
				// get the updated height of the table inside the dialog
				var newheight = $("#rensai-category-create-post-dialog .cms-content-frame").height();
				// change the height of the dialog
				var currdialogheight = $("#rensai-category-create-post-dialog").height();
				$("#rensai-category-create-post-dialog").height(currdialogheight + newheight - prevheight);
			}
			$("#rensai-category-create-post-dialog #submit-btn").attr("disabled", false);
		});
	});
	$("#rensai-category-delete-post-dialog #submit-btn").click(function() {
		$(this).attr("disabled", "disabled");
		var form = $("#rensai-category-delete-post-dialog #cms-form");
		var formAction = form.attr('url');
		var formData = new FormData();
		formData.append("category-id", $("#rensai-category-create-post-dialog #category-id").val());
		formData.append("arg1", $("#rensai-category-delete-post-dialog #selected-post").val());
		formData.append("category", "rensai-delete-a-post");
		var request = $.ajax({type: "POST",
					  url: formAction,
					  data: formData,
					  contentType: false, // force jQuery not to add a Content-Type header
					  cache: false,
					  processData: false, // prevent jQuery from converting the FormData to string
					  success: function() {}
					});
		request.always(function(outputMsg) {
			if (outputMsg == 'ok') {
				$("#rensai-category-delete-post-dialog").dialog("close");
				window.location.reload();
			} else if (outputMsg == 'demo') {
				$("#demo-mode-dialog").dialog({
					modal:true, resizable:false, draggable:false, width:600, height:200,
				});
			} else if (outputMsg == 'error') {

			} else {
				// get the height of the table inside the dialog
				var prevheight = $("#rensai-category-delete-post-dialog .cms-content-frame").height();
				// inject the error list
				$("#rensai-category-delete-post-dialog .cms-content-frame #error-list").html(outputMsg);
				// get the updated height of the table inside the dialog
				var newheight = $("#rensai-category-delete-post-dialog .cms-content-frame").height();
				// change the height of the dialog
				var currdialogheight = $("#rensai-category-delete-post-dialog").height();
				$("#rensai-category-delete-post-dialog").height(currdialogheight + newheight - prevheight);
			}
			$("#rensai-category-delete-post-dialog #submit-btn").attr("disabled", false);
		});
	});
	/* Rensai (Post Page) - Post Content */
	HandleBasicDialogFunctionality("#edit-rensai-post", "#rensai-post-dialog", 700, 310);
	$("#rensai-post-dialog #submit-btn").click(function() {
		$(this).attr("disabled", "disabled");
		var form = $("#rensai-post-dialog #cms-form");
		var formAction = form.attr('url');
		var formData = new FormData();
		formData.append("primary-id", $("#rensai-post-dialog #primary-id").val());
		formData.append("post-title", $("#rensai-post-dialog #post-title").val());
		formData.append("main-article-img", $("#rensai-post-dialog #main-article-img")[0].files[0]);
		formData.append("article-body", $("#rensai-post-dialog #article-body")[0].files[0]);
		formData.append("category", "rensai-edit-a-post");
		var request = $.ajax({type: "POST",
					  		  url: formAction,
					  		  data: formData,
					  		  contentType: false, // force jQuery not to add a Content-Type header
					  		  cache: false,
					  		  processData: false // prevent jQuery from converting the FormData to string
							});
		request.always(function(outputMsg) {
			if (outputMsg == 'ok') {
				$("#rensai-post-dialog").dialog("close");
				window.location.reload();
			} else if (outputMsg == 'demo') {
				$("#demo-mode-dialog").dialog({
					modal:true, resizable:false, draggable:false, width:600, height:200,
				});
			} else if (outputMsg == 'error') {

			} else {
				// get the height of the table inside the dialog
				var prevheight = $("#rensai-post-dialog .cms-content-frame").height();
				// inject the error list
				$("#rensai-post-dialog .cms-content-frame #error-list").html(outputMsg);
				// get the updated height of the table inside the dialog
				var newheight = $("#rensai-post-dialog .cms-content-frame").height();
				// change the height of the dialog
				var currdialogheight = $("#rensai-post-dialog").height();
				$("#rensai-post-dialog").height(currdialogheight + newheight - prevheight);
			}
			$("#rensai-post-dialog #submit-btn").attr("disabled", false);
		});
	});
	/* Rensai - Features Module */
	HandleBasicDialogFunctionality("#edit-rensai-features-module", "#rensai-features-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#rensai-features-module-dialog", "rensai-features-module");
	/* Rensai - News Module */
	HandleBasicDialogFunctionality("#edit-rensai-news-module", "#rensai-news-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#rensai-news-module-dialog", "rensai-news-module");
	/* Rensai - Gadgets Module */
	HandleBasicDialogFunctionality("#edit-rensai-gadgets-module", "#rensai-gadgets-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#rensai-gadgets-module-dialog", "rensai-gadgets-module");
	/* GADGETS */
	/* Gadgets - News Module */
	HandleBasicDialogFunctionality("#edit-gadgets-news-module", "#gadgets-news-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#gadgets-news-module-dialog", "gadgets-news-module");
	/* Gadgets - Rensai Module */
	HandleBasicDialogFunctionality("#edit-gadgets-rensai-module", "#gadgets-rensai-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#gadgets-rensai-module-dialog", "gadgets-rensai-module");
	/* Gadgets - Features Module */
	HandleBasicDialogFunctionality("#edit-gadgets-features-module", "#gadgets-features-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#gadgets-features-module-dialog", "gadgets-features-module");
	/* NEWS */
	/* News - Features Module */
	HandleBasicDialogFunctionality("#edit-news-features-module", "#news-features-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#news-features-module-dialog", "news-features-module");
	/* News - Rensai Module */
	HandleBasicDialogFunctionality("#edit-news-rensai-module", "#news-rensai-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#news-rensai-module-dialog", "news-rensai-module");
	/* News - Gadgets Module */
	HandleBasicDialogFunctionality("#edit-news-gadgets-module", "#news-gadgets-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#news-gadgets-module-dialog", "news-gadgets-module");
	/* EDITORS */
	/* Editors - News Module */
	HandleBasicDialogFunctionality("#edit-editors-news-module", "#editors-news-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#editors-news-module-dialog", "editors-news-module");
	/* Editors - Features Module */
	HandleBasicDialogFunctionality("#edit-editors-features-module", "#editors-features-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#editors-features-module-dialog", "editors-features-module");
	/* Editors - Rensai Module */
	HandleBasicDialogFunctionality("#edit-editors-rensai-module", "#editors-rensai-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#editors-rensai-module-dialog", "editors-rensai-module");
	/* Editors - Gadgets Module */
	HandleBasicDialogFunctionality("#edit-editors-gadgets-module", "#editors-gadgets-module-dialog", 400, 200);
	HandleChangeEntriesNumOnlyDialogSubmitAction("#editors-gadgets-module-dialog", "editors-gadgets-module");
});

/* HELPER FUNCTIONS */
function setOverlayCmsPanel($reference, $target, $heightOffset,
							$widthOffset, $topOffset, $leftOffset) {
	// set the absolute position
	var position = $($reference).offset();
	$($target).css("position", "absolute");
	$($target).css("top", position.top + $topOffset);
	$($target).css("left", position.left + $leftOffset);
	// set the dimension
	var assignedHeight = $($reference).height();
	var assignedWidth = $($reference).width();
	$($target).height(assignedHeight + $heightOffset);
	$($target).width(assignedWidth + $widthOffset);
}

function HandleBasicDialogFunctionality(triggerId, dialogId, desiredWidth, desiredHeight) {
	$(triggerId).click(function() {
		$(dialogId).dialog({
			modal:true, resizable:false, draggable:false, width:desiredWidth, height:desiredHeight,
		});
	});
	$(dialogId + " #cancel-btn").click(function() {
		$(dialogId).dialog("close");
		$(dialogId + " #error-list").html('');
	});
}

function HandleHomeHeadlineDropdownMechanism(dialogId) {
	var displayedHeadline = $(dialogId + " #displayedHeadline").val();
	switch($(dialogId + " #entry-category").val()) {
		case "Features" :
			$(dialogId + " #features-entry-post-options").css("display", "block");
			$(dialogId + " #features-entry-post-options option[value='" + displayedHeadline + "']").
				attr("selected", "true");
		break;
		case "Rensai" :
			$(dialogId + " #rensai-entry-post-options").css("display", "block");
			$(dialogId + " #rensai-entry-post-options option[value='" + displayedHeadline + "']").
				attr("selected", "true");
		break;
		case "News" :
			$(dialogId + " #news-entry-post-options").css("display", "block");
			$(dialogId + " #news-entry-post-options option[value='" + displayedHeadline + "']").
				attr("selected", "true");
		break;
		case "Gadgets" :
			$(dialogId + " #gadgets-entry-post-options").css("display", "block");
			$(dialogId + " #gadgets-entry-post-options option[value='" + displayedHeadline + "']").
				attr("selected", "true");
		break;
	}
	$(dialogId + " #entry-category").change(function() {
		var displayedHeadline = $(dialogId + " #displayedHeadline").val();
		switch($(dialogId + " #entry-category").val()) {
			case "Features" :
				$(dialogId + " #rensai-entry-post-options").css("display", "none");
				$(dialogId + " #news-entry-post-options").css("display", "none");
				$(dialogId + " #gadgets-entry-post-options").css("display", "none");

				$(dialogId + " #features-entry-post-options").css("display", "block");
				$(dialogId + " #features-entry-post-options option[value='" + displayedHeadline + "']").
					attr("selected", "true");
				break;
			case "Rensai" :
				$(dialogId + " #news-entry-post-options").css("display", "none");
				$(dialogId + " #gadgets-entry-post-options").css("display", "none");
				$(dialogId + " #features-entry-post-options").css("display", "none");

				$(dialogId + " #rensai-entry-post-options").css("display", "block");
				$(dialogId + " #rensai-entry-post-options option[value='" + displayedHeadline + "']").
					attr("selected", "true");
				break;
			case "News" :
				$(dialogId + " #gadgets-entry-post-options").css("display", "none");
				$(dialogId + " #features-entry-post-options").css("display", "none");
				$(dialogId + " #rensai-entry-post-options").css("display", "none");

				$(dialogId + " #news-entry-post-options").css("display", "block");
				$(dialogId + " #news-entry-post-options option[value='" + displayedHeadline + "']").
					attr("selected", "true");
				break;
			case "Gadgets" :
				$(dialogId + " #features-entry-post-options").css("display", "none");
				$(dialogId + " #rensai-entry-post-options").css("display", "none");
				$(dialogId + " #news-entry-post-options").css("display", "none");

				$(dialogId + " #gadgets-entry-post-options").css("display", "block");
				$(dialogId + " #gadgets-entry-post-options option[value='" + displayedHeadline + "']").
					attr("selected", "true");
				break;
		}
	});
}
/*
function HandleFormDataAjaxSubmitAction(dialogId, formData) {
	$(dialogId + " #submit-btn").click(function() {
		$(this).attr("disabled", "disabled");
		var form = $(dialogId + " #cms-form");
		var formAction = form.attr('url');
		var request = $.ajax({type: "POST",
							  url: formAction,
							  data: formData,
							  contentType: false, // force jQuery not to add a Content-Type header
							  cache: false,
							  processData: false, // prevent jQuery from converting the FormData to string
							  success: function() {}
							});
		request.always(function(outputMsg) {
			if (outputMsg == 'ok') {
				$(dialogId).dialog("close");
				window.location.reload();
			} else {
				alert(outputMsg);
			}
			$(dialogId + " #submit-btn").attr("disabled", false);
		});
	});
}
*/
function HandleChangeEntriesNumOnlyDialogSubmitAction(dialogId, categoryLabel) {
	$(dialogId + " #submit-btn").click(function() {
		$(this).attr("disabled", "disabled");
		var form = $(dialogId + " #cms-form");
		var formAction = form.attr('url');
		var category = categoryLabel;
		var arg1 = $(dialogId + " #entries-num").val();
		var dataString = "arg1=" + arg1 + "&category=" + category;
		var request = $.ajax({type: "POST",
							  url: formAction,
							  data: dataString,
							  success: function() {
							  		$(this).removeAttr("disabled");
									request.done(function() { window.location.reload(); });
									$(dialogId).dialog("close");
							  }
							});
	});
}

function HandleHomeHeadlineSubmitAction(dialogId, headlineIdx) {
	$(dialogId + " #submit-btn").click(function() {
		$(this).attr("disabled", "disabled");
		var form = $(dialogId + " #cms-form");
		var formAction = form.attr('url');
		var category = "home-headline-" + headlineIdx;
		var selectedEntryCategory = $(dialogId + " #entry-category").val();
		if (selectedEntryCategory == "Features") {
			var arg1 = $(dialogId + " #features-entry-post-options").val();
		} else if (selectedEntryCategory == "News") {
			var arg1 = $(dialogId + " #news-entry-post-options").val();
		} else if (selectedEntryCategory == "Rensai") {
			var arg1 = $(dialogId + " #rensai-entry-post-options").val();
		} else if (selectedEntryCategory == "Gadgets") {
			var arg1 = $(dialogId + " #gadgets-entry-post-options").val();
		} else if (selectedEntryCategory == "Editors") {
			var arg1 = $(dialogId + " #editors-entry-post-options").val();
		}
		var dataString = "arg1=" + arg1 + "&category=" + category;
		var request = $.ajax({type: "POST",
							  url: formAction,
							  data: dataString,
							  success: function() {
							  		$(this).removeAttr("disabled");
									request.done(function() { window.location.reload(); });
									$(dialogId).dialog("close");
							  }
							});
	});
}
