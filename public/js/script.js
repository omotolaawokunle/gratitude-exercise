if (localStorage.getItem("success")) {
    var success = localStorage.getItem("success");
    document
        .getElementById("message")
        .classList.add("alert", "alert-success", "mx-4", "d-inline-block");
    document.getElementById("message").innerHTML = success;
    localStorage.removeItem("success");
}
function paginator(meta, links) {
    const Paginator = {
        meta: false,
        links: false,
        start: (meta, links) => {
            Paginator.meta = meta;
            Paginator.links = links;
        },
        hasPages: () => {
            return Paginator.meta.current_page !== Paginator.meta.last_page;
        },
        onFirstPage: () => {
            return Paginator.meta.current_page == 1;
        },
        hasMorePages: () => {
            return Paginator.meta.last_page !== Paginator.meta.current_page;
        }
    };

    Paginator.start(meta, links);
    return Paginator;
}
