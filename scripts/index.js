// JavaScript template using Windows Script Host
var cata_id = -1;
var maincontent;
var spanel;
var catetree;
var catenode;
function doAjax(action, params, jscallback) {
	$.ajax({
				type : "POST",
				url : "grade.php",
				data : "action=" + action + "&" + $.param(params),
				success : function(msg) {
					if (jscallback)
						jscallback();

				},// end of success
				error : function(msg) {
					message("出现错误: " + msg);
				}// end of error
			});// end of ajax
}

$(function() {

	maincontent = $("#primaryContent");
	var digcfg = {
		autoOpen : false,
		bgiframe : true,
		height : 180,
		modal : true,
		buttons : {
			"关闭" : function() {
				$(this).dialog('close');
			}
		}
	};
	$("#dialog").dialog(digcfg);
	var stat = [{
				attributes : {
					"id" : -1
				},
				data : "所属年级",
				state : "closed"
			}];
	$("#catelog").tree({
		data : {
			type : "json",
			async : true,
			opts : {
				method : "POST",
				url : "grade.php"
			}
		},
		callback : {
			onload : function(tree) {
				tree.settings.data.opts.static = false;
			},
			onselect : function(node, tree) {
				cata_id = node.id;
				$("#parentId").html(tree.get_text(node));
				$("#ndata").val(tree.get_text(node));
				catetree = tree;
				catenode = node;
				var grade_subjects = $("#grade_subjects");

				if (grade_subjects) {
					$.ajax({
								type : "GET",
								url : "subject-editor.php",
								data : "act=filter&gid=" + node.id,
								dataType : 'json',
								success : function(data) {
									grade_subjects.empty();
									if (data.length == 0) {
										var opt = $("<option></option>");
										opt.attr("text", "请选择学科");
										opt.attr("value", "-1");
										grade_subjects.append(opt);
										return;

									}

									for (var i in data) {
										var opt = $("<option></option>");
										opt.attr("value", data[i]['sid']);
										opt.attr("text", data[i]['sname']);
										grade_subjects.append(opt);

									}
								}

							});

				}

			},
			onopen : function(node, tree) {
				var children = tree.children(node);
				var ulc = "<ul id='sortable'>";

				/*
				 * <LI class=ui-state-default><SPAN class="ui-icon
				 * ui-icon-arrowthick-2-n-s"></SPAN>Item 1</LI>
				 * 
				 */
				if (children) {
					var lit = '';
					$.each(children, function(key, node) {
						lit += "<li class='ui-state-default' id='sortnum_"
								+ node.id + "' >";
						lit += "<span class='ui-icon ui-icon-arrowthick-2-n-s'></span>";
						lit += tree.get_text(node) + "</li>";

					});
				}
				ulc += lit + "</ul><br/>";
				$("#sorttab").html(ulc);
				$("#sortable").sortable({
							cursor : 'hand'
						});
				var opr = $("<button></button>").append("保存").click(function() {
							var st = $("#sortable").sortable("serialize");// serialize
							// message(st);
							var bthis = $(this);
							bthis.attr("disabled", true);
							bthis.html("正在保存...");

							$.ajax({
										type : "POST",
										url : "grade.php",
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
				$("#sorttab").append(opr);

			},
			beforedata : function(node, tree) {
				if (node == false) {
					// return { id : $(node).attr("id")||0};
					tree.settings.data.opts.static = stat;
					// return {cid:'root'};
				} else {
					return {
						pid : $(node).attr("id") || -1,
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

	// begin of tabs load
	$("#accordion").accordion({
				autoHeight : true,
				collapsible : true,
				fillSpace : false

			});
	// close all page left
	$("#accordion").accordion("activate", false);
	catetree = $.tree.reference("catelog");

		// end of tabs load

});// end of readly function
function doOprTree(event, tree, node) {

	var btn = $(event.srcElement);
	// message(dumpObj(event.srcElement));
	// return;
	btn.attr("disabled", true);
	btn.html("正在处理,请稍候...");

	var opt = $(":radio[name='act'][checked=true]").val();
	if (opt) {
		var data = $("#ndata").val();
		if (!data) {
			btn.attr("disabled", false);
			btn.html("保存");
			message("名称不能为空!");

			return;
		}
		switch (opt) {
			case "add" :
				$.ajax({
							type : "POST",
							url : "grade.php",
							data : "pid=" + cata_id + "&data=" + data
									+ "&action=" + opt,
							success : function(msg) {
								tree.refresh(node);
								// tree.refresh(tree.parent(node));
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
				$.ajax({
					type : "POST",
					url : "grade.php",
					data : "id=" + cata_id + "&data=" + data + "&action=" + opt,
					success : function(msg) {
						// tree.refresh(tree.parent(node));
						// tree.open_all(tree.parent(node));
						tree.refresh(node);
						// tree.open_all(node);
						// message(msg);
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
function fireaccordion(type) {

	if (type) {
		switch (type) {
			case 'catelog' :

				$.ajax({
							type : "GET",
							url : "tabs.php",
							dataType : "html",
							success : function(msg) {
								maincontent.empty();
								maincontent.html(msg);
								$("#tabs").tabs({
											selected : 1,
											select : function(event, ui) {
												if (ui.index == 0) {
													$(ui.panel).empty();

												} else {

												}
											}
										});

							},

							error : function(msg) {
								message("载入tabs出错: <br/>" + msg);
							}

						});

				;
				break;
			case 'qbank' :
				maincontent.empty();
				$.ajax({
							type : "GET",
							url : "question-tabs.php",
							dataType : "html",
							success : function(msg) {
								maincontent.empty();
								maincontent.html(msg);
								$("#qtabs").tabs({
											selected : 0
										});

							},

							error : function(msg) {
								message("载入tabs出错: <br/>" + msg);
							}

						});
				;
				break;
			case 'member' :
				maincontent.empty();
				$.ajax({
							type : "GET",
							url : "member-tabs.php",
							dataType : "html",
							success : function(msg) {
								maincontent.empty();
								maincontent.html(msg);
								$("#membertabs").tabs({
											selected : 0
										});
								// initilize spanel at now here
								spanel = $("#membertabs1");

							},

							error : function(msg) {
								message("载入tabs出错: <br/>" + msg);
							}

						});

				;
				break;
			case 'friends' :
				maincontent.empty();
				;
				break;
			case 'sys' :
				maincontent.empty();
				$.ajax({
							type : "GET",
							url : "sysadmin.php",
							dataType : "html",
							success : function(msg) {
								maincontent.empty();
								maincontent.html(msg);
							},

							error : function(msg) {
								alert("载入tabs出错: <br/>" + msg);
							}

						});

				break;

			default :
				;

		}

	}

}// end of fireaccordion
function test() {

}// end of test

// ////////////////////////////////////////////////////////////////////////////////////
// ///////select -editor.php
// //////////////////////////////////
function addAnswer() {
	var cont = $("#answers");
	var lic = $("<li style='list-style:none;'><input type=text name=sanswer[] /><label onclick=removeAnswer() style=color:red>X</label></li>");
	cont.append(lic);

}
function removeAnswer() {
	evt = getEvent();
	var element = evt.srcElement || evt.target;
	message(element);
	$(element).parent().remove();

}
function ensureQ() {
	alert($("form[id='questionform']").serialize());
}