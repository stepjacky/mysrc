var stat = [{
			attributes : {
				"id" : -1
			},
			data : "所属年级",
			state : "closed"
		}];
var chapter = -1;
var sorted = false;
var sortbtn = $("button[id='sortchapt']");
var cpanel = $("div[id='chapterPanel']");
var cpttree, cptnode;
$(function() {
			$.ajax({
						type : "GET",
						url : "chaptopr.php",
						success : function(data) {
							cpanel.html(data);
						}
					});
			$("#bversion").change(loadChapter);
		});
function sortedChapter() {
	sorted = !sorted;
	if (!sorted) {
		sortbtn.html("排序");
		cpanel.html("<img src='images/ajax-loader.gif'/>");
		$.ajax({
					type : "GET",
					url : "chaptopr.php",
					success : function(data) {
						cpanel.html(data);
					}
				});

	} else {
		sortbtn.html("退出排序");
		cpanel.empty();
	}
}
function loadChapter() {
	var sem = $("#semester");
	var ver = $("#bversion");
	var subj = $("#grade_subjects");
	var sem_text = sem.find("option:selected").text();
	var ver_text = ver.find("option:selected").text();
	var sub_text = subj.find("option:selected").text();
	if (subj.val() == -1) {
		message("请先选择年级!");
		return;
	}
	if (ver.val() == -1) {
		message("请先选择教材版本!");
		return;

	}
	$(stat)
			.attr(
					"data",
					catetree.get_text(catenode) + "-" + sub_text + "["
							+ ver_text + "]");
	$("#chapters").tree({
		data : {
			type : "json",
			async : true,
			opts : {
				method : "POST",
				url : "chapter-tree-editor.php"
			}
		},
		callback : {
			onload : function(tree) {
				tree.settings.data.opts.static = false;
			},
			onselect : function(node, tree) {
				cpttree = tree;
				cptnode = node;
				chapter = node.id;
				$("#cparentId").html(tree.get_text(node));
				$("#cndata").val(tree.get_text(node));

			},
			onopen : function(node, tree) {
				if (sorted) {
					cpanel.empty();
					var children = tree.children(node);
					var ulc = "<ul id='csortable' style='list-style:none'>";
					if (children) {
						var lit = '';
						$.each(children, function(key, node) {
							lit += "<li class='ui-state-default'id='sortnum_"
									+ node.id + "' >";
							lit += "<span class='ui-icon ui-icon-arrowthick-2-n-s'></span>";
							lit += tree.get_text(node) + "</li>";

						});
					}
					ulc += lit + "</ul><br/>";
					cpanel.html(ulc);
					$("#csortable").sortable({
								cursor : 'hand'
							});
					var opr = $("<button></button>").append("保存次序").click(
							function() {
								var st = $("#csortable").sortable("serialize");// serialize
								// message(st);
								var bthis = $(this);
								bthis.attr("disabled", true);
								bthis.html("正在保存...");

								$.ajax({
											type : "POST",
											url : "chapter-tree-editor.php",
											data : st + "&action=sorted",
											success : function(msg) {
												tree.refresh(node);
												// tree.open_all(node);
												message("次序已保存: " + msg);
												bthis.attr("disabled", false);
												bthis.html("保存");
											},
											error : function(msg) {
												message(msg);
												bthis.html("保存");
												bthis.attr("disabled", false);
											}
										});
							});
					cpanel.append(opr);
				}
			},
			beforedata : function(node, tree) {
				if (node == false) {
					// return { id : $(node).attr("id")||0};
					tree.settings.data.opts.static = stat;
					// return {cid:'root'};
				} else {
                   
					return {
						vid : ver.val(),
						sid : subj.val(),
						gid : catenode.id,
						pid : $(node).attr("id") || -1,
						eid : sem.val(),
						action : 'load'
					};
					// message(node.id);
				}

			}
		},
		ui : {
			animation : 150
		}

			// plugins :

	});// end of tree create
}// end of loadChapter function

function doOprChapterTree(event, tree, node) {
	var ver = $("#bversion");
	var sub = $("#grade_subjects");
	var sem = $("#semester");
	var btn = $(event.srcElement);
	btn.attr("disabled", true);
	btn.html("正在处理,请稍候...");
	var opt = $(":radio[name='cact'][checked=true]").val();
	if (opt) {
		var data = $("#cndata").val();
		if (!data) {
			btn.attr("disabled", false);
			btn.html("保存");
			message("名称不能为空!");
			return;
		}
		switch (opt) {
			case "add" :
				var params = {};
				params.pid = node.id;
				params.action = opt;
				params.vid = ver.val();
				params.sid = sub.val();
				params.gid = catenode.id;
				params.data = $("#cndata").val();
				params.seid = sem.val();
				$.ajax({
							type : "POST",
							url : "chapter-tree-editor.php",
							data : $.param(params),
							success : function(msg) {
								tree.refresh(node);
								tree.open_all(node);
								btn.attr("disabled", false);
								btn.html("保存");
							},
							error : function(msg) {
								message("数据保存错误:" + msg);
								btn.attr("disabled", false);
								btn.html("保存");
							}
						});// end of ajax
				break;
			case "update" :
				var params = {};
				params.pid = node.id;
				params.cid = node.id;
				params.action = opt;
				params.data = $("#cndata").val();
				$.ajax({
							type : "POST",
							url : "chapter-tree-editor.php",
							data : $.param(params),
							success : function(msg) {
								tree.refresh(tree.parent(node));
								tree.open_all(tree.parent(node));
								btn.attr("disabled", false);
								btn.html("保存");
							},
							error : function(msg) {
								message("数据保存错误:" + msg);
								btn.attr("disabled", false);
								btn.html("保存");
							}
						});// end of ajax

				break;
			case "delete" :
				;
				break;
			default :
				;
		}
	} else {
		message("请先选择操作类型!");
		btn.attr("disabled", false);
		btn.html("保存");
	}

}