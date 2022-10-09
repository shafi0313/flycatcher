@extends('layouts.master')

@section('title', 'Parcel details')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Parcel list'=>route('admin.parcel.index'),
    'Parcel details'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Parcel details' :links="$links" />
    <div class="content-body">
        <div class="mr-1">
            <div class="form-modal-ex">
                <!-- Button trigger modal -->
                <button type="button" title="Parcel Note" class="btn btn-sm btn-primary mb-1" data-toggle="modal" data-target="#showNote-{{$parcel->id}}"> &nbsp;<i class="fa fa-plus-circle"></i>Add Note
                </button>
                <!-- Modal -->
                <div class="modal fade text-left" id="showNote-{{$parcel->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content p-1">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel33">Parcel Note</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('admin.parcel-note.store')}}" method="POST" class="">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="note">Note</label>
                                                <textarea class="form-control" id="note" name="note" placeholder="Enter Note" rows="3"></textarea>
                                                <input type="hidden" class="form-control" id="parcel_id" name="parcel_id" value="{{ $parcel->id}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary waves-effect waves-float waves-light float-right" type="submit">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('components.parcel-details')
    </div>
</div>
@endsection