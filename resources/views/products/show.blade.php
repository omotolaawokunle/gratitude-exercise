@extends('layouts.app')

@section('content')
<div id="vue">
        <div v-if="loading" class="d-flex justify-content-center align-items-center">
            <h1 class="text-dark text-bold">Loading...</h1>
        </div>
        <div v-else class="px-5 py-2">
            <div class="d-lg-flex justify-content-lg-between align-items-center">
             <h1 class="mb-lg-1">@{{ product.name }}</h1>
             <div class="d-flex">
                 <a :href="'/products/edit/'+product.id" class="btn btn-info mx-1">Edit</a>
                 <button class="btn btn-danger mx-1" v-on:click="deleteProduct">Delete</button>
             </div>
            </div>
             <p class="text-dark">
                 <div>
                     @{{ product.description }}
                 </div>
                <div><span class="font-weight-bold">Price:</span> $@{{ product.price }}</div>
                <div><span class="font-weight-bold">Created:</span> @{{ product.created_at }}</div>
            </p>
        </div>
@endsection

@section('scripts')
<script src="{{ asset('js/show.js') }}"></script>
@endsection
