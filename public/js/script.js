document.getElementsByName("query")[0].addEventListener("input", (ele, ev) => {
    var query = document.getElementsByName("query")[0].value;
    var pagelimit = document
        .getElementsByName("pagelimit")[0]
        .options[
        document.getElementsByName("pagelimit")[0].selectedIndex
    ].value.match(/\d+/g);

    fetch("i?search=" + query + "&pagelimit=" + pagelimit)
        .then((response) => response.json())
        .then((contacts) => {
            updateTable(contacts);
            document
                .getElementsByClassName("pagination")[0]
                .firstElementChild.classList.add("active-a");
        });
});

document
    .getElementsByClassName("pagination")[0]
    .addEventListener("click", (ele, ev) => {
        let page = parseInt(ele.target.innerHTML);
        if (isNaN(page)) return;
        var pagelimit = document
            .getElementsByName("pagelimit")[0]
            .options[
            document.getElementsByName("pagelimit")[0].selectedIndex
        ].value.match(/\d+/g);

        fetch(
            "i?search=" +
            document.getElementsByName("query")[0].value +
            "&page=" +
            page +
            "&pagelimit=" +
            pagelimit
        )
            .then((response) => response.json())
            .then((contacts) => {
                updateTable(contacts);
                document
                    .getElementsByClassName("pagination")[0]
                    .children.item(page - 1)
                    .classList.add("active-a");
            });
    });

document
    .getElementsByName("pagelimit")[0]
    .addEventListener("change", (ele, ev) => {
        var pagelimit = document
            .getElementsByName("pagelimit")[0]
            .options[
            document.getElementsByName("pagelimit")[0].selectedIndex
        ].value.match(/\d+/g);

        fetch(
            "i?search=" +
            document.getElementsByName("query")[0].value +
            "&pagelimit=" +
            pagelimit
        )
            .then((response) => response.json())
            .then((contacts) => {
                updateTable(contacts);
                document
                    .getElementsByClassName("pagination")[0]
                    .firstElementChild.classList.add("active-a");
            });
    });

function updateTable(contacts) {
    var tbody = document.getElementById("contactsTableBody");
    tbody.innerHTML = ""; // Clear the table body
    var totalPages = contacts.totalPages;
    delete contacts.totalPages;
    contacts = Object.values(contacts);
    if (contacts.length == 0) {
        var nocontact = `<tr><td colspan="5">No contacts found</td></tr>`;
        tbody.innerHTML = nocontact;
    }

    contacts.forEach(function (contact) {
        var rowData = `<tr>
            <td>${contact.name}</td>
            <td>${contact.email}</td>
            <td>${contact.phone}</td>
            <td>${contact.address}</td>
            <td>
                <a href="edit?id=${contact.id}"><button>Edit</button></a>
                <a href="delete?id=${contact.id}"><button>Delete</button></a>
            </td>
        </tr>`;
        tbody.innerHTML += rowData;
    });
    document.getElementsByClassName("pagination")[0].innerHTML = "";
    for (let i = 1; i <= totalPages; i++) {
        var pagelink = document.createElement("a");
        pagelink.innerHTML = i;
        document.getElementsByClassName("pagination")[0].appendChild(pagelink);
    }
}
