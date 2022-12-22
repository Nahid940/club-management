@extends('main')
@section('pageHeading'){{$title}}@stop
@section('style')
    .form-control{
        height: calc(1.40rem);
        padding: .1rem 0.75rem;
        border: 1px solid #b4bae2b5;
        font-size: 0.7rem;
    }
    .suggestion-area, .suggestion-area1 {
        position: absolute;
        width: 98%;
        background-color: #fff;
        z-index: 11;
        display: block;
        height: auto;
        margin-top:-16px
    }
    .suggestion-area .search-item, .suggestion-area1 .search-item, .suggestion-area2 .search-item {
        background-color: #0b64d4;
        color:#fff;
        padding: 5px;
        list-style: none;
        overflow: hidden;
    }
    .search-content{
        color:#fff
    }
    .search-item:hover{
        background-color: #1975e6;
    }
    .hidden_area{
        display:none
    }
@stop
@section('content')
<div class="row">
    <div class="col-md-6 offset-md-3 col-sm-12">
    </div>
</div>
@stop