@extends('layouts/app')
@section('metaTitle')Product
    @endsection

@section('content')
<div class="container-fluid">

    
    <div class="row ">
        <div class="col-sm-12 col-md-12" >
            @include("layouts.partials.form" )
        </div>
        <div class="col-md-12">
            <div class="productListing"></div>
        </div>
    </div>
</div>
    
@endsection
    
    @section('jsSection')
        
    <script>
    $(function(){
        $("#btnSubmit").on("click", function(e) {
            e.preventDefault();
            var frmId = "#frmProduct";
            var frmObj = $(frmId);
            var frmData = {};
            $(frmObj.serializeArray()).each(function(k,v) {
                frmData[v.name] = v.value;
            });
           //validataion
            if(!frmData.name && !frmData.qty && !frmData.price ) {
                $(frmId).find(".msgSuccess").addClass('hide');
                $(frmId).find(".msgError").removeClass('hide').html('Please fill required field');
                return false;
            }
            //console.log(frmData);
            
            $(frmId).find(".msgError").addClass('hide').html('');
            
            $.post(routeUrl+'/productsave', frmData).done(function(response){
                    
                    $(frmId).find(".msgError").addClass("hide");
                    if(response.success) {
                        $(frmId).find(".msgSuccess").removeClass('hide').html(response.success);
                        //listing update....
                        $(".productListing").html(response.dataHtml);
                        //reset form
                        $(frmId).find("input[name='name']").val('');
                        $(frmId).find("input[name='qty']").val('');
                        $(frmId).find("input[name='price']").val('');
                    }
                    if(response.error){
                        $(frmId).find(".msgError").removeClass('hide').html(response.error);
                    }
            });
            return false;
        })
    });
    
    
    </script>
    @stop