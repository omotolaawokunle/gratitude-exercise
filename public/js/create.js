const app = new Vue({
    el: "#vue",
    data: {
        product: {
            name: "",
            price: "",
            description: ""
        },
        loading: false,
        errors: []
    },
    methods: {
        createProduct() {
            this.loading = true;
            axios
                .post("/api/products/create", this.product)
                .then(response => {
                    if (response.data.status == 1) {
                        localStorage.setItem("success", response.data.message);
                        window.location.replace(
                            "/products/" + response.data.id
                        );
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
                        msg.innerHTML = "Product could not be created";
                    }
                })
                .then(response => {
                    this.loading = false;
                });
        }
    }
});
