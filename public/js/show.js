const app = new Vue({
    el: "#vue",
    data: {
        product: [],
        loading: true
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
                    msg.classList.add(
                        "alert",
                        "alert-danger",
                        "mx-4",
                        "d-inline-block"
                    );
                    msg.innerHTML = "Products could not be loaded";
                })
                .then(response => {
                    this.loading = false;
                });
        },
        deleteProduct() {
            this.loading = true;
            axios
                .get("/api/products/delete/" + this.product.id)
                .then(response => {
                    if (response.data.status == 1) {
                        localStorage.setItem("success", response.data.message);
                        window.location.replace("/products");
                    }
                })
                .catch(error => {
                    var msg = document.getElementById("message");
                    msg.classList = [];
                    msg.classList.add(
                        "alert",
                        "alert-danger",
                        "inline-block",
                        "mx-4"
                    );
                    msg.innerHTML = "Product could not be deleted";
                })
                .then(response => {
                    this.loading = false;
                });
        }
    }
});
const urlParams = window.location.href.split("/");
var product = urlParams[4];
app.getProduct(product);
