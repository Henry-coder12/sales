<div class="p-w-md m-t-sm">
    <div class="row text-center">
        <h3>INGRESE LA CLAVE: </h3>
    </div>
</div>


<div class="form-group row">
	<div class="col-md-4"></div>
	<div class="col-md-4"><input id="pass" class="form-control col-md-3" name="document" required="required" value="" type="password" onkeyup ="checkPasswordMatch();"></div>
	<div class="col-md-4"></div>
</div>
<script type="text/javascript">
	function checkPasswordMatch() {
	    var password = $("#pass").val();

	    if (password == <?php echo $key; ?>){
	        $("#list_commends").show();
	    }
	}
</script>