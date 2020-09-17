@extends('layouts.app')

@section('content')
    <div id="vue">
        <div class="my-1">
                <a href="{{ route('products.create') }}" class="btn btn-link">Create New Product</a>
        </div>
        <div v-if="loading" class="d-flex justify-content-center align-items-center">
            <h1 class="text-dark text-bold">Loading...</h1>
        </div>
        <div v-else>
            <div class="my-2 mx-4 d-flex">
                <input type="text" name="search" class="form-control" v-model="search" placeholder="Search Products">
                <button v-on:click="searchProducts" class="mx-2 btn btn-outline-info">Search</button>
            </div>
            <div class="row no-gutters mx-2" v-if="products.length > 0">
                <div v-for="product in products" class="col-md-4 card">
                    <div class="card-body">
                        <h5 class="card-title">@{{ product.name }}</h5>
                        <p class="card-text">@{{ product.description }}</p>
                    </div>
                    <div class="card-footer">
                        <a :href="'products/'+product.id" class="card-link">View Product</a>
                    </div>
                </div>
            </div>
            <div v-else>
                <p class="mx-4">No products found</p>
            </div>
            <div class="my-2 d-flex justify-content-center align-items-center">
                <div v-if="paginator.hasPages()">
                    <nav>
                        <ul class="pagination">
                            <div v-if="paginator.onFirstPage">
                                <li class="page-item disabled" aria-disabled="true">
                                    <span class="page-link">Previous</span>
                                </li>
                            </div>
                            <div v-else>
                                <li class="page-item">
                                    <button class="page-link" v-on:click="prev" rel="prev">Previous</button>
                                </li>
                            </div>
                            <div v-if="paginator.hasMorePages">
                                <li class="page-item">
                                    <button class="page-link" v-on:click="next" rel="next">Next</button>
                                </li>
                            </div>
                            <div v-else>
                                <li class="page-item disabled" aria-disabled="true">
                                    <span class="page-link">Next</span>
                                </li>
                            </div>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('js/index.js') }}"></script>
@endsection
