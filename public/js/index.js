const app = new Vue({
    el: "#vue",
    data: {
        products: [],
        filter: false,
        search: "",
        links: [],
        meta: [],
        loading: true,
        paginator: {}
    },
    methods: {
        getProducts(page = 1) {
            this.loading = true;
            axios
                .get("/api/products?page=" + page)
                .then(response => {
                    this.products = response.data.data;
                    this.meta = response.data.meta;
                    this.links = response.data.links;
                    this.setPaginator();
                })
                .catch(error => {
                    var msg = document.getElementById("message");
                    msg.classList.add(
                        "alert",
                        "alert-danger",
                        "d-inline-block",
                        "mx-4"
                    );
                    msg.innerHTML = "Products could not be loaded";
                })
                .then(response => {
                    this.loading = false;
                });
        },
        setPaginator() {
            this.paginator = paginator(this.meta, this.links);
        },
        next() {
            return this.getProducts(this.meta.current_page + 1);
        },
        prev() {
            return this.getProducts(this.meta.current_page - 1);
        },
        searchProducts() {
            this.loading = true;
            axios
                .get("/api/products?search=" + this.search)
                .then(response => {
                    this.products = response.data.data;
                    this.meta = response.data.meta;
                    this.links = response.data.links;
                    this.setPaginator();
                })
                .catch(error => {
                    var msg = document.getElementById("message");
                    msg.classList.add(
                        "alert",
                        "alert-danger",
                        "d-inline-block",
                        "mx-4"
                    );
                    msg.innerHTML = "Products could not be loaded";
                })
                .then(response => {
                    this.loading = false;
                });
        }
    }
});
const urlParams = new URLSearchParams(window.location.search);
var page = urlParams.has("page") ? urlParams.get("page") : 1;
app.getProducts(page);
