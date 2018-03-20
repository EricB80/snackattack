@extends('layouts.app')

@section('pagescript')
<script type='text/javascript' src='js/snacklist.js'></script>
@endsection

@section('content')
<div class="row">
    <div class="form-inline col-md-12">
        <div class="form-group col-sm-5">
            <label for="snackName" class="control-label">Snack Name</label>
            <input type="text" class="form-control" name="snackName" id="snackName" placeholder="Enter Snack Name"/>
        </div>
        <div class="form-group col-sm-5">
            <label for="snackQty" class="control-label"># Pcs in Package</label>
            <input type="number" name="snackQty" id="snackQty" class="form-control" placeholder="# Pcs"/>
        </div>
        <div class="col-sm-2">
            <button type="button" class="btn btn-primary" id="saveSnack">Save Snack</button>
        </div>
    </div>
</div>
<div class="row">
    <div id="listHolder" class="col-md-12"></div>
</div>
@endsection


@section('pageModals')
<div class="modal fade" role="dialog"id="editModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editSnack">Editing <span id="editLabel"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-horizontal col-sm-12">
                        <input type="hidden" name="editId" id="editId"/>
                        <div class="form-group">
                            <label for="editName">Name: </label>
                            <input type="text" name="editName" id="editName" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="editQty" class="control-label"># Pcs In Pakage</label>
                            <input type="number" class="form-control" name="editQty" id="editQty"/>
                        </div>
                        <div class="form-group">
                            <label for="editDesc">Description</label>
                            <textarea name="editDesc" id="editDesc" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="saveChanges" data-dismiss="modal">Save Changes</button>
                <button type="button" class="btn btn-error" id="cancelChanges" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection