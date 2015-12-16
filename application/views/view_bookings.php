<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"/>
	<title>Vietnam Bookings</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>theme/css/default/easyui.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>theme/css/icon.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>theme/css/color.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>theme/css/demo.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>theme/css/style.css"/>
	<script type="text/javascript" src="<?php echo base_url();?>theme/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>theme/js/jeasy-ui/jquery.easyui.min.js"></script>
    <script>
    window.onload = function() {
        //$('#datagrid_container').css({'height':($(document).height()-120)+'px'});
    };
    </script>
</head>
<body>   
    <form id="ff" method="post" data-options="novalidate:true">
    <table style="height:100px;">
        <tr>
            <td style="width: 100px;" align="right">BKG Reference</td>
            <td style="width: 200px;"><a href="#" id="textbox_reference_tooltip"><input id="textbox_reference" class="easyui-numberbox" name="reference" data-options="validType:['length[6,6]'],invalidMessage:'Enter 6 digits only please!'"/></a></td>
            
            <td align="right">Arranged Guide</td>
            <td><input name="guide" class="easyui-textbox"/></td>            
            
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="right">Region</td>
            <td>
            <select name="region" id="combobox_region" class="easyui-combobox" required style="width:150px">
                <option value="ALL">Vietnam</option>
                <option value="SGN">Saigon</option>
                <option value="HUI">Hue</option>
                <option value="HAN">Hanoi</option>
            </select>
            </td>
            
            <td align="right" style="width: 200px;">Region Arr. Date</td>
            <td style="width: 250px;">
                <input class="easyui-datebox" id="datebox_from" data-options="formatter:myformatter,parser:myparser" style="width:100px"/>
                <span>to</span>
                <input class="easyui-datebox" id="datebox_to" data-options="formatter:myformatter,parser:myparser" style="width:100px"/>
            </td>           
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td colspan="3">
                <a href="javascript:void(0)" onclick="submitForm()" class="easyui-linkbutton" data-options="iconCls:'icon-search'" style="width:80px">Go</a>
                <a href="javascript:void(0)" onclick="clearForm()" class="easyui-linkbutton" data-options="iconCls:'icon-cancel'" style="width:120px">Clear params</a>
            </td>
        </tr>        
    </table>
    </form>
    
	<table id="dg" title="Booking List (max 50 records)" class="easyui-datagrid" style="height: 560px; margin-top:100px;"
			url="<?php echo base_url();?>tourplan/getBooking/<?php echo date("Ymd");?>"
			toolbar="#toolbar"
			rownumbers="true" singleSelect="true"><!--pagination="true" pageSize="20" pageNumber="1" pageList="[10,20,50,100]"-->
        <thead data-options="frozen:true">
            <tr>
                <th field="FULL_REFERENCE" width="100">REFERENCE</th>
				<th field="Booking_Name" width="300">BOOKING NAME</th>
            </tr>
        </thead>
		<thead>
			<tr>
				<th field="Travel_Date" width="100">TRAVEL DATE</th>
				<th field="CONSULTANT_NAME" width="150">CONSULTANT</th>
                <th field="FirstDate_InDestination" width="100">Arrival Date</th>
                <th field="LastDate_InDestination" width="100">Departure Date</th>
                <th field="Assigned_Guide" width="150">Guide Info</th>
                <th field="blabla" width="150">Vehicle Info</th>
                <th field="blabla" width="150">Flight IN</th>
                <th field="blabla" width="150">Flight OUT</th>
                <th field="blabla" width="150">Restaurant</th>
                <th field="blabla" width="150">Extra Services</th>
			</tr>
		</thead>
	</table>    

	<div id="toolbar">
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Arrange Guide to Booking</a>
		<!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Edit User</a>-->
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Remove Guide Record</a>
	</div>
	
	<div id="dlg" class="easyui-dialog" style="width:400px;height:380px;padding:10px 20px"
			closed="true" buttons="#dlg-buttons">
		<div class="ftitle">Guide Information</div>
		<form id="fm" method="post" novalidate>
            <div class="fitem">
				<label>Language:</label>
				<select name="language" class="easyui-combobox">
                    <option>ESG</option>
                    <option>SSG</option>
                    <option>GSG</option>
                </select>
			</div>
			<div class="fitem">
				<label>Guide Name:</label>
				<input name="firstname" class="easyui-textbox" required="true"/>
			</div>
            <!--
			<div class="fitem">
				<label>Last Name:</label>
				<input name="lastname" class="easyui-textbox" required="true"/>
			</div>
            -->
			<div class="fitem">
				<label>Phone:</label>
				<input name="phone" class="easyui-textbox"/>
			</div>
            <!--
			<div class="fitem">
				<label>Email:</label>
				<input name="email" class="easyui-textbox" validType="email"/>
			</div>
            -->
            <div class="fitem">
				<label>Notes:</label>
				<input name="note" class="easyui-textbox" data-options="multiline:true" accept="true" style="width:300px;height:100px"/>
			</div>
		</form>
	</div>
	<div id="dlg-buttons">
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
		<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancel</a>
	</div>
	<script type="text/javascript">
    var url;
    function newUser(){
    	$('#dlg').dialog('open').dialog('setTitle','Guide Arrangement');
    	$('#fm').form('clear');
    	url = 'save_user.php';
    }
    function editUser(){
    	var row = $('#dg').datagrid('getSelected');
    	if (row){
    		$('#dlg').dialog('open').dialog('setTitle','Edit User');
    		$('#fm').form('load',row);
    		url = 'update_user.php?id='+row.id;
    	}
    }
    function saveUser(){
    	$('#fm').form('submit',{
    		url: url,
    		onSubmit: function(){
    			return $(this).form('validate');
    		},
    		success: function(result){
    			var result = eval('('+result+')');
    			if (result.errorMsg){
    				$.messager.show({
    					title: 'Error',
    					msg: result.errorMsg
    				});
    			} else {
    				$('#dlg').dialog('close');		// close the dialog
    				$('#dg').datagrid('reload');	// reload the user data
    			}
    		}
    	});
    }
        
    function destroyUser(){
    	var row = $('#dg').datagrid('getSelected');
    	if (row){
    		$.messager.confirm('Confirm','Are you sure you want to destroy this user?',function(r){
    			if (r){
    				$.post('destroy_user.php',{id:row.id},function(result){
    					if (result.success){
    						$('#dg').datagrid('reload');	// reload the user data
    					} else {
    						$.messager.show({	// show error message
    							title: 'Error',
    							msg: result.errorMsg
    						});
    					}
    				},'json');
    			}
    		});
    	}
    }
    
    function clearForm(){
        $('#ff').form('clear');
    }
    
    function submitForm(){
        $('#ff').form('submit',{
            onSubmit:function(){
                var reference = $("#textbox_reference").textbox('getText');
                var date_from = $("#datebox_from").datebox('getValue');
                var date_to = $("#datebox_to").datebox('getValue');
                
                if(date_from == "" && date_to == ""){
                    if(reference == "") return false;                    
                }
                
                if((date_from != "" && date_to == "") || (date_from == "" && date_to != "") || (date_from > date_to))
                {
                    return false;
                }    
                
                if($(this).form('enableValidation').form('validate'))
                    LoadGrid();
                return false;    
            }
        });
    }
    
    function LoadGrid()
    {
        var date_from = $('#datebox_from').datebox('getValue');
        var date_to = $('#datebox_to').datebox('getValue');
        var region = $('#combobox_region').combobox('getValue');
        var reference = $("#textbox_reference").textbox('getText');
        
        $("#dg").datagrid({            
            loader: function(param,success,error){
                $.ajax({
                    url: "<?php echo base_url();?>tourplan/getBookingInPeriod/",
                    type: "POST",
                    context: this,
                    error: function () {},
                    dataType: 'json',
                    data: {country:"VN", datefrom:date_from, dateto:date_to, office:region, code:reference},
                    success : function (response) {
                        success(response);
                        $(this).datagrid("selectRow",0);
                    }
                });   
            }
        });             
    }
    
    function myformatter(date){
        var y = date.getFullYear();
        var m = date.getMonth()+1;
        var d = date.getDate();
        return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
    }
    
    function myparser(s){
        if (!s) return new Date();
        var ss = (s.split('-'));
        var y = parseInt(ss[0],10);
        var m = parseInt(ss[1],10);
        var d = parseInt(ss[2],10);
        if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
            return new Date(y,m-1,d);
        } else {
            return new Date();
        }
    }
    
    
    $(function() {
        $('#dg').datagrid({
        	rowStyler: function(index,row){
        		if (index%2){
        			return {class:'odd_row'};
        		}
        	}
        });        
        
        $("#textbox_reference_tooltip").tooltip({
            position:'right',
            content: '<span style="color:#fff">E.g. type "123456" for booking code SGSA123456.</span>',
            onShow: function(){
                $(this).tooltip('tip').css({
                    backgroundColor: '#666',
                    borderColor: '#666'
                });
            }
        });
        
        $("#datebox_from").datebox({
        	onSelect: function(date_from){
                var twoweekslater = new Date(date_from.getTime()+(14*24*60*60*1000));
                var yyyy = twoweekslater.getFullYear().toString();
                var mm = (twoweekslater.getMonth()+1).toString(); // getMonth() is zero-based
                var dd  = twoweekslater.getDate().toString();
                $('#datebox_to').datebox('setValue', ""+yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]));
                $('#datebox_to').datebox('calendar').calendar({
                    validator: function(date){
                        var date_to = new Date(date_from.getFullYear(), date_from.getMonth(), date_from.getDate()+90);
                        return date_from<=date && date<=date_to;
                    }
                });
        	}
        });
    });

	</script>
	<style type="text/css">
		#fm{
			margin:0;
			padding:10px 30px;
		}
		.ftitle{
			font-size:14px;
			font-weight:bold;
			padding:5px 0;
			margin-bottom:10px;
			border-bottom:1px solid #ccc;
		}
		.fitem{
			margin-bottom:5px;
		}
		.fitem label{
			display:inline-block;
			width:80px;
		}
		.fitem input{
			width:160px;
		}
	</style>
</body>
</html>