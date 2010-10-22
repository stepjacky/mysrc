var myChapter = -1;
var mySubject = -1;
var myGrade   = -1;
var myVer     = -1;
var myType    = -1;
var mytree    = -1;
var mynode    = -1;
var selectedGrade = 0;
var semester = -1;
var libs      = {};
libs.myType    = "请选择题目类型";
libs.myGrade   = "请选择年级";
libs.mySubject = "请选择学科";
libs.myVer     = "请选择教材版本";
libs.myChapter ="请选择章节";
$(function() {
	var cht_container = $("#qst_chapter");
    semester = $("#semester");
	var subject = $("#qst_subject_id");
	var bversion = $("#qst_bvser_id");
	var grade = $("#qst_grade_id");
	var qtype = $("#qst_type_id");
	qtype.change(function() {
				//
                myType =  fetchSelectvars();
			});
	grade.change(function() {
				// fill subject list;
				myGrade =fetchSelectvars();
				$.ajax({
							type : "GET",
							url : "subject-editor.php",
							data : "act=filter&gid=" + myGrade.value,
							dataType : "json",
							success : function(data) {
								subject.empty();
								subject
										.append("<option value='-1'>请选择学科..</option>");
								for (var i in data) {
									var opt = $("<option></option>");
									opt.attr("value", data[i]["sid"]);
									opt.attr("text", data[i]["sname"]);
									if(data[i]['sid']==selectedGrade)
									opt.attr("selected",true);
									subject.append(opt);
								}

							},
							error : function(data) {
								message(data);
							}
						});
			  if(bversion)bversion.attr("value",-1);
			  if(cht_container)cht_container.empty();
			});

	subject.change(function() {
		mySubject = fetchSelectvars();
			// loadChapterTree();
		});

	bversion.change(function() {
		myVer = fetchSelectvars();
		loadChapterTree();
	});// end of book version change
    semester.change(function(){
        if(cht_container)cht_container.empty();
    	if(bversion)bversion.attr("value",-1);
    });
});
function checkItem(items) {
	var ft = true;
	for(v in items){
	   var code  = v + '==-1';
	   var codet = v + '.value==-1';
	   var m = items[v];
	   //alert(typeof(v));
	   //alert(v);
	   if(eval(code) || eval(codet)){
	 	  ft = m;
		  break;
	   }
				
	}
  
	if(typeof(ft)=='boolean')return true;
	else return ft;
}
function checkVarArray(items){
	var falt = checkItem(items);	
	if (typeof(falt) == 'string') {		
		message(falt);
		return false;
	}
	return true;
}

function checkVars() {
	var falt = checkItem(libs);	
	if (typeof(falt) == 'string') {		
		message(falt);
		return false;
	}
	return true;
}

function checkVarsExpect(epcts){
	var tlib = {};
    var tgt = $.extend(tlib,libs);
    for(var k in tlib){
    	if($.inArray(k,epcts)!=-1){
    		//如果排除的k 在epcts数组里,则删除
    		delete tlib[k];
    		
    	}
    }
    var falt = checkItem(tlib);	
	if (typeof(falt) == 'string') {		
		message(falt);
		return false;
	}
	return true;
}
/**
 *加载所在的章节
 *@return  
 * 
 * 
 */
function loadChapterTree() {
	//alert(myGrade);
	var epts = ['myChapter','myType'];	
	var ft = checkVarsExpect(epts);
	if (!ft)return;
	var opt = fetchSelectvars();
	var stat = [{
				attributes : {
					"id" : -1					
				},
				data : "章节",
				state : "closed"
			}];
    var se = '';
    if(semester instanceof jQuery){
        se = semester.val();
    }
    else{
    	se = $(semester).val();
    }
    
	$(stat).attr(
			"data",
			myGrade.text + " "+"["+myVer.text + "]");
	
	$("#qst_chapter").tree({
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
				myChapter = node.id;
				//if(functionValid('pickQuestion'))
				 // eval('pickQuestion')();
				mytree= tree;
				mynode= node;
				selectCallback();

			},
			onopen : function(node, tree) {
			   chapterOpenCallback(node,tree);
				
			},
			beforedata : function(node, tree) {
				if (node == false) {
					// return { id : $(node).attr("id")||0};
					tree.settings.data.opts.static = stat;
					// return {cid:'root'};
				} else {
					return {
						vid : myVer.value,
						sid : mySubject.value,
						gid : myGrade.value,
						pid : $(node).attr("id") || -1,
						eid : se,
						action : 'load'
					};
				}
			}
		},
		ui : {
			animation : 150
		}
			// plugins :
		});

}
function addQuestion(formid) {
	var ft = checkVars();
	if (!ft)return;
	var evt = getEvent();
	var element = evt.srcElement || evt.target;
	$(element).attr("disabled", true);
	$(element).html("正在保存题目...");
	var  semester = $("#semester").val();
	var remark = $("#remark").val();
	var diffcut = $("#diffculity").val();
	var form = $("form[id='" + formid + "']");
	var rights = "";
	var optparams = "";
   
	var owner = $("#qst_owner_id");
	$("form[id='" + formid + "'] input[type='checkbox']").each(function(i) {
			    var name =$(this).attr("name");
		        if ($(this).attr("checked") == true) {
					rights += "&right[]=" + name;
				}
				optparams += "&" +name+ "=" + ($("#answer_"+name+"_text").val());
			});
	var data = (rights + optparams + "&qst_grade_id=" + myGrade.value
			+ "&qst_subject_id=" + mySubject.value + "&qst_bvser_id="
			+ myVer.value + "&qst_chapter_id=" + myChapter + "&qst_type_id="
			+ myType.value + "&description=" + getEditorHTMLContents('qtext')
			+ "&action=create&remark=" + remark+"&owner="+owner.val()
			+ "&semester="+semester+"&diffculity="+diffcut
			);
	// encodeURI
	$.ajax({
				type : "POST",
				url : "question-data.php",
				data : data,
				success : function(msg) {
					message("保存完毕<br/>" + msg);
					$(element).attr("disabled", false);
					$(element).html("添加题目");
				},
				error : function(msg) {
					message(msg);
					$(element).attr("disabled", false);
					$(element).html("添加题目");
				}

			});

}
function editQuestion(formid) {
	
	var id = $('#qid').val();
	var desc = getEditorHTMLContents('qtext');
	var remark = $("#remark").val();
	var evt = getEvent();
	var element = evt.srcElement || evt.target;
	var btn = $(element);
	var rights = "";
	var optparams = "";
 var wrongs = "";
	$("form[id='" + formid + "'] input[type='checkbox']").each(function(i) {
			    var name =$(this).attr("name");
		        if ($(this).attr("checked") == true) {
					rights += "&right[]=" + name;
				}else{
					wrongs+="&wrong[]="+name;
				}
				optparams += "&" +name+ "=" + ($("#answer_"+name+"_text").val());
			});
	
    var pobj = {action:'update',
                id:id,
                'description':desc,
                remark:remark                
                };
	btn.attr("disabled", true);
	btn.val("正在更新..");
	$.ajax({
				type : "POST",
				url : "question-data.php",
				data:$.param(pobj)+optparams+rights+wrongs,
				success : function(msg) {
					btn.attr("disabled", false);
					btn.val("保存更改");
					$("#qtabs").tabs("select", 0);
					$('#qtabs').tabs('url', 1, 'question-edit.php');
				    if(mtabs!=null && mtabs){
				       mtabs.tabs( "remove" , mtabs.tabs( "length" )-1);
				       //mtabs.tabs( "select" , 2);
				    }
				},
				error : function(msg) {
					btn.attr("disabled", false);
					message(msg);
				}

			}

	);

}
function selectCallback(){
//Override to do someThing ... 
}
function  chapterOpenCallback(node,tree){
//Override to do someThing ... 
}
function copyValue(src, destid) {
	$("#" + destid).val($(src).val());
}