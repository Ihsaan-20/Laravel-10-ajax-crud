@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="mt-3 mb-3 float-end">
                <button class="btn btn-primary addNewRecord" type="button">Add New Record</button>
                <button class="btn btn-danger deleteButton" type="button" style="display: none">Delete</button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-stripped table-hovered">
            <thead>
                <tr>
                    <th scope="col">
                        <input type="checkbox" id="selectAll" name="all[]">
                    </th>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Model</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="computers">

            </tbody>
        </table>
    </div>



    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="computerModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Modal title
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="computerForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="">Computer Name</label>
                            <input type="hidden" name="id" id="id" class="form-control">
                            <input type="text" name="name" id="name" placeholder="Enter computer name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Model Number</label>
                            <input type="text" name="model" id="model" placeholder="Enter computer model number" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary saveData">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
