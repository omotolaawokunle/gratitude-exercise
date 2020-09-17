const app = new Vue({
    el: "#vue",
    data: {
        product: [],
        loading: true,
        errors: []
    },
    methods: {
        getProduct(product) {
            this.loading = true;
            axios
                .get("/api/products/" + product)
                .then(response => {
                    this.product = response.data.product;
                })
                .catch(error => {
                    var msg = document.getElementById("message");
                    msg.classList.add("alert", "alert-error");
                    msg.innerHTML = "Products could not be loaded";
                })
                .then(response => {
                    this.loading = false;
                });
        },
        editProduct() {
            this.loading = true;
            axios
                .post("/api/products/edit/" + this.product.id, this.product)
                .then(response => {
                    if (response.data.status == 1) {
                        localStorage.setItem("success", response.data.message);
                        window.location.replace("/products/" + this.product.id);
                    }
                })
                .catch(error => {
                    if (error.response.data.errors != undefined) {
                        this.errors = error.response.data.errors;
                    } else {
                        var msg = document.getElementById("message");
                        msg.classList = [];
                        msg.classList.add(
                            "alert",
                            "alert-danger",
                            "d-inline-block",
                            "mx-4"
                        );
                        msg.innerHTML = "Product could not be edited";
                    }
                })
                .then(response => {
                    this.loading = false;
                });
        }
    }
});
const urlParams = window.location.href.split("/");
var product = urlParams[5];
app.getProduct(product);
