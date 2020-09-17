@extends('layouts.app')

@section('content')
<div id="vue">
    <div v-if="loading" class="d-flex justify-content-center align-items-center">
        <h1 class="text-dark text-bold">Loading...</h1>
    </div>
    <div class="px-2 py-2" v-else>
        <h4>Create New Product</h4>
        <div v-if="errors.length != 0" class="alert alert-danger d-inline-block">
            <ol>
               <li v-for="error in errors"> @{{ error[0] }} </li>
            </ol>
        </div>
        <form action="" method="post" v-on:submit="createProduct">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" class="form-control" v-model="product.name" id="name">
            </div>
            <div class="form-group">
                <label for="price">Product Price</label>
                <input type="number" name="price" class="form-control" v-model="product.price" id="price">
            </div>
            <div class="form-group">
                <label for="desc">Product Description</label>
                <textarea name="description" class="form-control" v-model="product.description" id="desc"></textarea>
            </div>
            <div class="my-1">
                <button type="submit" class="btn btn-success" v-on:click="createProduct">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/create.js') }}">
</script>
@endsection
