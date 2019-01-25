$(document).ready(function(){ 

	$('#showme').click(function(){

        // alert('hello');
       var nv = 1;
        $('#new' + nv).append('<div class="form-inline mt-4 mb-4 hr">\
            <div class="col-md-2 cll"></div>\
            <input type="button" class="btn btn-info btn-sm mr-2" id="addr1" value="+ Input">\
            <input type="button" class="btn btn-outline-success btn-sm mr-2" id="radioo" value="+ Radio">\
            <input type="button" class="btn btn-outline-success btn-sm mr-2" id="cbox" value="+ Checkbox">\
            <input type="button" class="btn btn-outline-success btn-sm mr-2" id="dropdown" value="+ Dropdown">\
          </div>\
          <div id="inputr1">\
            <div class="form-inline mt-2">\
            <label for="display_name" class="control-label col-md-5">Legend:</label>\
            <input type="text" name="fields[]" value="legend" class="form-control col-md-7" placeholder="Legend Name" required>\
            <input type="hidden" name="types[]" value="legend" class="form-control col-md-7">\
            <input type="hidden" name="nepali_title[]" value="legend" class="form-control col-md-7">\
            <label class="control-label col-md-1">Field Name:</label>\
              <input type="text" class="form-control col-md-2" name="fields[]" required>\
              <label class="control-label col-md-1">फिल्डको नाम:</label>\
			<input type="text" class="form-control col-md-2" name="nepali[]" required>\
              <label class="control-label col-md-2">Type:</label>\
              <select type="text" name="types[]" class="form-control col-md-3">\
                <option value="VARCHAR">VARCHAR</option>\
                <option value="INT">INT</option>\
                <option value="TEXT">TEXT</option>\
              </select>\
             </div>\
          </div>\
          <div id="input10"></div>\
          <div id="fiel10"></div>\
          <div id="checkbox10"></div>\
          <div id="dropdown10"></div>\
          <input type="button" class="btn btn-warning btn-sm mr-2" id="newquestion" style="float: right;" value="+ New">'
          );
// <input type="button" class="btn btn-info" id="showme" style="float: right;" value="+ Question">'  
// <input type="button" class="btn btn-outline-alert btn-sm mt-2" style="float: right;" id="addlegend" value="+ New">'
// $('#showme').remove();

$('#newquestion').click(function(){
	// alert("working");
	var nvv = 1;
        $('#new' + nvv).append('<div class="form-inline mt-4 mb-4 hr">\
            <div class="col-md-2 cll"></div>\
            <input type="button" class="btn btn-info btn-sm mr-2" id="addr1" value="+ Input">\
            <input type="button" class="btn btn-outline-success btn-sm mr-2" id="radioo" value="+ Radio">\
            <input type="button" class="btn btn-outline-success btn-sm mr-2" id="cbox" value="+ Checkbox">\
            <input type="button" class="btn btn-outline-success btn-sm mr-2" id="dropdown" value="+ Dropdown">\
          </div>\
          <div id="inputr1">\
            <div class="form-inline mt-2">\
            <label for="display_name" class="control-label col-md-5">Legend:</label>\
            <input type="text" name="fields[]" value="legend" class="form-control col-md-7" placeholder="Legend Name" required>\
            <input type="hidden" name="types[]" value="legend" class="form-control col-md-7">\
            <input type="hidden" name="nepali_title[]" value="legend" class="form-control col-md-7">\
            <label class="control-label col-md-1">Field Name:</label>\
              <input type="text" class="form-control col-md-2" name="fields[]" required>\
              <label class="control-label col-md-1">फिल्डको नाम:</label>\
			<input type="text" class="form-control col-md-2" name="nepali[]" required>\
              <label class="control-label col-md-2">Type:</label>\
              <select type="text" name="types[]" class="form-control col-md-3">\
                <option value="VARCHAR">VARCHAR</option>\
                <option value="INT">INT</option>\
                <option value="TEXT">TEXT</option>\
              </select>\
             </div>\
          </div>\
          <div id="input20"></div>\
          <div id="fiel20"></div>\
          <div id="checkbox20"></div>\
          <div id="dropdown20"></div>\
          <input type="button" class="btn btn-warning btn-sm mr-2" id="newquestion" style="float: right;" value="+ New">');
        $('#newquestion').remove();
	});


var no = 1;
$('#addlegend').click(function(){
	// alert("hello");

	var delbtn ='delete_row' + no;
		$('#new'+ no).append('<div class="form-inline mt-1 row' + no + '"><label class="control-label col-md-1">Field Name:</label>\
			<input type="text" class="form-control col-md-2" name="fields[]" required>\
			<label class="control-label col-md-1">फिल्डको नाम:</label>\
			<input type="text" class="form-control col-md-2" name="nepali_title[]" required>\
			<label class="control-label col-md-2">Type:</label><select type="text" name="types[]" class="form-control col-md-3">\
			<option value="VARCHAR">VARCHAR</option><option value="INT">INT</option>\
			<option value="TEXT">TEXT</option></select><b class="btn btn-sm btn-danger ml-3" id="delete_row'+no+'">-</b>');
		$(delbtn).click(function(){
			$(row).remove();
			no = no-1;
		});
		
		no = no + 1;
	});

    var xx = 1;
$('#addr1').click(function(){
	// alert("hello");
		var delbtn = '#delete_row' + xx;
		var row = '.row' + xx;


		$('#input10').append('<div class="form-inline mt-1 row' + xx + '"><label class="control-label col-md-1">Field Name:</label>\
			<input type="text" class="form-control col-md-2" name="fields[]" required>\
			<label class="control-label col-md-1">फिल्डको नाम:</label>\
			<input type="text" class="form-control col-md-2" name="nepali_title[]" required>\
			<label class="control-label col-md-2">Type:</label><select type="text" name="types[]" class="form-control col-md-3">\
			<option value="VARCHAR">VARCHAR</option><option value="INT">INT</option>\
			<option value="TEXT">TEXT</option></select><b class="btn btn-sm btn-danger ml-3" id="delete_row'+xx+'">-</b>');
		
		$(delbtn).click(function(){
			$(row).remove();
			xx = xx-1;
		});
		xx= xx+1;
		
	});

	//Add Radio buttons
	var next = 10;
	var y = 10;
	$('#radioo').click(function(){

		var addto = '#fiel'+ next;
		var delbtn1 = '#delete_radio' + y ;
		var delrow1 = '.rowa' + y ;
		var p = next;
		next = next + 1 ;

		$(addto).append("<div class='form-inline mt-4 field_wrapper"+next+" rowa"+y+"'>\
			<label class='control-label col-md-1'>Field Name:</label>\
			<input type='text' class='form-control col-md-2' name='fields[]' required></input>\
			<label class='control-label col-md-1'>फिल्डको नाम:</label>\
			<input type='text' class='form-control col-md-2' name='nepali_title[]' required>\
			<input type='hidden' name='types[]' value='radio"+p+"'>\
			<label class='control-label col-md-1'>Radio Values:</label>\
			<input type='text' class='form-control col-md-2' name='values[radio"+p+"][]' placeholder='Add Value'>\
			<input type='button' class='btn btn-outline-info btn-sm offset-1' id='addmore"+next+"' value='+ Add'><b class='btn btn-sm btn-danger ml-3' id='delete_radio"+y+"'>-</b></div><div id='field"+next+ "'></div>");
		$(delbtn1).click(function(){
			$(delrow1).remove();
			y = y - 1 ;
		});
		y = y + 1;

		var nxt = next;
		var addmore = '#addmore'+nxt;
		$(addmore).click(function(){
			// alert("radio");
			var addTo = '.field_wrapper' + nxt;
			$(addTo).append("<input type='text' class='form-control col-md-2 offset-8' name='values[radio"+p+"][]' placeholder='Add Value'><div id='addmore"+nxt+"'></div>");
		});
	});

	//Add checkbox
	var c = 10;
	var k =10;
	$('#cbox').click(function(){
		// alert("jij");
		var addme = '#checkbox' + c;
		var delbtn2 = '#delete_checkbox' + k ;
		var delrow2 = '.rowb' + k ;
		var a = c;
		c = c + 1;

		$(addme).append("<div class='form-inline mt-4 checkbox_wrapper"+c+" rowb"+k+"'>\
			<label class='control-label col-md-1'>Field Name:</label><input type='text' class='form-control col-md-2' name='fields[]' required>\
			<label class='control-label col-md-1'>फिल्डको नाम:</label>\
			<input type='text' class='form-control col-md-2' name='nepali_title[]' required>\
			<input type='hidden' name='types[]' value='checkbox"+a+"'><label class='control-label col-md-1'>Checkbox Values:</label>\
			<input type='text' class='form-control col-md-2' name='values[checkbox"+a+"][]' placeholder='Add Value'>\
			<input type='button' class='btn btn-outline-warning btn-sm offset-1' id='addcheckbox"+c+"' value='+ Add'><b class='btn btn-sm btn-danger ml-3' id='delete_checkbox"+k+"'>-</b></div><div id='checkbox"+c+ "'>");
		$(delbtn2).click(function(){
			$(delrow2).remove();
			k = k - 1;
		});
		k = k + 1;
		var ck = c;
		var addcheckbox = '#addcheckbox'+ck;
		$(addcheckbox).click(function() {
			
			var addMe = '.checkbox_wrapper'+ck;
			$(addMe).append("<input type='text' class='form-control col-md-2 offset-8' name='values[checkbox"+a+"][]' placeholder='Add Value'><div id='addcheckbox"+ck+"'></div>");
		});

	});

	//Add dropdown
	var chkk = 10;
	var n = 10;
	$('#dropdown').click(function(){

		var addme = '#dropdown' + chkk;
		var delbtn3 = '#delete_dropdown' + n;
		var delrow3 = '.rowc' + n ;
		var b = chkk;
		chkk = chkk + 1;

		$(addme).append("<div class='form-inline mt-4 dropdown_wrapper"+chkk+" rowc"+n+"'>\
			<label class='control-label col-md-1'>Field Name:</label><input type='text' class='form-control col-md-2' name='fields[]' required>\
			<label class='control-label col-md-1'>Display Name:</label>\
			<input type='text' class='form-control col-md-2' name='nepali_title[]' required>\
			<input type='hidden' name='types[]' value='dropdown"+b+"'><label class='control-label col-md-1'>Dropdown Values:</label>\
			<input type='text' class='form-control col-md-2' name='values[dropdown"+b+"][]' placeholder='Add Value'>\
			<input type='button' class='btn btn-outline-info btn-sm offset-1' id='adddropdown"+chkk+"' value='+ Add'><b class='btn btn-sm btn-danger ml-3' id='delete_dropdown"+n+"'>-</b></div><div id='dropdown"+chkk+ "'>");
		$(delbtn3).click(function(){
			$(delrow3).remove();
			n = n - 1 ;
		});
		n = n + 1;

		var ckk = chkk;
		var adddropdown = '#adddropdown'+ckk;
		$(adddropdown).click(function() {
			
			var addMe = '.dropdown_wrapper'+ckk;
			$(addMe).append("<input type='text' class='form-control col-md-2 offset-8' name='values[dropdown"+b+"][]' placeholder='Add Value'><div id='adddropdown"+ckk+"'></div>");
		});

	});
nv=nv+1;  
 }); // ends here //==================================================================================

	$('#delete_first_row').click(function(){

		$('#first_input_row').remove();
	});


	var x = 1;
	$('#add').click(function(){
		// alert("hello");
	var delbtn = '#delete_row' + x;
	var row = '.row' + x;


		$('#input').append('<div class="form-inline mt-1 row' + x + '">\
			<label class="control-label col-md-1">Field Name:</label>\
			<input type="text" class="form-control col-md-2" name="fields[]" placeholder="in english" required>\
			<label class="control-label col-md-2">फिल्डको नाम:</label>\
			<input type="text" class="form-control col-md-2" name="nepali_title[]" required>\
			<label class="control-label col-md-2">Type:</label>\
			<select type="text" name="types[]" class="form-control col-md-2">\
			<option value="VARCHAR">VARCHAR</option><option value="INT">INT</option>\
			<option value="TEXT">TEXT</option></select><b class="btn btn-sm btn-danger ml-3" id="delete_row'+x+'">-</b>\
			');
		
		$(delbtn).click(function(){
			$(row).remove();
			x = x-1;
		});
		x= x+1;
	});


	//Add Radio buttons
	var next = 1;
	var y = 1;
	$('#addradio').click(function(){

		var addto = '#field'+ next;
		var delbtn1 = '#delete_radio' + y ;
		var delrow1 = '.rowa' + y ;
		var p = next;
		next = next + 1 ;

		$(addto).append("<div class='form-inline mt-4 field_wrapper"+next+" rowa"+y+"'>\
			<label class='control-label col-md-1'>Field Name:</label>\
			<input type='text' class='form-control col-md-2' name='fields[]' required></input>\
			<label class='control-label col-md-1'>फिल्डको नाम:</label>\
			<input type='text' class='form-control col-md-2' name='nepali_title[]'' required>\
			<input type='hidden' name='types[]' value='radio"+p+"'>\
			<label class='control-label col-md-1'>Radio Values:</label>\
			<input type='text' class='form-control col-md-2' name='values[radio"+p+"][]' placeholder='Add Value'>\
			<input type='button' class='btn btn-outline-info btn-sm offset-1' id='addmore"+next+"' value='+ Add'><b class='btn btn-sm btn-danger ml-3' id='delete_radio"+y+"'>-</b></div><div id='field"+next+ "'>\
			</div>");
		$(delbtn1).click(function(){
			$(delrow1).remove();
			y = y - 1 ;
		});
		y = y + 1;

		var nxt = next;
		var addmore = '#addmore'+nxt;
		$(addmore).click(function(){
			// alert("radio");
			var addTo = '.field_wrapper' + nxt;
			$(addTo).append("<input type='text' class='form-control col-md-2 offset-7' name='values[radio"+p+"][]' placeholder='Add Value'><div id='addmore"+nxt+"'></div>");
		});
	});


	//Add checkbox
	var chk = 1;
	var z =1;
	$('#addcheckbox').click(function(){

		var addme = '#checkbox' + chk;
		var delbtn2 = '#delete_checkbox' + z ;
		var delrow2 = '.rowb' + z ;
		var a = chk;
		chk = chk + 1;

		$(addme).append("<div class='form-inline mt-4 checkbox_wrapper"+chk+" rowb"+z+"'>\
			<label class='control-label col-md-1'>Field Name:</label><input type='text' class='form-control col-md-2' name='fields[]' required>\
			<label class='control-label col-md-1'>फिल्डको नाम:</label>\
			<input type='text' class='form-control col-md-2' name='nepali_title[]'' required>\
			<input type='hidden' name='types[]' value='checkbox"+a+"'><label class='control-label col-md-1'>Checkbox Values:</label>\
			<input type='text' class='form-control col-md-2' name='values[checkbox"+a+"][]' placeholder='Add Value'>\
			<input type='button' class='btn btn-outline-warning btn-sm offset-1' id='addcheckbox"+chk+"' value='+ Add'><b class='btn btn-sm btn-danger ml-3' id='delete_checkbox"+z+"'>-</b></div><div id='checkbox"+chk+ "'>");
		$(delbtn2).click(function(){
			$(delrow2).remove();
			z = z - 1;
		});
		z = z + 1;
		var ck = chk;
		var addcheckbox = '#addcheckbox'+ck;
		$(addcheckbox).click(function() {
			
			var addMe = '.checkbox_wrapper'+ck;
			$(addMe).append("<input type='text' class='form-control col-md-2 offset-8' name='values[checkbox"+a+"][]' placeholder='Add Value'><div id='addcheckbox"+ck+"'></div>");
		});

	});

//Add dropdown
	var chkk = 1;
	var n = 1;
	$('#adddropdown').click(function(){

		var addme = '#dropdown' + chkk;
		var delbtn3 = '#delete_dropdown' + n;
		var delrow3 = '.rowc' + n ;
		var b = chkk;
		chkk = chkk + 1;

		$(addme).append("<div class='form-inline mt-4 dropdown_wrapper"+chkk+" rowc"+n+"'><label class='control-label col-md-1'>Field Name:</label>\
			<input type='text' class='form-control col-md-2' name='fields[]' required>\
			<label class='control-label col-md-1'>फिल्डको नाम:</label>\
			<input type='text' class='form-control col-md-2' name='nepali_title[]'' required>\
			<input type='hidden' name='types[]' value='dropdown"+b+"'>\
			<label class='control-label col-md-1'>Dropdown Values:</label><input type='text' class='form-control col-md-2' name='values[dropdown"+b+"][]' placeholder='Add Value'><input type='button' class='btn btn-outline-info btn-sm offset-1' id='adddropdown"+chkk+"' value='+ Add'><b class='btn btn-sm btn-danger ml-3' id='delete_dropdown"+n+"'>-</b></div><div id='dropdown"+chkk+ "'>");
		$(delbtn3).click(function(){
			$(delrow3).remove();
			n = n - 1 ;
		});
		n = n + 1;

		var ckk = chkk;
		var adddropdown = '#adddropdown'+ckk;
		$(adddropdown).click(function() {
			
			var addMe = '.dropdown_wrapper'+ckk;
			$(addMe).append("<input type='text' class='form-control col-md-2 offset-8' name='values[dropdown"+b+"][]' placeholder='Add Value'><div id='adddropdown"+ckk+"'></div>");
		});

	});

	$('#addrelation').click(function(){

		// $('#relation1').append('<div class="form-inline mt-1"><label class="control-label col-md-2">Primary Table Name:</label><select type="text" name="types[]" class="form-control col-md-3"><option value="VARCHAR">VARCHAR</option><option value="INT">INT</option><option value="TEXT">TEXT</option></select>');
	
		$('#relation1').clone().appendTo('#input');
		alert('Please make sure you have added an id field to store primary table id. For example: user_id');
		$('#relation1').css('display','initial');

		$('#select1').change(function(){
			var one =  $('#select1').val();
			console.log(one);
		});
	});

		var l = 1;
	$('#addlegend').click(function(){
		// alert("hello");
	var delbtn = '#delete_row' + l;
	var row = '.row' + l;


		$('#inputt').append('<div class="form-inline mt-1 row' + l + '">\
			<label for="display_name" class="control-label col-md-3">Legend:</label>\
            <input type="text" name="fields[]" value="legend" class="form-control col-md-7" placeholder="Legend Name" required>\
            <input type="hidden" name="types[]" value="legend" class="form-control col-md-7">\
            <input type="hidden" name="nepali_title[]" value="legend" class="form-control col-md-7"><b class="btn btn-sm btn-danger ml-3" id="delete_row'+l+'">-</b>');
		
		$(delbtn).click(function(){
			$(row).remove();
			l = l-1;
		});
		l= l+1;
	});

});




// <label for="display_name" class="control-label col-md-5">Legend:</label>\
            // <input type="text" name="fields[]" value="legend" class="form-control col-md-7" placeholder="Legend Name" required>\
            // <input type="hidden" name="types[]" value="legend" class="form-control col-md-7">\
              