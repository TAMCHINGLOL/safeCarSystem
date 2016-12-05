//客户人员操作表格
//投保查询表开始
var dataSet = [
    [ "浙-1254-01",  "Tiger Nixon", "18819446135","201600001", "2002/12/09", "2011/04/25", ""],
    [ "浙-1254-01", "Garrett Winters","18819446135","201600001", "2002/12/09","2011/07/25", ""],
    [ "浙-1254-01", "Ashton Cox","18819446135","201600001", "2002/12/09","2009/01/12", ""],
    [ "浙-1254-01", "Cedric Kelly","18819446135","201600001", "2002/12/09", "2012/03/29",""],
    [ "浙-1254-01", "Airi Satou","18819446135","201600001", "2002/12/09", "2012/03/29", ""],
    [ "浙-1254-01", "Brielle Williamson","18819446135","201600001", "2002/12/09","2012/12/02", ""],
    [ "浙-1254-01", "Herrod Chandler", "18819446135","201600001", "2002/12/09","2012/03/29",""],
    [ "浙-1254-01", "Rhona Davidson", "18819446135","201600001", "2002/12/09", "2010/10/14","" ],
    [ "浙-1254-01", "Colleen Hurst","18819446135","201600001", "2002/12/09", "2009/09/15", ""],
    [ "浙-1254-01", "Sonya Frost", "18819446135","201600001", "2002/12/09","2008/12/13","" ],
    [ "浙-1254-01", "Jena Gaines","18819446135","201600001", "2002/12/09","2008/12/19",""],
    [ "浙-1254-01", "Quinn Flynn", "18819446135","201600001", "2002/12/09", "2013/03/03",""],
    [ "浙-1254-01", "Charde Marshall", "18819446135","201600001", "2002/12/09", "2008/10/16","" ],
    [ "浙-1254-01", "Haley Kennedy","18819446135","201600001", "2002/12/09", "2012/12/18",""],
    [ "浙-1254-01", "Tatyana Fitzpatrick","18819446135","201600001", "2002/12/09","2010/03/17",""],
    [ "浙-1254-01", "Michael Silva","18819446135","201600001", "2002/12/09","2012/11/27",""],
    [ "浙-1254-01", "Paul Byrd","18819446135","201600001", "2002/12/09", "2010/06/09",""],
    [ "浙-1254-01", "Gloria Little","18819446135","201600001", "2002/12/09","2009/04/10",""],
    [ "浙-1254-01", "Bradley Greer","18819446135","201600001", "2002/12/09","2012/10/13",""],
    [ "浙-1254-01", "Dai Rios", "18819446135","201600001", "2002/12/09","2012/09/26",""],
    [ "浙-1254-01", "Jenette Caldwell", "18819446135","201600001", "2002/12/09", "2011/09/03",""],
    [ "浙-1254-01", "Yuri Berry", "18819446135","201600001", "2002/12/09", "2009/06/25","" ],
    [ "浙-1254-01", "Caesar Vance","18819446135","201600001", "2002/12/09", "2011/12/12",""],
    [ "浙-1254-01", "Doris Wilder","18819446135","201600001", "2002/12/09","2010/09/20",""],
    [ "浙-1254-01", "Angelica Ramos","18819446135","201600001", "2002/12/09", "2009/10/09", ""],
    [ "浙-1254-01", "Gavin Joyce", "18819446135","201600001", "2002/12/09","2012/03/29","" ],
    [ "浙-1254-01", "Jennifer Chang","18819446135","201600001", "2002/12/09", "2010/11/14", ""],
    [ "浙-1254-01", "Brenden Wagner", "18819446135","201600001", "2002/12/09","2011/06/07", ""],
    [ "浙-1254-01", "Fiona Green","18819446135","201600001", "2002/12/09","2010/03/11",""],
    [ "浙-1254-01", "Shou Itou","18819446135","201600001", "2002/12/09", "2011/08/14",""],
    [ "浙-1254-01", "Michelle House", "18819446135","201600001", "2002/12/09", "2011/06/02",""],
    [ "浙-1254-01", "Suki Burks", "18819446135","201600001", "2002/12/09", "2012/03/29",""],
    [ "浙-1254-01", "Prescott Bartlett","18819446135","201600001", "2002/12/09", "2011/05/07", ""],
    [ "浙-1254-01", "Gavin Cortez", "18819446135","201600001", "2002/12/09", "2008/10/26","" ],
    [ "浙-1254-01", "Martena Mccray", "18819446135","201600001", "2002/12/09", "2011/03/09",""],
    [ "浙-1254-01", "Unity Butler","18819446135","201600001", "2002/12/09","2009/12/09",""]
];

$(document).ready(function() {
    $('#example').DataTable( {
        data: dataSet,
        columns: [
            { title: "车牌号" },
            { title: "车主姓名"},
            { title: "手机号" },
            { title: "保险单号" },
            { title: "投保起始日期" },
            { title: "投保截止日期" },
            { title: "操作" }
        ],
        "pagingType":   "full_numbers",
        "language": {
            "lengthMenu": "每页 _MENU_ 条记录",
            "zeroRecords": "没有找到记录",
            "info": "第 _PAGE_ 页 ( 总共 _PAGES_ 页 )",
            "infoEmpty": "无记录",
            "infoFiltered": "(从 _MAX_ 条记录过滤)",
            "sSearch":"搜索",
		    "paginate": {  
		        "first":      "«",  
		        "last":       "»",  
		        "next":       ">",  
		        "previous":   "<"  
		    }    
        },
        "columnDefs": [
            {
                "render": function ( data, type, row ) {
                    return '<a class="cursor" href="registerInfo.html">生成出险登记表</a>';
                },
                "targets":6
            }
/*           {
                "render": function ( data, type, row ) {
                    return '<a class="cursor del-row">删除</a>';
                },
                "targets":6
            }*/
        ],
        "filter":true,
        "info":true,
        /*手机端手机滚动条
        "scrollY": "200px",
	    "scrollCollapse": true,*/
	    /*分页设置*/
	    "paging":true,
        //"iDisplayLength" : 4,//默认显示数据数量
        "lengthChange": false,//关闭显示数据数量选项
        "order": [[ 3, "desc" ]],//默认第三列排序
        "ordering":false//关闭排序按钮控件
    } );
	
} );

/*function detile(d){
	var table = $('#example').DataTable();
	var data = table.row( $(d).parents('tr') ).data();
	alert( data[0] +"的保单号是: "+ data[ 3 ] );
	var url="registerInfo.html";
	location.href="registerInfo.html";
}*/

/*
$(document).ready(function(){    

    $('#example tbody').on('click', '.detile', function () {
        var data = table.row( $(this).parents('tr') ).data();
        alert( data[0] +"的保单号是: "+ data[ 3 ] );
	} );
    $('#example tbody').on('click', '.del-row', function () {
    	table.row('.selected').remove().draw( false );
	} );
	
    $('#example thead').on( 'click', '.selectall', function () {
    	var data = table.row( this.closest("tr") ).data();
    	$("table tr input[type=checkbox]").attr("checked",true);
        $(this).toggleClass('selected');
    } );
    
    
    $('#example tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );

    $('#button').click( function () {
         table.row('.selected').remove().draw( false );
    } );
});*/
//投保查询表结束
//调派人员查询表开始
var personnelSet = [
    [ "p0001",  "Tiger Nixon", "18819446135","华软学院", "空闲",""],
    [ "p0002", "Garrett Winters","18819446135","华软学院", "空闲", ""],
    [ "p0003", "Ashton Cox","18819446135","华软学院", "空闲",""],
    [ "p0003", "Cedric Kelly","18819446135","华软学院", "空闲",""],
    [ "p0003", "Airi Satou","18819446135","华软学院", "空闲",""],
    [ "p0003", "Brielle Williamson","18819446135","华软学院", "空闲",""],
    [ "p0003", "Herrod Chandler", "18819446135","华软学院", "空闲",""],
    [ "p0003", "Rhona Davidson", "18819446135","华软学院", "空闲", "" ],
    [ "p0003", "Colleen Hurst","18819446135","华软学院", "空闲", ""],
    [ "p0003", "Sonya Frost", "18819446135","华软学院", "空闲","" ],
    [ "p0003", "Jena Gaines","18819446135","华软学院", "空闲",""],
    [ "p0003", "Quinn Flynn", "18819446135","华软学院", "空闲",""],
    [ "p0003", "Charde Marshall", "18819446135","华软学院", "空闲","" ],
    [ "p0003", "Haley Kennedy","18819446135","华软学院", "空闲",""],
    [ "p0003", "Tatyana Fitzpatrick","18819446135","华软学院", "空闲",""],
    [ "p0003", "Michael Silva","18819446135","华软学院", "空闲",""],
    [ "p0003", "Paul Byrd","18819446135","华软学院", "空闲", ""],
    [ "p0003", "Gloria Little","18819446135","华软学院", "空闲",""],
    [ "p0003", "Bradley Greer","18819446135","华软学院", "空闲",""],
    [ "p0003", "Dai Rios", "18819446135","华软学院", "空闲",""],
    [ "p0003", "Jenette Caldwell", "18819446135","华软学院", "空闲",""],
    [ "p0003", "Yuri Berry", "18819446135","华软学院", "空闲", "" ],
    [ "p0003", "Caesar Vance","18819446135","华软学院", "空闲", ""],
    [ "p0003", "Doris Wilder","18819446135","华软学院", "空闲",""],
    [ "p0003", "Angelica Ramos","18819446135","华软学院", "空闲",""],
    [ "p0003", "Gavin Joyce", "18819446135","华软学院", "空闲","" ],
    [ "p0003", "Jennifer Chang","18819446135","华软学院", "空闲", ""],
    [ "p0003", "Brenden Wagner", "18819446135","华软学院", "空闲", ""],
    [ "p0003", "Fiona Green","18819446135","华软学院", "空闲",""],
    [ "p0003", "Shou Itou","18819446135","华软学院", "空闲",""],
    [ "p0003", "Michelle House", "18819446135","华软学院", "空闲",""],
    [ "p0003", "Suki Burks", "18819446135","华软学院", "空闲", ""],
    [ "p0003", "Prescott Bartlett","18819446135","华软学院", "空闲",""],
    [ "p0003", "Gavin Cortez", "18819446135","华软学院", "空闲","" ],
    [ "p0003", "Martena Mccray", "18819446135","华软学院", "空闲",""],
    [ "p0003", "Unity Butler","18819446135","华软学院", "空闲",""]
];

$(document).ready(function() {
    $('#schedulingPersonnel').DataTable( {
        data: personnelSet,
        columns: [
            { title: "工号" },
            { title: "调度人员姓名"},
            { title: "手机号" },
            { title: "地址" },
            { title: "状态" },
            { title: "操作" }
        ],
        "pagingType":   "full_numbers",
        "language": {
            "lengthMenu": "每页 _MENU_ 条记录",
            "zeroRecords": "没有找到记录",
            "info": "第 _PAGE_ 页 ( 总共 _PAGES_ 页 )",
            "infoEmpty": "无记录",
            "infoFiltered": "(从 _MAX_ 条记录过滤)",
            "sSearch":"搜索",
		    "paginate": {  
		        "first":      "«",  
		        "last":       "»",  
		        "next":       ">",  
		        "previous":   "<"  
		    }    
        },
        "columnDefs": [
            {
                "render": function ( data, type, row ) {
                    return '<a class="cursor" onclick="Schedule(this)">立即调派</a>';
                },
                "targets":5
            }
/*           {
                "render": function ( data, type, row ) {
                    return '<a class="cursor del-row">删除</a>';
                },
                "targets":6
            }*/
        ],
        "filter":true,
        "info":true,
        /*手机端手机滚动条
        "scrollY": "200px",
	    "scrollCollapse": true,*/
	    /*分页设置*/
	    "paging":true,
        //"iDisplayLength" : 4,//默认显示数据数量
        "lengthChange": false,//关闭显示数据数量选项
        "order": [[ 3, "desc" ]],//默认第三列排序
        "ordering":false//关闭排序按钮控件
    } );
	
} );

//调派人员查询表结束

//出险登记列表register_list
var register_listSet = [
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","","勘察中"],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","","勘察完成"],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","","勘察完成",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","","勘察中"],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","","勘察完成"],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","","勘察完成",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","","勘察中"],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","","勘察完成"],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","","勘察完成",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","","勘察中"],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","","勘察完成"],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","","勘察完成",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","","勘察中"],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","","勘察完成"],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","","勘察完成",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","","勘察中"],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","","勘察完成"],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","","勘察完成",""],
];
$(document).ready(function() {
    $('#register_list').DataTable( {
        data: register_listSet,
        columns: [
            { title: "保险单号" },
            { title: "出险登记编号"},
            { title: "出险时间" },
            { title: "出险地址" },
            { title: "操作" },
            { title: "状态" }
        ],
        "pagingType":   "full_numbers",
        "language": {
            "lengthMenu": "每页 _MENU_ 条记录",
            "zeroRecords": "没有找到记录",
            "info": "第 _PAGE_ 页 ( 总共 _PAGES_ 页 )",
            "infoEmpty": "无记录",
            "infoFiltered": "(从 _MAX_ 条记录过滤)",
            "sSearch":"搜索",
		    "paginate": {  
		        "first":      "«",  
		        "last":       "»",  
		        "next":       ">",  
		        "previous":   "<"  
		    }    
        },
        "columnDefs": [
            {
                "render": function ( data, type, row ) {
                    return '<a class="cursor" href="lookRegisterInfo.html">查看详情</a>';
                },
                "targets":4
            }
/*           {
                "render": function ( data, type, row ) {
                    return '<a class="cursor del-row">删除</a>';
                },
                "targets":6
            }*/
        ],
        "filter":true,
        "info":true,
        /*手机端手机滚动条
        "scrollY": "200px",
	    "scrollCollapse": true,*/
	    /*分页设置*/
	    "paging":true,
        //"iDisplayLength" : 4,//默认显示数据数量
        "lengthChange": false,//关闭显示数据数量选项
        "order": [[ 3, "desc" ]],//默认第三列排序
        "ordering":false//关闭排序按钮控件
    } );
	
} );

//调度人员操作表格
//查看出险登记表
var scheduling_Look_register = [
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃","",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃", "", ""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃", "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "", ""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "", ""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "", ""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "", ""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "", ""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "", ""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
    [ "r0001","浙-1254-01","2016-12-01 12:30","东圃",  "",""],
];
$(document).ready(function() {
	    $('#SWrite_register').DataTable( {//调度人员的首页表格
        data: scheduling_Look_register,
        columns: [
            { title: "保险单号" },
            { title: "出险登记编号"},
            { title: "出险时间" },
            { title: "出险地址" },
            { title: "查看" },
            { title: "操作" }
        ],
        "pagingType":   "full_numbers",
        "language": {
            "lengthMenu": "每页 _MENU_ 条记录",
            "zeroRecords": "没有找到记录",
            "info": "第 _PAGE_ 页 ( 总共 _PAGES_ 页 )",
            "infoEmpty": "无记录",
            "infoFiltered": "(从 _MAX_ 条记录过滤)",
            "sSearch":"搜索",
		    "paginate": {  
		        "first":      "«",  
		        "last":       "»",  
		        "next":       ">",  
		        "previous":   "<"  
		    }    
        },
        "columnDefs": [
            {
                "render": function ( data, type, row ) {
                    return '<a class="cursor" onclick="SchedulingDetileRigster(this)">查看详情</a>';
                },
                "targets":4
            },
            {
                "render": function ( data, type, row ) {
                    return '<a class="cursor" href="surveyReporter.html">填写勘察报告</a>';
                },
                "targets":5
            }
/*           {
                "render": function ( data, type, row ) {
                    return '<a class="cursor del-row">删除</a>';
                },
                "targets":6
            }*/
        ],
        "filter":true,
        "info":true,
        /*手机端手机滚动条
        "scrollY": "200px",
	    "scrollCollapse": true,*/
	    /*分页设置*/
	    "paging":true,
        //"iDisplayLength" : 4,//默认显示数据数量
        "lengthChange": false,//关闭显示数据数量选项
        "order": [[ 3, "desc" ]],//默认第三列排序
        "ordering":false//关闭排序按钮控件
    } );
    $('#Slook_survey').DataTable( {//调度人员的修改勘察表格
        data: scheduling_Look_register,
        columns: [
            { title: "保险单号" },
            { title: "出险登记编号"},
            { title: "出险时间" },
            { title: "查看" },
            { title: "操作" },
            { title: "状态"}
        ],
        "pagingType":   "full_numbers",
        "language": {
            "lengthMenu": "每页 _MENU_ 条记录",
            "zeroRecords": "没有找到记录",
            "info": "第 _PAGE_ 页 ( 总共 _PAGES_ 页 )",
            "infoEmpty": "无记录",
            "infoFiltered": "(从 _MAX_ 条记录过滤)",
            "sSearch":"搜索",
		    "paginate": {  
		        "first":      "«",  
		        "last":       "»",  
		        "next":       ">",  
		        "previous":   "<"  
		    }    
        },
        "columnDefs": [
            {
                "render": function ( data, type, row ) {
                    return '<a class="cursor" onclick="SchedulingDetileRigster(this)">查看详情</a>';
                },
                "targets":3
            },
            {//onclick="SchedulingWrite(this) 
                "render": function ( data, type, row ) {
                    return '<a class="cursor" href="lookSurveyReporter.html">查看勘察报告</a>';
                },
                "targets":4
            },
            {//onclick="SchedulingWrite(this) 
                "render": function ( data, type, row ) {
                    return '已结案';
                },
                "targets":5
            }
/*           {
                "render": function ( data, type, row ) {
                    return '<a class="cursor del-row">删除</a>';
                },
                "targets":6
            }*/
        ],
        "filter":true,
        "info":true,
        /*手机端手机滚动条
        "scrollY": "200px",
	    "scrollCollapse": true,*/
	    /*分页设置*/
	    "paging":true,
        //"iDisplayLength" : 4,//默认显示数据数量
        "lengthChange": false,//关闭显示数据数量选项
        "order": [[ 3, "desc" ]],//默认第三列排序
        "ordering":false//关闭排序按钮控件
    } );
        $('#revised_survey').DataTable( {//调度人员的修改勘察表格
        data: scheduling_Look_register,
        columns: [
            { title: "保险单号" },
            { title: "出险登记编号"},
            { title: "出险时间" },
            { title: "查看" },
            { title: "操作" },
            { title: "备注"}
        ],
        "pagingType":   "full_numbers",
        "language": {
            "lengthMenu": "每页 _MENU_ 条记录",
            "zeroRecords": "没有找到记录",
            "info": "第 _PAGE_ 页 ( 总共 _PAGES_ 页 )",
            "infoEmpty": "无记录",
            "infoFiltered": "(从 _MAX_ 条记录过滤)",
            "sSearch":"搜索",
		    "paginate": {  
		        "first":      "«",  
		        "last":       "»",  
		        "next":       ">",  
		        "previous":   "<"  
		    }    
        },
        "columnDefs": [
            {
                "render": function ( data, type, row ) {
                    return '<a class="cursor" onclick="SchedulingDetileRigster(this)">查看详情</a>';
                },
                "targets":3
            },
            {//onclick="SchedulingWrite(this) 
                "render": function ( data, type, row ) {
                    return '<a class="cursor" href="surveyReporter.html">修改勘察报告</a>';
                },
                "targets":4
            }
/*           {
                "render": function ( data, type, row ) {
                    return '<a class="cursor del-row">删除</a>';
                },
                "targets":6
            }*/
        ],
        "filter":true,
        "info":true,
        /*手机端手机滚动条
        "scrollY": "200px",
	    "scrollCollapse": true,*/
	    /*分页设置*/
	    "paging":true,
        //"iDisplayLength" : 4,//默认显示数据数量
        "lengthChange": false,//关闭显示数据数量选项
        "order": [[ 3, "desc" ]],//默认第三列排序
        "ordering":false//关闭排序按钮控件
    } );

} );


//财务人员操作表格
//查看勘察并生成理赔单
var Flook_surveySet=[
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""],
    [ "S0001","18819446135","2016-12-01 12:30","",""]
]
$(document).ready(function() {
    $('#Flook_survey').DataTable( {
        data: Flook_surveySet,
        columns: [
            { title: "来自工号" },
            { title: "手机"},
            { title: "提交时间" },
            { title: "查看" },
            { title: "操作" }
        ],
        "pagingType":   "full_numbers",
        "language": {
            "lengthMenu": "每页 _MENU_ 条记录",
            "zeroRecords": "没有找到记录",
            "info": "第 _PAGE_ 页 ( 总共 _PAGES_ 页 )",
            "infoEmpty": "无记录",
            "infoFiltered": "(从 _MAX_ 条记录过滤)",
            "sSearch":"搜索",
		    "paginate": {  
		        "first":      "«",  
		        "last":       "»",  
		        "next":       ">",  
		        "previous":   "<"  
		    }    
        },
        "columnDefs": [
            {
                "render": function ( data, type, row ) {
                    return '<a class="cursor" href="lookSurveyReporter.html">查看勘察报告</a>';
                },
                "targets":3
            },
            {
                "render": function ( data, type, row ) {
                    return '<a class="cursor" href="wirteClaims.html">填写理赔单</a>';
                },
                "targets":4
            }
/*           {
                "render": function ( data, type, row ) {
                    return '<a class="cursor del-row">删除</a>';
                },
                "targets":6
            }*/
        ],
        "filter":true,
        "info":true,
        /*手机端手机滚动条
        "scrollY": "200px",
	    "scrollCollapse": true,*/
	    /*分页设置*/
	    "paging":true,
        //"iDisplayLength" : 4,//默认显示数据数量
        "lengthChange": false,//关闭显示数据数量选项
        "order": [[ 3, "desc" ]],//默认第三列排序
        "ordering":false//关闭排序按钮控件
    } );
	
} );


//财务人员操作表格
//查看审核理赔单
var Flook_claimsSet=[
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","审核不通过"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","审核不通过"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"],
    [ "S0001","18819446135","2016-12-01 12:30","","未审核"]
]
$(document).ready(function() {
    $('#Flook_claim').DataTable( {
        data: Flook_claimsSet,
        columns: [
            { title: "理赔单号" },
            { title: "保险单号" },
            { title: "查看" },
            { title: "操作" },
            { title: "状态" }
        ],
        "pagingType":   "full_numbers",
        "language": {
            "lengthMenu": "每页 _MENU_ 条记录",
            "zeroRecords": "没有找到记录",
            "info": "第 _PAGE_ 页 ( 总共 _PAGES_ 页 )",
            "infoEmpty": "无记录",
            "infoFiltered": "(从 _MAX_ 条记录过滤)",
            "sSearch":"搜索",
		    "paginate": {  
		        "first":      "«",  
		        "last":       "»",  
		        "next":       ">",  
		        "previous":   "<"  
		    }    
        },
        "columnDefs": [
            {
                "render": function ( data, type, row ) {
                    return '<a class="cursor" href="lookSurveyReporter.html">查看勘察报告</a>';
                },
                "targets":2
            },
            {
                "render": function ( data, type, row ) {
                    return '<a class="cursor" href="looknoVerifyClaims.html">查看理赔单</a>';
                },
                "targets":3
            }
/*           {
                "render": function ( data, type, row ) {
                    return '<a class="cursor del-row">删除</a>';
                },
                "targets":6
            }*/
        ],
        "filter":true,
        "info":true,
        /*手机端手机滚动条
        "scrollY": "200px",
	    "scrollCollapse": true,*/
	    /*分页设置*/
	    "paging":true,
        //"iDisplayLength" : 4,//默认显示数据数量
        "lengthChange": false,//关闭显示数据数量选项
        "order": [[ 3, "desc" ]],//默认第三列排序
        "ordering":false//关闭排序按钮控件
    } );
	
} );

//财务人员操作表格
//支付理赔单
$(document).ready(function() {
    $('#Flook_pey').DataTable( {
        data: Flook_claimsSet,
        columns: [
            { title: "理赔单号" },
            { title: "保险单号" },
            { title: "手机"},
            { title: "查看" },
            { title: "操作" },
            { title: "支付" }
        ],
        "pagingType":   "full_numbers",
        "language": {
            "lengthMenu": "每页 _MENU_ 条记录",
            "zeroRecords": "没有找到记录",
            "info": "第 _PAGE_ 页 ( 总共 _PAGES_ 页 )",
            "infoEmpty": "无记录",
            "infoFiltered": "(从 _MAX_ 条记录过滤)",
            "sSearch":"搜索",
		    "paginate": {  
		        "first":      "«",  
		        "last":       "»",  
		        "next":       ">",  
		        "previous":   "<"  
		    }    
        },
        "columnDefs": [
            {
                "render": function ( data, type, row ) {
                    return '<a class="cursor" href="lookSurveyReporter.html">查看勘察报告</a>';
                },
                "targets":3
            },
            {
                "render": function ( data, type, row ) {
                    return '<a class="cursor"  href="lookVerifyClaims.html">查看理赔单</a>';
                },
                "targets":4
            },
            {
                "render": function ( data, type, row ) {
                    return '未支付';
                },
                "targets":5
            }
/*           {
                "render": function ( data, type, row ) {
                    return '<a class="cursor del-row">删除</a>';
                },
                "targets":6
            }*/
        ],
        "filter":true,
        "info":true,
        /*手机端手机滚动条
        "scrollY": "200px",
	    "scrollCollapse": true,*/
	    /*分页设置*/
	    "paging":true,
        //"iDisplayLength" : 4,//默认显示数据数量
        "lengthChange": false,//关闭显示数据数量选项
        "order": [[ 3, "desc" ]],//默认第三列排序
        "ordering":false//关闭排序按钮控件
    } );
	
} );

//经理操作表格
//保单管理
var policyManageSet=[
	[ "p2016125001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","200112332","2016-12-05 03:00",""]
]
$(document).ready(function() {
    $('#policyManage').DataTable( {
        data: policyManageSet,
        columns: [
            { title: "保险单号" },
            { title: "会员号" },
            { title: "保单发票号" },
            { title: "登记日期" },
            { title: "详情" }
        ],
        "pagingType":   "full_numbers",
        "language": {
            "lengthMenu": "每页 _MENU_ 条记录",
            "zeroRecords": "没有找到记录",
            "info": "第 _PAGE_ 页 ( 总共 _PAGES_ 页 )",
            "infoEmpty": "无记录",
            "infoFiltered": "(从 _MAX_ 条记录过滤)",
            "sSearch":"搜索",
		    "paginate": {  
		        "first":      "«",  
		        "last":       "»",  
		        "next":       ">",  
		        "previous":   "<"  
		    }    
        },
        "columnDefs": [
            {
                "render": function ( data, type, row ) {
                    return '<a class="cursor" href="addPolicy.html">查看详情</a>';
                },
                "targets":4
            }
        ],
        "filter":true,
        "info":true,
        /*手机端手机滚动条
        "scrollY": "200px",
	    "scrollCollapse": true,*/
	    /*分页设置*/
	    "paging":true,
        //"iDisplayLength" : 4,//默认显示数据数量
        "lengthChange": false,//关闭显示数据数量选项
        "order": [[ 3, "desc" ]],//默认第三列排序
        "ordering":false//关闭排序按钮控件
    } );
	
} );

//车辆信息表
var carInfoSet=[
	[ "p2016125001","v001","v001","v001","200112332","2016-12-05 03:00","","v001",],
	[ "p2016125001","v001","v001","v001","200112332","2016-12-05 03:00","","v001",],
	[ "p2016125001","v001","v001","v001","200112332","2016-12-05 03:00","","v001",],
	[ "p2016125001","v001","v001","v001","200112332","2016-12-05 03:00","","v001",],
	[ "p2016125001","v001","v001","v001","200112332","2016-12-05 03:00","","v001",],
	[ "p2016125001","v001","v001","v001","200112332","2016-12-05 03:00","","v001",],
	[ "p2016125001","v001","v001","v001","200112332","2016-12-05 03:00","","v001",],
	[ "p2016125001","v001","v001","v001","200112332","2016-12-05 03:00","","v001",],
	[ "p2016125001","v001","v001","v001","200112332","2016-12-05 03:00","","v001",],
	[ "p2016125001","v001","v001","v001","200112332","2016-12-05 03:00","","v001",],
	[ "p2016125001","v001","v001","v001","200112332","2016-12-05 03:00","","v001",],
	[ "p2016125001","v001","v001","v001","200112332","2016-12-05 03:00","","v001",],
	[ "p2016125001","v001","v001","v001","200112332","2016-12-05 03:00","","v001",],
	[ "p2016125001","v001","v001","v001","200112332","2016-12-05 03:00","","v001",],
	[ "p2016125001","v001","v001","v001","200112332","2016-12-05 03:00","","v001",]
]
$(document).ready(function() {
    $('#carInfo').DataTable( {
        data: carInfoSet,
        columns: [
            { title: "被保险人" },
            { title: "车牌号" },
            { title: "厂牌型号" },
            { title: "发动机号" },
            { title: "座位人数" },
            { title: "核定栽重" },
            { title: "车辆颜色" },
            { title: "购买地址" }
        ],
        "pagingType":   "full_numbers",
        "language": {
            "lengthMenu": "每页 _MENU_ 条记录",
            "zeroRecords": "没有找到记录",
            "info": "第 _PAGE_ 页 ( 总共 _PAGES_ 页 )",
            "infoEmpty": "无记录",
            "infoFiltered": "(从 _MAX_ 条记录过滤)",
            "sSearch":"搜索",
		    "paginate": {  
		        "first":      "«",  
		        "last":       "»",  
		        "next":       ">",  
		        "previous":   "<"  
		    }    
        },
        "filter":true,
        "info":true,
        /*手机端手机滚动条
        "scrollY": "200px",
	    "scrollCollapse": true,*/
	    /*分页设置*/
	    "paging":true,
        //"iDisplayLength" : 4,//默认显示数据数量
        "lengthChange": false,//关闭显示数据数量选项
        "order": [[ 3, "desc" ]],//默认第三列排序
        "ordering":false//关闭排序按钮控件
    } );
	
} );

//用户信息表
var customerInfoSet=[
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""],
	[ "p2016125001","v001","v001","200112332","2016-12-05 03:00",""]
]
$(document).ready(function() {
    $('#customerInfo').DataTable( {
        data: customerInfoSet,
        columns: [
            { title: "被保险人" },
            { title: "身份证号码" },
            { title: "手机号" },
            { title: "邮箱" },
            { title: "性别" },
            { title: "年龄" }
        ],
        "pagingType":   "full_numbers",
        "language": {
            "lengthMenu": "每页 _MENU_ 条记录",
            "zeroRecords": "没有找到记录",
            "info": "第 _PAGE_ 页 ( 总共 _PAGES_ 页 )",
            "infoEmpty": "无记录",
            "infoFiltered": "(从 _MAX_ 条记录过滤)",
            "sSearch":"搜索",
		    "paginate": {  
		        "first":      "«",  
		        "last":       "»",  
		        "next":       ">",  
		        "previous":   "<"  
		    }    
        },
        "filter":true,
        "info":true,
        /*手机端手机滚动条
        "scrollY": "200px",
	    "scrollCollapse": true,*/
	    /*分页设置*/
	    "paging":true,
        //"iDisplayLength" : 4,//默认显示数据数量
        "lengthChange": false,//关闭显示数据数量选项
        "order": [[ 3, "desc" ]],//默认第三列排序
        "ordering":false//关闭排序按钮控件
    } );
	
} );
//抱得缴纳信息
$(document).ready(function() {
    $('#paymentInfo').DataTable( {
        data: customerInfoSet,
        columns: [
            { title: "投保项目" },
            { title: "保单号" },
            { title: "保费" },
            { title: "保险起始日期" },
            { title: "保险截至日期" },
            { title: "登记日期" }
        ],
        "pagingType":   "full_numbers",
        "language": {
            "lengthMenu": "每页 _MENU_ 条记录",
            "zeroRecords": "没有找到记录",
            "info": "第 _PAGE_ 页 ( 总共 _PAGES_ 页 )",
            "infoEmpty": "无记录",
            "infoFiltered": "(从 _MAX_ 条记录过滤)",
            "sSearch":"搜索",
		    "paginate": {  
		        "first":      "«",  
		        "last":       "»",  
		        "next":       ">",  
		        "previous":   "<"  
		    }    
        },
        "filter":true,
        "info":true,
        /*手机端手机滚动条
        "scrollY": "200px",
	    "scrollCollapse": true,*/
	    /*分页设置*/
	    "paging":true,
        //"iDisplayLength" : 4,//默认显示数据数量
        "lengthChange": false,//关闭显示数据数量选项
        "order": [[ 3, "desc" ]],//默认第三列排序
        "ordering":false//关闭排序按钮控件
    } );
	
} );





