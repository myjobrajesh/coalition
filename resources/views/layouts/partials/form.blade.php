Product Form

<form id=frmProduct class="frmProduct form-inline" name="frmProduct" method="post" action="{{route('product.save')}}">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="col-sm-12">
        <div class="alert alert-danger hide msgError"></div>
        <div class="alert alert-success hide msgSuccess"></div>
    </div>
    <div class="col-sm-12">
    
        <div class="form-group">
            <label>Product Name:</label>
            <div class=""><input type="text" class="fom-control" placeholder="Product Name" name="name" required></div>
        </div>
        <div class="form-group">
            <label>Quantity in stock:</label>
            <div><input type="text" placeholder="Quantity in stock" name="qty" required></div>
        </div>
        <div class="form-group">
            <label>Price per item:</label>
            <div><input type="text" placeholder="Price per item" name="price" required></div>
        </div>
        
        <div class="form-group">
            <td colspan="2"><input type="button" class="btn btn-primary" id="btnSubmit" name="submit" value="Submit"></td>
        </div>
            
    </div>
</form>