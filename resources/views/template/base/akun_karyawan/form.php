<?php include'../index.php';
$tbname='karyawan';
if($_GET['act']=='edit'){
	foreach($conn->get_results("select *from $tbname where id='$_GET[id]'")as $data);
	
}
?>
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLongTitle">Form Akun Karyawan</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<form class="" id="FormData">
    <div class="position-relative row form-group">
        <label for="role_name" class="col-sm-3 col-form-label">Type Password</label>
        <div class="col-sm-9" style="padding-top:5px;">
            <input type="checkbox" name="ca" id="ca" value="1" style="cursor:pointer;"/> <label for="ca" style="cursor:pointer;"> Angka</label>&nbsp;&nbsp;
                    <input type="checkbox" name="ch" id="ch" value="1" style="cursor:pointer;"/> <label for="ch" style="cursor:pointer;"> Huruf</label>&nbsp;&nbsp;
					
        </div>
    </div>
    
    
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        <button type="button" onclick="Create_Akun();" class="btn btn-primary">Create Akun</button>

    </div>
</form>
<script>
function Create_Akun(){
	 var url ="<?php echo './base/akun_karyawan/act.php?act=new';?>"; 
 var data = $('#FormData').serialize();
 var ca = document.getElementById("ca");
				if(ca.checked == true) var cav = 'yes'; else var cav = '';
				var ch = document.getElementById("ch");
				if(ch.checked == true) var chv = 'yes'; else var chv = '';
				$.ajax({
							type:'POST',
							url:url,
							data:'ca='+ cav +'&ch='+ chv,
							success: function(response){
								$('#loadfile').load('./base/akun_karyawan/data.php');
								
								$('.preloader3').hide();
							}
						});	
}


</script>

